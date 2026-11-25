<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_marks_model extends CI_Model
{
    public function get_admin_contexts()
    {
        $contexts = $this->db->distinct()
            ->select('e.batch_session AS session_label, e.course')
            ->from('exam_form_tb e')
            ->join('subjects_details_tb s', 's.course = e.course')
            ->where('e.admit_card_roll_no !=', '')
            ->where('e.admit_card_roll_no IS NOT NULL', NULL, FALSE)
            ->order_by('e.batch_session', 'DESC')
            ->order_by('e.course', 'ASC')
            ->get()
            ->result_array();
        $context_keys = array();
        foreach ($contexts as $context) {
            $context_keys[$context['session_label'] . "\0" . $context['course']] = TRUE;
        }
        $configured_contexts = $this->db->select('session_label, course')
            ->order_by('session_label', 'DESC')
            ->order_by('course', 'ASC')
            ->get('internal_marks_windows')
            ->result_array();
        foreach ($configured_contexts as $context) {
            $key = $context['session_label'] . "\0" . $context['course'];
            if (!isset($context_keys[$key])) {
                $contexts[] = $context;
                $context_keys[$key] = TRUE;
            }
        }
        return $contexts;
    }

    public function get_admin_institutions()
    {
        return $this->db->distinct()
            ->select('school_code, institution_name_snapshot AS school_name')
            ->from('internal_marks_submissions')
            ->order_by('institution_name_snapshot', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_configured_windows()
    {
        return $this->db->select(
            'w.id, w.session_label, w.course, w.starts_at, w.ends_at, w.is_open,
             (SELECT COUNT(*) FROM internal_marks_assessments a
              WHERE a.session_label = w.session_label
                AND a.course = w.course
                AND a.is_enabled = 1) AS enabled_component_count',
            FALSE
        )
            ->from('internal_marks_windows w')
            ->order_by('w.session_label', 'DESC')
            ->order_by('w.course', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_assessment_catalog($session, $course)
    {
        $subjects = $this->db->select('id, course, year, subject_code, subject_name')
            ->from('subjects_details_tb')
            ->where('course', $course)
            ->order_by('year', 'ASC')
            ->order_by('subject_code', 'ASC')
            ->get()
            ->result_array();
        $configured = $this->db->where('session_label', $session)
            ->where('course', $course)
            ->get('internal_marks_assessments')
            ->result_array();
        $by_subject = array();
        foreach ($configured as $assessment) {
            $by_subject[$assessment['subject_id']][$assessment['component']] = $assessment;
        }

        foreach ($subjects as &$subject) {
            $subject['components'] = array();
            foreach (array('theory', 'practical') as $component) {
                $subject['components'][$component] = isset($by_subject[$subject['id']][$component])
                    ? $by_subject[$subject['id']][$component]
                    : array(
                        'id' => 0,
                        'component' => $component,
                        'max_marks' => '',
                        'pass_marks' => '',
                        'is_enabled' => 0
                    );
            }
        }
        unset($subject);

        return $subjects;
    }

    public function get_window($session, $course)
    {
        return $this->db->where('session_label', $session)
            ->where('course', $course)
            ->limit(1)
            ->get('internal_marks_windows')
            ->row_array();
    }

    public function save_configuration($session, $course, $window, $assessments, $admin_id)
    {
        $this->db->trans_begin();
        $now = date('Y-m-d H:i:s');
        $existing_window = $this->db->query(
            'SELECT * FROM internal_marks_windows WHERE session_label = ? AND course = ? FOR UPDATE',
            array($session, $course)
        )->row_array();
        $has_marks = $this->db->query(
            'SELECT e.id
             FROM internal_marks_submissions s
             JOIN internal_marks_entries e ON e.submission_id = s.id
             WHERE s.session_label = ? AND s.course = ?
             LIMIT 1',
            array($session, $course)
        )->row_array();
        $configuration_snapshot = array();
        $subjects_by_id = array();

        foreach ($assessments as $assessment) {
            $subject = $this->db->where('id', $assessment['subject_id'])
                ->where('course', $course)
                ->limit(1)
                ->get('subjects_details_tb')
                ->row_array();
            if (!$subject) {
                $this->db->trans_rollback();
                return FALSE;
            }
            $subjects_by_id[$assessment['subject_id']] = $subject;

            $existing = $this->db->where('session_label', $session)
                ->where('course', $course)
                ->where('subject_id', $assessment['subject_id'])
                ->where('component', $assessment['component'])
                ->limit(1)
                ->get('internal_marks_assessments')
                ->row_array();
            $new_max = $assessment['enabled'] ? number_format((float) $assessment['max_marks'], 2, '.', '') : '';
            $new_pass = $assessment['enabled'] ? number_format((float) $assessment['pass_marks'], 2, '.', '') : '';
            $old_max = $existing && $existing['max_marks'] !== NULL ? number_format((float) $existing['max_marks'], 2, '.', '') : '';
            $old_pass = $existing && $existing['pass_marks'] !== NULL ? number_format((float) $existing['pass_marks'], 2, '.', '') : '';

            if (
                $has_marks
                && (
                    !$existing
                    || (int) $existing['is_enabled'] !== (int) $assessment['enabled']
                    || $old_max !== $new_max
                    || $old_pass !== $new_pass
                    || $existing['subject_code'] !== $subject['subject_code']
                    || $existing['subject_name_snapshot'] !== $subject['subject_name']
                )
            ) {
                $this->db->trans_rollback();
                return FALSE;
            }

            $configuration_snapshot[] = array(
                'subject_id' => (int) $assessment['subject_id'],
                'component' => $assessment['component'],
                'enabled' => (bool) $assessment['enabled'],
                'max_marks' => $assessment['enabled'] ? $new_max : NULL,
                'pass_marks' => $assessment['enabled'] ? $new_pass : NULL
            );
        }

        $window_data = array(
            'starts_at' => $window['starts_at'],
            'ends_at' => $window['ends_at'],
            'is_open' => $window['is_open'] ? 1 : 0,
            'updated_by' => $admin_id,
            'updated_at' => $now
        );

        if ($existing_window) {
            $this->db->where('id', $existing_window['id'])
                ->update('internal_marks_windows', $window_data);
            $window_id = (int) $existing_window['id'];
        } else {
            $window_data['session_label'] = $session;
            $window_data['course'] = $course;
            $window_data['created_by'] = $admin_id;
            $window_data['created_at'] = $now;
            $this->db->insert('internal_marks_windows', $window_data);
            $window_id = (int) $this->db->insert_id();
        }

        $audit_data = array(
            'submission_id' => NULL,
            'window_id' => $window_id,
            'actor_type' => 'admin',
            'actor_id' => $admin_id,
            'action' => 'window_changed',
            'reason' => NULL,
            'details' => json_encode($window_data),
            'created_at' => $now
        );
        $this->db->insert('internal_marks_audit', $audit_data);

        foreach ($assessments as $assessment) {
            $subject = $subjects_by_id[$assessment['subject_id']];

            $existing = $this->db->where('session_label', $session)
                ->where('course', $course)
                ->where('subject_id', $assessment['subject_id'])
                ->where('component', $assessment['component'])
                ->limit(1)
                ->get('internal_marks_assessments')
                ->row_array();
            $data = array(
                'session_label' => $session,
                'course' => $course,
                'subject_id' => $assessment['subject_id'],
                'subject_code' => $subject['subject_code'],
                'subject_name_snapshot' => $subject['subject_name'],
                'component' => $assessment['component'],
                'max_marks' => $assessment['enabled'] ? $assessment['max_marks'] : NULL,
                'pass_marks' => $assessment['enabled'] ? $assessment['pass_marks'] : NULL,
                'is_enabled' => $assessment['enabled'] ? 1 : 0,
                'updated_at' => $now
            );
            if ($existing) {
                $this->db->where('id', $existing['id'])
                    ->update('internal_marks_assessments', $data);
            } else {
                $data['created_at'] = $now;
                $this->db->insert('internal_marks_assessments', $data);
            }
        }

        $this->db->insert('internal_marks_audit', array(
            'submission_id' => NULL,
            'window_id' => $window_id,
            'actor_type' => 'admin',
            'actor_id' => $admin_id,
            'action' => 'assessment_configuration_changed',
            'reason' => NULL,
            'details' => json_encode(array(
                'session' => $session,
                'course' => $course,
                'assessments' => $configuration_snapshot
            )),
            'created_at' => $now
        ));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    public function get_institution_contexts($course_type)
    {
        return $this->db->distinct()
            ->select('w.session_label, w.course, w.starts_at, w.ends_at, w.is_open')
            ->from('internal_marks_windows w')
            ->where('w.course LIKE', '% ' . $course_type)
            ->order_by('w.session_label', 'DESC')
            ->order_by('w.course', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_enabled_assessments($session, $course)
    {
        return $this->db->where('session_label', $session)
            ->where('course', $course)
            ->where('is_enabled', 1)
            ->order_by('subject_id', 'ASC')
            ->order_by('component', 'ASC')
            ->get('internal_marks_assessments')
            ->result_array();
    }

    public function get_eligible_students($session, $course, $school_code)
    {
        return $this->db->select('id, name, father_name, admit_card_roll_no, ref_no')
            ->from('exam_form_tb')
            ->where('batch_session', $session)
            ->where('course', $course)
            ->where('issue_by', $school_code)
            ->where('admit_card_roll_no !=', '')
            ->where('admit_card_roll_no IS NOT NULL', NULL, FALSE)
            ->order_by('roll_id', 'ASC')
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();
    }

    public function find_eligible_students_by_identifier($session, $course, $school_code, $identifier)
    {
        return $this->db->select('id, name, father_name, admit_card_roll_no, ref_no')
            ->from('exam_form_tb')
            ->where('batch_session', $session)
            ->where('course', $course)
            ->where('issue_by', $school_code)
            ->where('admit_card_roll_no !=', '')
            ->where('admit_card_roll_no IS NOT NULL', NULL, FALSE)
            ->group_start()
                ->where('admit_card_roll_no', $identifier)
                ->or_where('ref_no', $identifier)
            ->group_end()
            ->order_by('id', 'ASC')
            ->limit(2)
            ->get()
            ->result_array();
    }

    public function get_submission($session, $course, $institution_id)
    {
        return $this->db->where('session_label', $session)
            ->where('course', $course)
            ->where('institution_id', $institution_id)
            ->limit(1)
            ->get('internal_marks_submissions')
            ->row_array();
    }

    public function get_assessment_entries($submission_id, $assessment_id)
    {
        $rows = $this->db->where('submission_id', $submission_id)
            ->where('assessment_id', $assessment_id)
            ->get('internal_marks_entries')
            ->result_array();
        $entries = array();
        foreach ($rows as $row) {
            $entries[$row['student_id']] = $row;
        }
        return $entries;
    }

    public function get_student_assessment_entries($submission_id, $student_id)
    {
        $rows = $this->db->where('submission_id', $submission_id)
            ->where('student_id', $student_id)
            ->get('internal_marks_entries')
            ->result_array();
        $entries = array();
        foreach ($rows as $row) {
            $entries[$row['assessment_id']] = $row;
        }
        return $entries;
    }

    public function save_student_assessments($context, $student_id, $assessment_entries, $institution, $actor_id, $submit)
    {
        if (empty($assessment_entries)) {
            return array('ok' => FALSE, 'error' => 'Enter marks for at least one configured subject component.');
        }
        if (!$this->db->trans_begin()) {
            return array('ok' => FALSE, 'error' => 'Marks could not be saved. Please try again.');
        }

        $assessment_ids = array_keys($assessment_entries);
        $final_assessment_id = end($assessment_ids);
        $result = array('ok' => TRUE);
        foreach ($assessment_entries as $assessment_id => $entry) {
            $result = $this->save_marks(
                $context,
                (int) $assessment_id,
                array((int) $student_id => $entry),
                $institution,
                $actor_id,
                $submit && (int) $assessment_id === (int) $final_assessment_id
            );
            if (!$result['ok']) {
                if ($submit && isset($result['submission_id'])) {
                    $this->db->trans_commit();
                    return $result;
                }
                $this->db->trans_rollback();
                return $result;
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'error' => 'Marks could not be saved. Please try again.');
        }
        $this->db->trans_commit();
        return $result;
    }

    public function save_marks($context, $assessment_id, $entries, $institution, $actor_id, $submit)
    {
        $this->db->trans_begin();
        $submission = $this->get_submission($context['session'], $context['course'], $institution['id']);
        $window = $this->db->query(
            'SELECT * FROM internal_marks_windows WHERE session_label = ? AND course = ? FOR UPDATE',
            array($context['session'], $context['course'])
        )->row_array();
        $now = date('Y-m-d H:i:s');
        $admin_reopened = $submission && $submission['status'] === 'reopened';
        if (!$admin_reopened && !$this->window_is_open($window, $now)) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'error' => 'The internal marks entry window is not open.');
        }

        $assessment = $this->db->where('id', $assessment_id)
            ->where('session_label', $context['session'])
            ->where('course', $context['course'])
            ->where('is_enabled', 1)
            ->limit(1)
            ->get('internal_marks_assessments')
            ->row_array();
        if (!$assessment) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'error' => 'The selected assessment is not configured.');
        }

        if ($submission && $submission['status'] === 'submitted') {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'error' => 'This marks submission is locked. Contact JNRC if it needs to be reopened.');
        }

        $students = $this->get_eligible_students($context['session'], $context['course'], $institution['school_code']);
        if ($submit && empty($students)) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'error' => 'There are no eligible students in this session and course.');
        }
        $student_map = array();
        foreach ($students as $student) {
            $student_map[$student['id']] = $student;
        }
        foreach ($entries as $student_id => $entry) {
            if (!isset($student_map[$student_id])) {
                $this->db->trans_rollback();
                return array('ok' => FALSE, 'error' => 'A student is not eligible for this institution, course, or session.');
            }
            if ($entry['attendance_status'] === 'clear') {
                continue;
            }
            if (!in_array($entry['attendance_status'], array('present', 'absent'), TRUE)) {
                $this->db->trans_rollback();
                return array('ok' => FALSE, 'error' => 'Choose Present or Absent for each entered assessment.');
            }
            if ($entry['attendance_status'] === 'present') {
                $mark = (float) $entry['marks_obtained'];
                if ($entry['marks_obtained'] === '' || !is_numeric($entry['marks_obtained']) || $mark < 0 || $mark > (float) $assessment['max_marks']) {
                    $this->db->trans_rollback();
                    return array('ok' => FALSE, 'error' => 'Each present student must have marks between 0 and the configured maximum.');
                }
                if (preg_match('/\.\d{3,}\z/', (string) $entry['marks_obtained'])) {
                    $this->db->trans_rollback();
                    return array('ok' => FALSE, 'error' => 'Marks may have no more than two decimal places.');
                }
            } elseif ($entry['marks_obtained'] !== '') {
                $this->db->trans_rollback();
                return array('ok' => FALSE, 'error' => 'Absent students cannot have a numeric mark.');
            }
        }

        if (!$submission) {
            $this->db->query(
                'INSERT INTO internal_marks_submissions
                    (session_label, course, institution_id, school_code, institution_name_snapshot, status, created_by, updated_by, created_at, updated_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                 ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id)',
                array(
                    $context['session'], $context['course'], $institution['id'],
                    $institution['school_code'], $institution['school_name'], 'draft',
                    $actor_id, $actor_id, $now, $now
                )
            );
            $submission_id = (int) $this->db->insert_id();
            $submission = $this->get_submission($context['session'], $context['course'], $institution['id']);
        } else {
            $submission_id = (int) $submission['id'];
        }

        $changes = array();
        foreach ($entries as $student_id => $entry) {
            $previous = $this->db->where('submission_id', $submission_id)
                ->where('assessment_id', $assessment_id)
                ->where('student_id', $student_id)
                ->limit(1)
                ->get('internal_marks_entries')
                ->row_array();
            if ($entry['attendance_status'] === 'clear') {
                if ($previous) {
                    $this->db->where('id', $previous['id'])->delete('internal_marks_entries');
                    $changes[] = array(
                        'student_id' => (int) $student_id,
                        'student_name' => $previous['student_name_snapshot'],
                        'roll_number' => $previous['roll_number_snapshot'],
                        'assessment_id' => (int) $assessment_id,
                        'subject_code' => $assessment['subject_code'],
                        'component' => $assessment['component'],
                        'from_status' => $previous['attendance_status'],
                        'from_marks' => $previous['marks_obtained'],
                        'to_status' => NULL,
                        'to_marks' => NULL
                    );
                }
                continue;
            }
            $student = $student_map[$student_id];
            $marks = $entry['attendance_status'] === 'absent'
                ? NULL
                : number_format((float) $entry['marks_obtained'], 2, '.', '');
            $data = array(
                'submission_id' => $submission_id,
                'assessment_id' => $assessment_id,
                'student_id' => $student_id,
                'student_name_snapshot' => $student['name'],
                'father_name_snapshot' => $student['father_name'],
                'roll_number_snapshot' => $student['admit_card_roll_no'],
                'reference_number_snapshot' => $student['ref_no'],
                'attendance_status' => $entry['attendance_status'],
                'marks_obtained' => $marks,
                'updated_at' => $now
            );
            if ($previous) {
                $this->db->where('id', $previous['id'])->update('internal_marks_entries', $data);
            } else {
                $data['created_at'] = $now;
                $this->db->insert('internal_marks_entries', $data);
            }
            $changes[] = array(
                'student_id' => (int) $student_id,
                'student_name' => $student['name'],
                'roll_number' => $student['admit_card_roll_no'],
                'assessment_id' => (int) $assessment_id,
                'subject_code' => $assessment['subject_code'],
                'component' => $assessment['component'],
                'from_status' => $previous ? $previous['attendance_status'] : NULL,
                'from_marks' => $previous ? $previous['marks_obtained'] : NULL,
                'to_status' => $entry['attendance_status'],
                'to_marks' => $marks
            );
        }

        $this->db->where('id', $submission_id)->update('internal_marks_submissions', array(
            'status' => $admin_reopened ? 'reopened' : 'draft',
            'updated_by' => $actor_id,
            'updated_at' => $now
        ));
        $this->db->insert('internal_marks_audit', array(
            'submission_id' => $submission_id,
            'window_id' => $window['id'],
            'actor_type' => 'institution',
            'actor_id' => $actor_id,
            'action' => 'marks_saved',
            'reason' => NULL,
            'details' => json_encode($changes),
            'created_at' => $now
        ));

        if ($submit) {
            $missing = $this->db->query(
                'SELECT COUNT(*) AS missing_count
                 FROM internal_marks_assessments a
                 CROSS JOIN exam_form_tb e
                 LEFT JOIN internal_marks_entries m
                   ON m.submission_id = ?
                  AND m.assessment_id = a.id
                  AND m.student_id = e.id
                 WHERE a.session_label = ?
                   AND a.course = ?
                   AND a.is_enabled = 1
                   AND e.batch_session = a.session_label
                   AND e.course = a.course
                   AND e.issue_by = ?
                   AND e.admit_card_roll_no IS NOT NULL
                   AND e.admit_card_roll_no <> ?
                   AND m.id IS NULL',
                array($submission_id, $context['session'], $context['course'], $institution['school_code'], '')
            )->row_array();
            if ((int) $missing['missing_count'] > 0) {
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return array('ok' => FALSE, 'error' => 'The marks could not be saved. Please try again.');
                }
                $this->db->trans_commit();
                return array(
                    'ok' => FALSE,
                    'error' => 'These marks were saved as a draft. Complete every configured assessment for all students before final submission.',
                    'submission_id' => $submission_id
                );
            }
            $this->db->where('id', $submission_id)->update('internal_marks_submissions', array(
                'status' => 'submitted',
                'submitted_at' => $now,
                'updated_by' => $actor_id,
                'updated_at' => $now
            ));
            $this->db->insert('internal_marks_audit', array(
                'submission_id' => $submission_id,
                'window_id' => $window ? $window['id'] : NULL,
                'actor_type' => 'institution',
                'actor_id' => $actor_id,
                'action' => 'final_submitted',
                'reason' => NULL,
                'details' => json_encode(array(
                    'session' => $context['session'],
                    'course' => $context['course'],
                    'institution' => $institution['school_code'],
                    'entry_count' => (int) $this->db->where('submission_id', $submission_id)
                        ->count_all_results('internal_marks_entries')
                )),
                'created_at' => $now
            ));
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'error' => 'The marks could not be saved. Please try again.');
        }

        $this->db->trans_commit();
        return array('ok' => TRUE, 'submission_id' => $submission_id);
    }

    public function get_admin_submissions($filters)
    {
        $this->db->select('s.*, (SELECT COUNT(*) FROM internal_marks_entries e WHERE e.submission_id = s.id) AS entry_count', FALSE)
            ->from('internal_marks_submissions s');
        if ($filters['session'] !== '') {
            $this->db->where('s.session_label', $filters['session']);
        }
        if ($filters['course'] !== '') {
            $this->db->where('s.course', $filters['course']);
        }
        if ($filters['school_code'] !== '') {
            $this->db->where('s.school_code', $filters['school_code']);
        }
        if ($filters['status'] !== '') {
            $this->db->where('s.status', $filters['status']);
        }
        return $this->db->order_by('s.updated_at', 'DESC')->get()->result_array();
    }

    public function get_submission_detail($submission_id)
    {
        return $this->db->where('id', $submission_id)
            ->limit(1)
            ->get('internal_marks_submissions')
            ->row_array();
    }

    public function get_submission_entries($submission_id)
    {
        return $this->db->select('e.*, a.subject_code, a.subject_name_snapshot, a.component, a.max_marks, a.pass_marks')
            ->from('internal_marks_entries e')
            ->join('internal_marks_assessments a', 'a.id = e.assessment_id')
            ->where('e.submission_id', $submission_id)
            ->order_by('e.student_name_snapshot', 'ASC')
            ->order_by('a.subject_id', 'ASC')
            ->order_by('a.component', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_submission_assessments($submission_id)
    {
        $submission = $this->get_submission_detail($submission_id);
        if (!$submission) {
            return array();
        }
        $assessments = $this->db->where('session_label', $submission['session_label'])
            ->where('course', $submission['course'])
            ->where('is_enabled', 1)
            ->order_by('subject_id', 'ASC')
            ->order_by('component', 'ASC')
            ->get('internal_marks_assessments')
            ->result_array();
        foreach ($assessments as &$assessment) {
            $assessment['entries'] = array_values(
                $this->get_assessment_entries($submission_id, $assessment['id'])
            );
        }
        unset($assessment);
        return $assessments;
    }

    public function get_submission_audit($submission_id)
    {
        return $this->db->select('actor_type, actor_id, action, reason, details, created_at')
            ->from('internal_marks_audit')
            ->where('submission_id', $submission_id)
            ->order_by('created_at', 'DESC')
            ->get()
            ->result_array();
    }

    public function admin_update_assessment($submission_id, $assessment_id, $entries, $reason, $admin_id)
    {
        $this->db->trans_begin();
        $submission = $this->db->query(
            'SELECT * FROM internal_marks_submissions WHERE id = ? FOR UPDATE',
            array($submission_id)
        )->row_array();
        if (!$submission) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'message' => 'Submission was not found.');
        }

        $assessment = $this->db->where('id', $assessment_id)
            ->where('session_label', $submission['session_label'])
            ->where('course', $submission['course'])
            ->where('is_enabled', 1)
            ->limit(1)
            ->get('internal_marks_assessments')
            ->row_array();
        if (!$assessment) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'message' => 'The selected assessment is not configured for this submission.');
        }

        $existing_rows = $this->db->query(
            'SELECT * FROM internal_marks_entries
             WHERE submission_id = ? AND assessment_id = ?
             FOR UPDATE',
            array($submission_id, $assessment_id)
        )->result_array();
        $existing_by_student = array();
        foreach ($existing_rows as $row) {
            $existing_by_student[(int) $row['student_id']] = $row;
        }
        $changes = array();
        $now = date('Y-m-d H:i:s');
        foreach ($entries as $student_id => $entry) {
            if (!isset($existing_by_student[$student_id])) {
                $this->db->trans_rollback();
                return array('ok' => FALSE, 'message' => 'A student entry does not belong to this submission and assessment.');
            }
            if (!in_array($entry['attendance_status'], array('present', 'absent'), TRUE)) {
                $this->db->trans_rollback();
                return array('ok' => FALSE, 'message' => 'Choose Present or Absent for each edited student.');
            }
            if ($entry['attendance_status'] === 'present') {
                if (
                    !is_string($entry['marks_obtained'])
                    || !preg_match('/\A(?:[0-9]+(?:\.[0-9]{1,2})?|\.[0-9]{1,2})\z/', $entry['marks_obtained'])
                    || (float) $entry['marks_obtained'] > (float) $assessment['max_marks']
                ) {
                    $this->db->trans_rollback();
                    return array('ok' => FALSE, 'message' => 'Marks must be valid and within the configured maximum.');
                }
                $new_marks = number_format((float) $entry['marks_obtained'], 2, '.', '');
            } else {
                if ($entry['marks_obtained'] !== '') {
                    $this->db->trans_rollback();
                    return array('ok' => FALSE, 'message' => 'Absent students cannot have a numeric mark.');
                }
                $new_marks = NULL;
            }

            $previous = $existing_by_student[$student_id];
            $old_marks = $previous['marks_obtained'] === NULL
                ? NULL
                : number_format((float) $previous['marks_obtained'], 2, '.', '');
            if ($previous['attendance_status'] === $entry['attendance_status'] && $old_marks === $new_marks) {
                continue;
            }
            $this->db->where('id', $previous['id'])
                ->where('submission_id', $submission_id)
                ->update('internal_marks_entries', array(
                    'attendance_status' => $entry['attendance_status'],
                    'marks_obtained' => $new_marks,
                    'updated_at' => $now
                ));
            $changes[] = array(
                'student_id' => (int) $student_id,
                'student_name' => $previous['student_name_snapshot'],
                'roll_number' => $previous['roll_number_snapshot'],
                'from_status' => $previous['attendance_status'],
                'from_marks' => $old_marks,
                'to_status' => $entry['attendance_status'],
                'to_marks' => $new_marks
            );
        }

        if (empty($changes)) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'message' => 'No marks changed; there is nothing to save.');
        }
        $window = $this->get_window($submission['session_label'], $submission['course']);
        $this->db->where('id', $submission_id)->update('internal_marks_submissions', array(
            'updated_by' => $admin_id,
            'updated_at' => $now
        ));
        $this->db->insert('internal_marks_audit', array(
            'submission_id' => $submission_id,
            'window_id' => $window ? $window['id'] : NULL,
            'actor_type' => 'admin',
            'actor_id' => $admin_id,
            'action' => 'admin_marks_edited',
            'reason' => $reason,
            'details' => json_encode(array(
                'assessment_id' => (int) $assessment_id,
                'subject_code' => $assessment['subject_code'],
                'subject' => $assessment['subject_name_snapshot'],
                'component' => $assessment['component'],
                'changes' => $changes
            )),
            'created_at' => $now
        ));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('ok' => FALSE, 'message' => 'Admin mark changes could not be saved.');
        }
        $this->db->trans_commit();
        return array('ok' => TRUE, 'message' => 'Admin mark changes saved and added to the audit history.');
    }

    public function reopen_submission($submission_id, $reason, $admin_id)
    {
        $this->db->trans_begin();
        $submission = $this->db->query(
            'SELECT * FROM internal_marks_submissions WHERE id = ? FOR UPDATE',
            array($submission_id)
        )->row_array();
        if (!$submission || $submission['status'] !== 'submitted') {
            $this->db->trans_rollback();
            return FALSE;
        }
        $window = $this->get_window($submission['session_label'], $submission['course']);
        $now = date('Y-m-d H:i:s');
        $this->db->where('id', $submission_id)->update('internal_marks_submissions', array(
            'status' => 'reopened',
            'reopened_at' => $now,
            'reopened_by' => $admin_id,
            'reopen_reason' => $reason,
            'updated_by' => $admin_id,
            'updated_at' => $now
        ));
        $this->db->insert('internal_marks_audit', array(
            'submission_id' => $submission_id,
            'window_id' => $window ? $window['id'] : NULL,
            'actor_type' => 'admin',
            'actor_id' => $admin_id,
            'action' => 'submission_reopened',
            'reason' => $reason,
            'details' => json_encode(array(
                'previous_status' => $submission['status'],
                'institution_edit_allowed' => TRUE,
                'entry_window_override' => TRUE
            )),
            'created_at' => $now
        ));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
        $this->db->trans_commit();
        return TRUE;
    }

    public function export_entries($filters)
    {
        $this->db->select('s.session_label, s.course, s.school_code, s.institution_name_snapshot, s.status AS submission_status, s.submitted_at, e.roll_number_snapshot, e.reference_number_snapshot, e.student_name_snapshot, e.father_name_snapshot, a.subject_code, a.subject_name_snapshot, a.component, a.max_marks, a.pass_marks, e.attendance_status, e.marks_obtained')
            ->from('internal_marks_entries e')
            ->join('internal_marks_submissions s', 's.id = e.submission_id')
            ->join('internal_marks_assessments a', 'a.id = e.assessment_id');
        if ($filters['session'] !== '') {
            $this->db->where('s.session_label', $filters['session']);
        }
        if ($filters['course'] !== '') {
            $this->db->where('s.course', $filters['course']);
        }
        if ($filters['school_code'] !== '') {
            $this->db->where('s.school_code', $filters['school_code']);
        }
        if ($filters['status'] !== '') {
            $this->db->where('s.status', $filters['status']);
        }
        return $this->db->order_by('s.session_label', 'DESC')
            ->order_by('s.course', 'ASC')
            ->order_by('s.school_code', 'ASC')
            ->order_by('e.roll_number_snapshot', 'ASC')
            ->get()
            ->result_array();
    }

    private function window_is_open($window, $now = NULL)
    {
        if ($now === NULL) {
            $now = date('Y-m-d H:i:s');
        }
        return $window
            && (int) $window['is_open'] === 1
            && $now >= $window['starts_at']
            && $now <= $window['ends_at'];
    }

}
