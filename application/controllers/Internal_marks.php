<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_marks extends CI_Controller
{
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

        $filters = $this->admin_filters();
        $data = array(
            'title' => 'Internal Marks',
            'contexts' => $this->Internal_marks_model->get_admin_contexts(),
            'institutions' => $this->db->select('school_code, school_name')
                ->order_by('school_name', 'ASC')
                ->get('college_list')
                ->result_array(),
            'filters' => $filters,
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

        $contexts = $this->Internal_marks_model->get_admin_contexts();
        $session = $this->query_text('session');
        $course = $this->query_text('course');
        $valid_context = $this->find_context($contexts, $session, $course);
        $data = array(
            'title' => 'Configure Internal Marks',
            'contexts' => $contexts,
            'selected_session' => $valid_context ? $session : '',
            'selected_course' => $valid_context ? $course : '',
            'window' => $valid_context ? $this->Internal_marks_model->get_window($session, $course) : NULL,
            'subjects' => $valid_context ? $this->Internal_marks_model->get_assessment_catalog($session, $course) : array(),
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        );
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/internal_marks_configure', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_save_configuration()
    {
        if (!$this->require_admin()) {
            return;
        }

        $session = $this->post_text('session');
        $course = $this->post_text('course');
        $context = $this->find_context($this->Internal_marks_model->get_admin_contexts(), $session, $course);
        if (!$context) {
            show_error('Select a valid examination session and course.', 400);
            return;
        }

        $start_value = $this->post_text('starts_at');
        $end_value = $this->post_text('ends_at');
        $start = $this->parse_datetime_local($start_value);
        $end = $this->parse_datetime_local($end_value);
        if (!$start || !$end || $start >= $end) {
            $this->set_message('Enter a valid entry-window start and end time.', 'danger');
            redirect('admin/internal-marks/configure?' . http_build_query(array('session' => $session, 'course' => $course)));
            return;
        }

        $posted = $this->input->post('assessments');
        if (!is_array($posted)) {
            $posted = array();
        }
        $catalog = $this->Internal_marks_model->get_assessment_catalog($session, $course);
        $assessments = array();
        $enabled_count = 0;
        foreach ($catalog as $subject) {
            foreach (array('theory', 'practical') as $component) {
                $row = isset($posted[$subject['id']][$component]) && is_array($posted[$subject['id']][$component])
                    ? $posted[$subject['id']][$component]
                    : array();
                $enabled = isset($row['enabled']) && (string) $row['enabled'] === '1';
                $assessment = array(
                    'subject_id' => (int) $subject['id'],
                    'component' => $component,
                    'enabled' => $enabled,
                    'max_marks' => NULL,
                    'pass_marks' => NULL
                );
                if ($enabled) {
                    $max = isset($row['max_marks']) && is_scalar($row['max_marks']) ? trim((string) $row['max_marks']) : '';
                    $pass = isset($row['pass_marks']) && is_scalar($row['pass_marks']) ? trim((string) $row['pass_marks']) : '';
                    if (
                        !$this->valid_mark_number($max)
                        || !$this->valid_mark_number($pass)
                        || (float) $max <= 0
                        || (float) $max > 99999.99
                        || (float) $pass > (float) $max
                    ) {
                        $this->set_message('Enabled assessments need a positive maximum and a pass mark between zero and the maximum.', 'danger');
                        redirect('admin/internal-marks/configure?' . http_build_query(array('session' => $session, 'course' => $course)));
                        return;
                    }
                    $assessment['max_marks'] = number_format((float) $max, 2, '.', '');
                    $assessment['pass_marks'] = number_format((float) $pass, 2, '.', '');
                    $enabled_count++;
                }
                $assessments[] = $assessment;
            }
        }

        if ($enabled_count === 0) {
            $this->set_message('Enable and configure at least one assessment component before saving.', 'danger');
            redirect('admin/internal-marks/configure?' . http_build_query(array('session' => $session, 'course' => $course)));
            return;
        }

        $is_open = $this->input->post('is_open') === '1';
        $saved = $this->Internal_marks_model->save_configuration(
            $session,
            $course,
            array(
                'starts_at' => $start,
                'ends_at' => $end,
                'is_open' => $is_open
            ),
            $assessments,
            $this->actor_id()
        );
        if (!$saved) {
            $this->set_message('Configuration could not be saved. If marks have already been entered, contact support before changing assessment definitions.', 'danger');
        } else {
            $this->set_message('Internal marks configuration and entry window saved.', 'success');
        }
        redirect('admin/internal-marks/configure?' . http_build_query(array('session' => $session, 'course' => $course)));
    }

    public function admin_export()
    {
        if (!$this->require_admin()) {
            return;
        }

        $rows = $this->Internal_marks_model->export_entries($this->admin_filters());
        $filename = 'internal-marks-' . date('Ymd-His') . '.csv';
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: no-store, private');
        $output = fopen('php://output', 'w');
        if ($output === FALSE) {
            show_error('Unable to create the internal marks export.', 500);
            return;
        }
        fwrite($output, "\xEF\xBB\xBF");
        fputcsv($output, array(
            'Session', 'Course', 'Institution Code', 'Institution', 'Submission Status',
            'Submitted At', 'Roll No.', 'Exam Reference', 'Student', "Father's Name",
            'Subject Code', 'Subject', 'Component', 'Maximum Marks', 'Pass Marks',
            'Attendance', 'Marks Obtained'
        ), ',', '"', '');
        foreach ($rows as $row) {
            $values = array_values($row);
            foreach ($values as &$value) {
                $value = (string) $value;
                if (preg_match('/\A[=+\-@]/', $value)) {
                    $value = "'" . $value;
                }
            }
            unset($value);
            fputcsv($output, $values, ',', '"', '');
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
        $this->load->view('admin/include/header', array('title' => 'Internal Marks Submission'));
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/internal_marks_submission', array(
            'submission' => $submission,
            'entries' => $this->Internal_marks_model->get_submission_entries($submission['id']),
            'audit' => $this->Internal_marks_model->get_submission_audit($submission['id']),
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        ));
        $this->load->view('admin/include/footer');
    }

    public function admin_reopen($submission_id)
    {
        if (!$this->require_admin()) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_error('Reopening a submission requires a POST request.', 405);
            return;
        }

        $reason = $this->post_text('reason');
        if ($reason === '' || $this->text_length($reason) > 2000) {
            $this->set_message('A reason of up to 2,000 characters is required to reopen marks.', 'danger');
        } elseif (!$this->Internal_marks_model->reopen_submission((int) $submission_id, $reason, $this->actor_id())) {
            $this->set_message('Submission could not be reopened. Confirm it is currently submitted.', 'danger');
        } else {
            $this->set_message('Submission reopened for institution edits.', 'success');
        }
        redirect('admin/internal-marks/submission/' . (int) $submission_id);
    }

    public function institution_index()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        $contexts = $this->Internal_marks_model->get_institution_contexts(
            $institution['school_code'],
            $institution['course_type']
        );
        $submissions = array();
        foreach ($contexts as $context) {
            $context['submission'] = $this->Internal_marks_model->get_submission(
                $context['session_label'],
                $context['course'],
                $institution['id']
            );
            $submissions[] = $context;
        }
        $this->load->view('institution/include/header');
        $this->load->view('institution/internal_marks', array(
            'contexts' => $submissions,
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        ));
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
        $context = $this->find_context(
            $this->Internal_marks_model->get_institution_contexts($institution['school_code'], $institution['course_type']),
            $session,
            $course
        );
        if (!$context) {
            show_404();
            return;
        }
        $assessments = $this->Internal_marks_model->get_enabled_assessments($session, $course);
        $assessment_id = (int) $this->query_text('assessment');
        $selected_assessment = NULL;
        foreach ($assessments as $assessment) {
            if ((int) $assessment['id'] === $assessment_id) {
                $selected_assessment = $assessment;
                break;
            }
        }
        $submission = $this->Internal_marks_model->get_submission($session, $course, $institution['id']);
        $window_open = $this->window_is_open($context);
        $students = $this->Internal_marks_model->get_eligible_students($session, $course, $institution['school_code']);
        $entries = $selected_assessment && $submission
            ? $this->Internal_marks_model->get_assessment_entries($submission['id'], $selected_assessment['id'])
            : array();

        $this->load->view('institution/include/header');
        $this->load->view('institution/internal_marks_entry', array(
            'context' => $context,
            'institution' => $institution,
            'assessments' => $assessments,
            'selected_assessment' => $selected_assessment,
            'submission' => $submission,
            'window_open' => $window_open,
            'students' => $students,
            'entries' => $entries,
            'message' => $this->session->flashdata('internal_marks_message'),
            'message_type' => $this->session->flashdata('internal_marks_message_type')
        ));
        $this->load->view('institution/include/footer');
    }

    public function institution_save()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_error('Saving marks requires a POST request.', 405);
            return;
        }

        $session = $this->post_text('session');
        $course = $this->post_text('course');
        $context = $this->find_context(
            $this->Internal_marks_model->get_institution_contexts($institution['school_code'], $institution['course_type']),
            $session,
            $course
        );
        if (!$context) {
            show_404();
            return;
        }
        $assessment_id = (int) $this->input->post('assessment_id');
        $statuses = $this->input->post('attendance_status');
        $marks = $this->input->post('marks');
        if (!is_array($statuses)) {
            $statuses = array();
        }
        if (!is_array($marks)) {
            $marks = array();
        }
        $entries = array();
        foreach ($statuses as $student_id => $status) {
            if (!ctype_digit((string) $student_id) || !is_scalar($status)) {
                continue;
            }
            $mark = isset($marks[$student_id]) && is_scalar($marks[$student_id])
                ? trim((string) $marks[$student_id])
                : '';
            if ($status === '' && $mark === '') {
                $entries[(int) $student_id] = array(
                    'attendance_status' => 'clear',
                    'marks_obtained' => ''
                );
                continue;
            }
            if (!in_array($status, array('present', 'absent'), TRUE)) {
                $this->set_message('Choose Present or Absent for each student with an entered mark.', 'danger');
                $this->redirect_to_entry($session, $course, $assessment_id);
                return;
            }
            if ($status === 'absent' && $mark !== '') {
                $this->set_message('Clear the numeric mark when recording a student as absent.', 'danger');
                $this->redirect_to_entry($session, $course, $assessment_id);
                return;
            }
            if ($status === 'present' && !$this->valid_mark_number($mark)) {
                $this->set_message('Present students need a valid numeric mark with at most two decimal places.', 'danger');
                $this->redirect_to_entry($session, $course, $assessment_id);
                return;
            }
            $entries[(int) $student_id] = array(
                'attendance_status' => $status,
                'marks_obtained' => $mark
            );
        }

        $submit = $this->input->post('action') === 'submit';
        $result = $this->Internal_marks_model->save_marks(
            array('session' => $session, 'course' => $course),
            $assessment_id,
            $entries,
            $institution,
            $this->actor_id(),
            $submit
        );
        if (!$result['ok']) {
            $this->set_message($result['error'], 'danger');
        } elseif ($submit) {
            $this->set_message('All configured marks were submitted and are now locked.', 'success');
            redirect('institution/internal-marks');
            return;
        } else {
            $this->set_message('Marks draft saved.', 'success');
        }
        $this->redirect_to_entry($session, $course, $assessment_id);
    }

    private function admin_filters()
    {
        $filters = array(
            'session' => $this->query_text('session'),
            'course' => $this->query_text('course'),
            'school_code' => $this->query_text('school_code'),
            'status' => $this->query_text('status')
        );
        if (!in_array($filters['status'], array('', 'draft', 'submitted', 'reopened'), TRUE)) {
            $filters['status'] = '';
        }
        return $filters;
    }

    private function find_context($contexts, $session, $course)
    {
        foreach ($contexts as $context) {
            if ($context['session_label'] === $session && $context['course'] === $course) {
                return $context;
            }
        }
        return NULL;
    }

    private function window_is_open($window)
    {
        $now = date('Y-m-d H:i:s');
        return $window
            && (int) $window['is_open'] === 1
            && $now >= $window['starts_at']
            && $now <= $window['ends_at'];
    }

    private function parse_datetime_local($value)
    {
        $date = DateTime::createFromFormat('!Y-m-d\TH:i', $value);
        if (!$date || $date->format('Y-m-d\TH:i') !== $value) {
            return NULL;
        }
        return $date->format('Y-m-d H:i:s');
    }

    private function valid_mark_number($value)
    {
        return is_string($value)
            && preg_match('/\A(?:[0-9]+(?:\.[0-9]{1,2})?|\.[0-9]{1,2})\z/', $value);
    }

    private function query_text($key)
    {
        $value = $this->input->get($key, TRUE);
        return is_scalar($value) ? trim((string) $value) : '';
    }

    private function post_text($key)
    {
        $value = $this->input->post($key, TRUE);
        return is_scalar($value) ? trim((string) $value) : '';
    }

    private function redirect_to_entry($session, $course, $assessment_id)
    {
        redirect('institution/internal-marks/entry?' . http_build_query(array(
            'session' => $session,
            'course' => $course,
            'assessment' => $assessment_id
        )));
    }

    private function actor_id()
    {
        foreach (array('admin_id', 'user_id', 'id', 'school_id') as $key) {
            $id = $this->session->userdata($key);
            if (is_numeric($id) && (int) $id > 0) {
                return (int) $id;
            }
        }
        return NULL;
    }

    private function text_length($value)
    {
        return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
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
        $institution = $this->db->select('id, school_code, school_name, course_type')
            ->where('id', (int) $school_id)
            ->where('school_code', $school_code)
            ->get('college_list')
            ->row_array();
        if (!$institution || !in_array($institution['course_type'], array('ANM', 'GNM'), TRUE)) {
            if ($institution) {
                show_error('Internal marks are not configured for this institution course.', 403);
                return FALSE;
            }
            $this->session->sess_destroy();
            redirect('institution_login');
            return FALSE;
        }
        return $institution;
    }

    private function set_message($message, $type)
    {
        $this->session->set_flashdata('internal_marks_message', $message);
        $this->session->set_flashdata('internal_marks_message_type', $type);
    }
}
