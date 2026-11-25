<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_marks extends CI_Controller
{
    private $submission_statuses = array('draft', 'submitted', 'reopened');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->model('Internal_marks_model');
    }

    public function admin_index()
    {
        if (!$this->require_admin()) {
            return;
        }

        $status = $this->input->get('status', TRUE);
        $status = is_scalar($status) ? trim((string) $status) : NULL;
        if ($status === NULL) {
            $status = 'submitted';
        } elseif (!in_array($status, array_merge(array(''), $this->submission_statuses), TRUE)) {
            $status = 'submitted';
        }

        $filters = array(
            'session' => $this->query_text('session'),
            'course' => $this->query_text('course'),
            'school_code' => $this->query_text('school_code'),
            'status' => $status
        );
        $data = array(
            'title' => 'Internal Marks',
            'filters' => $filters,
            'contexts' => $this->Internal_marks_model->get_admin_contexts(),
            'institutions' => $this->Internal_marks_model->get_admin_institutions(),
            'submissions' => $this->Internal_marks_model->get_admin_submissions($filters),
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        );

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/internal_marks', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_configure()
    {
        if (!$this->require_admin()) {
            return;
        }

        $data = array(
            'title' => 'Internal Marks Configuration',
            'contexts' => $this->Internal_marks_model->get_admin_contexts(),
            'configured_windows' => $this->Internal_marks_model->get_configured_windows(),
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        );
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/internal_marks_configure', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_configure_window()
    {
        if (!$this->require_admin()) {
            return;
        }

        $session = $this->query_text('session');
        $course = $this->query_text('course');
        if (!$this->context_exists($session, $course)) {
            $this->set_message('Choose a valid examination session and course.', 'warning');
            redirect('admin/internal-marks/configure');
            return;
        }

        $data = array(
            'title' => 'Internal Marks Window',
            'session' => $session,
            'course' => $course,
            'window' => $this->Internal_marks_model->get_window($session, $course),
            'subjects' => $this->Internal_marks_model->get_assessment_catalog($session, $course),
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        );
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/internal_marks_configure_window', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_save_configuration()
    {
        if (!$this->require_admin()) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $session = $this->post_text('session');
        $course = $this->post_text('course');
        if (!$this->context_exists($session, $course)) {
            $this->set_message('Choose a valid examination session and course.', 'warning');
            redirect('admin/internal-marks/configure');
            return;
        }

        $starts_at = $this->parse_datetime_local($this->post_text('starts_at'));
        $ends_at = $this->parse_datetime_local($this->post_text('ends_at'));
        if ($starts_at === NULL || $ends_at === NULL || $starts_at >= $ends_at) {
            $this->set_message('Enter valid start and end times; the end must be later than the start.', 'warning');
            redirect('admin/internal-marks/configure/edit?' . http_build_query(array(
                'session' => $session,
                'course' => $course
            )));
            return;
        }

        $posted_assessments = $this->input->post('assessments');
        if (!is_array($posted_assessments)) {
            $posted_assessments = array();
        }
        $catalog = $this->Internal_marks_model->get_assessment_catalog($session, $course);
        $assessments = array();
        $enabled_count = 0;
        foreach ($catalog as $subject) {
            foreach (array('theory', 'practical') as $component) {
                $subject_id = (int) $subject['id'];
                $posted = isset($posted_assessments[$subject_id][$component])
                    && is_array($posted_assessments[$subject_id][$component])
                    ? $posted_assessments[$subject_id][$component]
                    : array();
                $enabled = isset($posted['enabled']) && (string) $posted['enabled'] === '1';
                $max_marks = isset($posted['max_marks']) && is_scalar($posted['max_marks'])
                    ? trim((string) $posted['max_marks'])
                    : '';
                $pass_marks = isset($posted['pass_marks']) && is_scalar($posted['pass_marks'])
                    ? trim((string) $posted['pass_marks'])
                    : '';

                if ($enabled) {
                    if (
                        !$this->is_decimal($max_marks)
                        || !$this->is_decimal($pass_marks)
                        || (float) $max_marks <= 0
                        || (float) $pass_marks > (float) $max_marks
                    ) {
                        $this->set_message('Enabled components need a positive maximum and a pass mark between zero and that maximum, with no more than two decimals.', 'warning');
                        redirect('admin/internal-marks/configure/edit?' . http_build_query(array(
                            'session' => $session,
                            'course' => $course
                        )));
                        return;
                    }
                    $enabled_count++;
                }

                $assessments[] = array(
                    'subject_id' => $subject_id,
                    'component' => $component,
                    'enabled' => $enabled,
                    'max_marks' => $enabled ? $max_marks : '',
                    'pass_marks' => $enabled ? $pass_marks : ''
                );
            }
        }

        if ($enabled_count === 0) {
            $this->set_message('Enable at least one Theory or Practical component before saving.', 'warning');
            redirect('admin/internal-marks/configure/edit?' . http_build_query(array(
                'session' => $session,
                'course' => $course
            )));
            return;
        }

        $window = array(
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
            'is_open' => $this->post_text('is_open') === '1'
        );
        $admin_id = $this->session->userdata('uid');
        $admin_id = is_numeric($admin_id) ? (int) $admin_id : NULL;
        if (!$this->Internal_marks_model->save_configuration($session, $course, $window, $assessments, $admin_id)) {
            $this->set_message('Configuration could not be saved. Assessment definitions may be locked because marks already exist.', 'danger');
        } else {
            $this->set_message('Internal marks configuration saved.', 'success');
        }
        redirect('admin/internal-marks/configure');
    }

    public function admin_export()
    {
        if (!$this->require_admin()) {
            return;
        }

        $filters = $this->get_submission_filters(FALSE);
        $rows = $this->Internal_marks_model->export_entries($filters);
        $headers = array(
            'Session', 'Course', 'Institution Code', 'Institution', 'Submission Status',
            'Submitted At', 'Roll Number', 'Reference Number', 'Student', "Father's Name",
            'Subject Code', 'Subject', 'Component', 'Maximum', 'Pass Mark',
            'Attendance', 'Marks'
        );
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="internal-marks-' . date('Ymd-His') . '.csv"');
        header('Cache-Control: no-store, private');
        echo "\xEF\xBB\xBF";
        $output = fopen('php://output', 'w');
        if ($output === FALSE) {
            show_error('Unable to create the internal marks CSV export.', 500);
            return;
        }
        fputcsv($output, $headers);
        foreach ($rows as $row) {
            $values = array(
                $row['session_label'], $row['course'], $row['school_code'],
                $row['institution_name_snapshot'], $row['submission_status'],
                $row['submitted_at'], $row['roll_number_snapshot'],
                $row['reference_number_snapshot'], $row['student_name_snapshot'],
                $row['father_name_snapshot'], $row['subject_code'],
                $row['subject_name_snapshot'], $row['component'], $row['max_marks'],
                $row['pass_marks'], $row['attendance_status'], $row['marks_obtained']
            );
            fputcsv($output, array_map(array($this, 'safe_csv_value'), $values));
        }
        fclose($output);
    }

    public function admin_submission($submission_id)
    {
        if (!$this->require_admin()) {
            return;
        }

        $submission = $this->Internal_marks_model->get_submission_detail((int) $submission_id);
        if (!$submission) {
            show_404();
            return;
        }
        $data = array(
            'title' => 'Internal Marks Submission',
            'submission' => $submission,
            'assessments' => $this->Internal_marks_model->get_submission_assessments((int) $submission_id),
            'audit' => $this->Internal_marks_model->get_submission_audit((int) $submission_id),
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        );
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/internal_marks_submission', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_update_submission($submission_id)
    {
        if (!$this->require_admin()) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $reason = $this->post_text('reason');
        $assessment_id = $this->positive_post_integer('assessment_id');
        $attendance = $this->input->post('attendance_status');
        $marks = $this->input->post('marks');
        if ($reason === '' || strlen($reason) > 2000 || !$assessment_id || !is_array($attendance) || !is_array($marks)) {
            $this->set_message('A reason and valid attendance/marks entries are required.', 'warning');
            redirect('admin/internal-marks/submission/' . (int) $submission_id);
            return;
        }

        $entries = array();
        foreach ($attendance as $student_id => $status) {
            if (!ctype_digit((string) $student_id) || !is_scalar($status)) {
                $this->set_message('The submitted student entries are invalid.', 'warning');
                redirect('admin/internal-marks/submission/' . (int) $submission_id);
                return;
            }
            $mark = isset($marks[$student_id]) && is_scalar($marks[$student_id])
                ? trim((string) $marks[$student_id])
                : '';
            if (!in_array($status, array('present', 'absent'), TRUE)) {
                $this->set_message('Choose Present or Absent for every edited student.', 'warning');
                redirect('admin/internal-marks/submission/' . (int) $submission_id);
                return;
            }
            if (($status === 'present' && !$this->is_decimal($mark)) || ($status === 'absent' && $mark !== '')) {
                $this->set_message('Enter a valid mark for Present students and leave marks blank for Absent students.', 'warning');
                redirect('admin/internal-marks/submission/' . (int) $submission_id);
                return;
            }
            $entries[(int) $student_id] = array(
                'attendance_status' => $status,
                'marks_obtained' => $mark
            );
        }

        $admin_id = $this->session->userdata('uid');
        $result = $this->Internal_marks_model->admin_update_assessment(
            (int) $submission_id,
            $assessment_id,
            $entries,
            $reason,
            is_numeric($admin_id) ? (int) $admin_id : NULL
        );
        $this->set_message($result['message'], $result['ok'] ? 'success' : 'warning');
        redirect('admin/internal-marks/submission/' . (int) $submission_id);
    }

    public function admin_reopen($submission_id)
    {
        if (!$this->require_admin()) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $reason = $this->post_text('reason');
        if ($reason === '' || strlen($reason) > 2000) {
            $this->set_message('Enter a reason of at most 2,000 characters to reopen this submission.', 'warning');
            redirect('admin/internal-marks/submission/' . (int) $submission_id);
            return;
        }

        $admin_id = $this->session->userdata('uid');
        $ok = $this->Internal_marks_model->reopen_submission(
            (int) $submission_id,
            $reason,
            is_numeric($admin_id) ? (int) $admin_id : NULL
        );
        $this->set_message(
            $ok ? 'Submission reopened for institution corrections.' : 'Only a submitted record can be reopened.',
            $ok ? 'success' : 'warning'
        );
        redirect('admin/internal-marks/submission/' . (int) $submission_id);
    }

    public function institution_index()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        $contexts = $this->Internal_marks_model->get_institution_contexts($institution['course_type']);
        foreach ($contexts as &$context) {
            $context['submission'] = $this->Internal_marks_model->get_submission(
                $context['session_label'],
                $context['course'],
                (int) $institution['id']
            );
        }
        unset($context);
        $data = array(
            'title' => 'Internal Marks',
            'contexts' => $contexts,
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        );
        $this->load->view('institution/include/header');
        $this->load->view('institution/internal_marks', $data);
        $this->load->view('institution/include/footer');
    }

    public function institution_entry()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        $session = $this->query_text('session');
        $course = $this->query_text('course');
        $context = $this->find_institution_context($institution, $session, $course);
        if (!$context) {
            show_404();
            return;
        }

        $submission = $this->Internal_marks_model->get_submission(
            $session,
            $course,
            (int) $institution['id']
        );
        $students = $this->Internal_marks_model->get_eligible_students(
            $session,
            $course,
            $institution['school_code']
        );
        $assessments = $this->Internal_marks_model->get_enabled_assessments($session, $course);
        $student_identifier = $this->query_text('student_identifier');
        $student = NULL;
        $student_lookup_error = '';
        if ($student_identifier !== '') {
            $matches = $this->Internal_marks_model->find_eligible_students_by_identifier(
                $session,
                $course,
                $institution['school_code'],
                $student_identifier
            );
            if (count($matches) === 1) {
                $student = $matches[0];
            } elseif (count($matches) > 1) {
                $student_lookup_error = 'More than one eligible form matches that identifier. Use the exact assigned roll number.';
            } else {
                $student_lookup_error = 'No eligible student matches that roll or reference number.';
            }
        }

        $entries = $student
            ? $this->Internal_marks_model->get_student_assessment_entries((int) ($submission ? $submission['id'] : 0), (int) $student['id'])
            : array();
        $now = date('Y-m-d H:i:s');
        $window_open = (int) $context['is_open'] === 1
            && $now >= $context['starts_at']
            && $now <= $context['ends_at'];
        $institution_edit_allowed = (!$submission || $submission['status'] !== 'submitted')
            && ($window_open || ($submission && $submission['status'] === 'reopened'));

        $data = array(
            'title' => 'Enter Internal Marks',
            'institution' => $institution,
            'context' => $context,
            'submission' => $submission,
            'students' => $students,
            'student_identifier' => $student_identifier,
            'student_lookup_error' => $student_lookup_error,
            'student' => $student,
            'assessments' => $assessments,
            'entries' => $entries,
            'window_open' => $window_open,
            'institution_edit_allowed' => $institution_edit_allowed,
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        );
        $this->load->view('institution/include/header');
        $this->load->view('institution/internal_marks_entry', $data);
        $this->load->view('institution/include/footer');
    }

    public function institution_save()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $session = $this->post_text('session');
        $course = $this->post_text('course');
        $context = $this->find_institution_context($institution, $session, $course);
        if (!$context) {
            show_404();
            return;
        }
        $student_id = $this->positive_post_integer('student_id');
        $action = $this->post_text('action');
        if (!$student_id || !in_array($action, array('draft', 'submit'), TRUE)) {
            $this->institution_error_redirect($session, $course, '', 'Select a valid student and save action.');
            return;
        }

        $students = $this->Internal_marks_model->get_eligible_students(
            $session,
            $course,
            $institution['school_code']
        );
        $student = NULL;
        foreach ($students as $eligible_student) {
            if ((int) $eligible_student['id'] === $student_id) {
                $student = $eligible_student;
                break;
            }
        }
        if (!$student) {
            $this->institution_error_redirect($session, $course, '', 'The selected student is not eligible for this institution, session, or course.');
            return;
        }

        $assessments = $this->Internal_marks_model->get_enabled_assessments($session, $course);
        $attendance = $this->input->post('attendance_status');
        $marks = $this->input->post('marks');
        if (!is_array($attendance) || !is_array($marks)) {
            $this->institution_error_redirect($session, $course, $student['ref_no'], 'Submit valid attendance and marks for configured components.');
            return;
        }

        $allowed_ids = array();
        foreach ($assessments as $assessment) {
            $allowed_ids[(string) (int) $assessment['id']] = $assessment;
        }
        foreach (array($attendance, $marks) as $posted_values) {
            foreach ($posted_values as $assessment_id => $value) {
                if (!ctype_digit((string) $assessment_id) || !isset($allowed_ids[(string) (int) $assessment_id])) {
                    $this->institution_error_redirect($session, $course, $student['ref_no'], 'A submitted component is not configured for this session and course.');
                    return;
                }
            }
        }

        $assessment_entries = array();
        foreach ($assessments as $assessment) {
            $assessment_id = (string) (int) $assessment['id'];
            $status = isset($attendance[$assessment_id]) && is_scalar($attendance[$assessment_id])
                ? (string) $attendance[$assessment_id]
                : 'clear';
            $mark = isset($marks[$assessment_id]) && is_scalar($marks[$assessment_id])
                ? trim((string) $marks[$assessment_id])
                : '';
            if (!in_array($status, array('clear', 'present', 'absent'), TRUE)) {
                $this->institution_error_redirect($session, $course, $student['ref_no'], 'Choose Present or Absent for each entered assessment.');
                return;
            }
            if (
                ($status === 'present' && (!$this->is_decimal($mark) || (float) $mark > (float) $assessment['max_marks']))
                || ($status === 'absent' && $mark !== '')
                || ($status === 'clear' && $mark !== '')
            ) {
                $this->institution_error_redirect($session, $course, $student['ref_no'], 'Enter a valid mark within the maximum for Present students; leave marks blank for Absent or unentered components.');
                return;
            }
            $assessment_entries[(int) $assessment['id']] = array(
                'attendance_status' => $status,
                'marks_obtained' => $mark
            );
        }

        $result = $this->Internal_marks_model->save_student_assessments(
            array('session' => $session, 'course' => $course),
            $student_id,
            $assessment_entries,
            $institution,
            (int) $institution['id'],
            $action === 'submit'
        );
        $this->set_message($result['ok'] ? 'Internal marks saved.' : $result['error'], $result['ok'] ? 'success' : 'warning');
        $identifier = $student['ref_no'] !== '' ? $student['ref_no'] : $student['admit_card_roll_no'];
        $this->institution_entry_redirect($session, $course, $identifier);
    }

    private function get_submission_filters($default_status)
    {
        $status = $this->query_text('status');
        if ($status === '' && $default_status) {
            $status_value = $this->input->get('status', TRUE);
            if ($status_value === NULL) {
                $status = 'submitted';
            }
        }
        if (!in_array($status, array_merge(array(''), $this->submission_statuses), TRUE)) {
            $status = $default_status ? 'submitted' : '';
        }
        return array(
            'session' => $this->query_text('session'),
            'course' => $this->query_text('course'),
            'school_code' => $this->query_text('school_code'),
            'status' => $status
        );
    }

    private function context_exists($session, $course)
    {
        if ($session === '' || $course === '') {
            return FALSE;
        }
        foreach ($this->Internal_marks_model->get_admin_contexts() as $context) {
            if ($context['session_label'] === $session && $context['course'] === $course) {
                return TRUE;
            }
        }
        return FALSE;
    }

    private function find_institution_context($institution, $session, $course)
    {
        if ($session === '' || $course === '') {
            return NULL;
        }
        foreach ($this->Internal_marks_model->get_institution_contexts($institution['course_type']) as $context) {
            if ($context['session_label'] === $session && $context['course'] === $course) {
                return $context;
            }
        }
        return NULL;
    }

    private function require_admin()
    {
        if ($this->session->userdata('role_admin') === 'admin') {
            return TRUE;
        }
        redirect('adminjnrc');
        return FALSE;
    }

    private function require_institution()
    {
        $school_id = $this->session->userdata('school_id');
        $school_code = $this->session->userdata('school_code');
        if (
            $this->session->userdata('role') !== 'institute'
            || (string) $this->session->userdata('loginstatus') !== '1'
            || !is_numeric($school_id)
            || !is_string($school_code)
            || $school_code === ''
        ) {
            redirect('institution_login');
            return FALSE;
        }

        $institution = $this->db->select('id, school_code, school_name, course_type, address')
            ->where('id', (int) $school_id)
            ->where('school_code', $school_code)
            ->get('college_list')
            ->row_array();
        if (!$institution) {
            $this->session->sess_destroy();
            redirect('institution_login');
            return FALSE;
        }
        return $institution;
    }

    private function institution_error_redirect($session, $course, $identifier, $message)
    {
        $this->set_message($message, 'warning');
        $this->institution_entry_redirect($session, $course, $identifier);
    }

    private function institution_entry_redirect($session, $course, $identifier)
    {
        redirect('institution/internal-marks/entry?' . http_build_query(array(
            'session' => $session,
            'course' => $course,
            'student_identifier' => $identifier
        )));
    }

    private function positive_post_integer($key)
    {
        $value = $this->input->post($key, TRUE);
        return is_scalar($value) && ctype_digit((string) $value) && (int) $value > 0
            ? (int) $value
            : 0;
    }

    private function query_text($key)
    {
        $value = $this->input->get($key, TRUE);
        return is_scalar($value) ? substr(trim((string) $value), 0, 255) : '';
    }

    private function post_text($key)
    {
        $value = $this->input->post($key, TRUE);
        return is_scalar($value) ? trim((string) $value) : '';
    }

    private function parse_datetime_local($value)
    {
        $date = DateTime::createFromFormat('!Y-m-d\TH:i', $value);
        $errors = DateTime::getLastErrors();
        if (
            !$date
            || ($errors && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))
            || $date->format('Y-m-d\TH:i') !== $value
        ) {
            return NULL;
        }
        return $date->format('Y-m-d H:i:s');
    }

    private function is_decimal($value)
    {
        return is_string($value)
            && preg_match('/\A(?:[0-9]+(?:\.[0-9]{1,2})?|\.[0-9]{1,2})\z/', $value) === 1;
    }

    private function safe_csv_value($value)
    {
        $value = (string) $value;
        return preg_match('/\A[\t\r ]*[=+\-@]/', $value) ? "'" . $value : $value;
    }

    private function set_message($message, $type)
    {
        $this->session->set_flashdata('internal_marks_message', $message);
        $this->session->set_flashdata('internal_marks_message_type', $type);
    }
}
