<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;

class Admit_cards extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        $this->load->model('Admit_card_model');
    }

    public function index()
    {
        if (!$this->require_admin()) {
            return;
        }

        $filters = array(
            'session' => trim((string) $this->input->get('session', TRUE)),
            'course' => trim((string) $this->input->get('course', TRUE)),
            'institution' => trim((string) $this->input->get('institution', TRUE)),
            'status' => trim((string) $this->input->get('status', TRUE)),
            'search' => trim((string) $this->input->get('search', TRUE))
        );

        if (!in_array($filters['status'], array('', 'pending', 'released', 'downloaded', 'withdrawn'), TRUE)) {
            $filters['status'] = '';
        }

        $per_page = 50;
        $total_rows = $this->Admit_card_model->count_admin_students($filters);
        $total_pages = max(1, (int) ceil($total_rows / $per_page));
        $page = (int) $this->input->get('page');
        $page = max(1, min($page, $total_pages));

        $data = array(
            'title' => 'Admit Card Release',
            'filters' => $filters,
            'options' => $this->Admit_card_model->get_filter_options(),
            'students' => $this->Admit_card_model->get_admin_students($filters, $per_page, ($page - 1) * $per_page),
            'page' => $page,
            'total_pages' => $total_pages,
            'total_rows' => $total_rows,
            'message' => $this->session->flashdata('admit_card_message'),
            'message_type' => $this->session->flashdata('admit_card_message_type')
        );

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/admit_card_release', $data);
        $this->load->view('admin/include/footer');
    }

    public function update_release()
    {
        if (!$this->require_admin()) {
            return;
        }

        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $action = $this->input->post('action', TRUE);
        $status = $action === 'release' ? 'released' : ($action === 'withdraw' ? 'withdrawn' : '');
        $posted_ids = $this->input->post('student_ids');

        if ($status === '' || !is_array($posted_ids)) {
            $this->set_message('Select one or more students and choose a release action.', 'warning');
            redirect('admin/admit-cards');
            return;
        }

        $student_ids = array();
        foreach ($posted_ids as $posted_id) {
            if (is_scalar($posted_id) && ctype_digit((string) $posted_id) && (int) $posted_id > 0) {
                $student_ids[] = (int) $posted_id;
            }
        }
        $student_ids = array_values(array_unique($student_ids));

        if (count($student_ids) === 0 || count($student_ids) > 500) {
            $this->set_message('Select between 1 and 500 valid students per action.', 'warning');
            redirect('admin/admit-cards');
            return;
        }

        $center_id = NULL;
        if ($status === 'released') {
            $posted_center_id = $this->input->post('center_id', TRUE);
            if (!is_scalar($posted_center_id) || !ctype_digit((string) $posted_center_id) || (int) $posted_center_id < 1) {
                $this->set_message('Choose a valid exam center before releasing admit cards.', 'warning');
                redirect('admin/admit-cards');
                return;
            }
            $center_id = (int) $posted_center_id;
        }

        $admin_id = $this->session->userdata('uid');
        $admin_id = is_numeric($admin_id) ? (int) $admin_id : NULL;

        $verification_tokens = array();
        if ($status === 'released') {
            $students = $this->Admit_card_model->get_release_candidates($student_ids);
            if (count($students) !== count($student_ids)) {
                $this->set_message('One or more selected students could not be found. No changes were saved.', 'danger');
                redirect('admin/admit-cards');
                return;
            }

            foreach ($students as $student) {
                $token = bin2hex(random_bytes(32));
                $qr = $this->qr_data_uri(site_url('verify/admit-card/' . $token), $student, $token);
                if ($qr === '') {
                    $this->set_message('The verification QR code could not be created. No changes were saved.', 'danger');
                    redirect('admin/admit-cards');
                    return;
                }
                $verification_tokens[(int) $student['id']] = hash('sha256', $token);
            }
        }

        if (!$this->Admit_card_model->set_release_state(
            $student_ids,
            $status,
            $admin_id,
            $center_id,
            $verification_tokens
        )) {
            $this->set_message('The release update failed. Choose an existing center and try again; no changes were saved.', 'danger');
            redirect('admin/admit-cards');
            return;
        }

        $verb = $status === 'released' ? 'Released' : 'Withdrawn';
        $this->set_message($verb . ' ' . count($student_ids) . ' admit card(s).', 'success');
        redirect('admin/admit-cards');
    }

    public function institution_index()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        $per_page = 100;
        $page = max(1, (int) $this->input->get('page'));
        $students = $this->Admit_card_model->get_institution_students(
            $institution['school_code'],
            $per_page,
            ($page - 1) * $per_page
        );

        $data = array(
            'title' => 'Released Admit Cards',
            'students' => $students,
            'page' => $page,
            'has_more' => count($students) === $per_page
        );

        $this->load->view('institution/include/header');
        $this->load->view('institution/admit_cards', $data);
        $this->load->view('institution/include/footer');
    }

    public function download($student_id)
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        if (!ctype_digit((string) $student_id) || (int) $student_id < 1) {
            show_404();
            return;
        }

        $student = $this->Admit_card_model->get_released_student((int) $student_id, $institution['school_code']);
        if (!$student) {
            show_404();
            return;
        }

        $pdf = $this->render_admit_card_pdf($student);

        if (!$this->Admit_card_model->record_download(
            (int) $student['id'],
            (int) $institution['id'],
            $institution['school_code']
        )) {
            show_error('The admit card is no longer released. Refresh the list and try again.', 409);
            return;
        }

        $filename = preg_replace('/[^A-Za-z0-9._-]/', '_', $student['ref_no']);
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
        header('Content-Length: ' . strlen($pdf));
        echo $pdf;
    }

    public function admin_view($student_id)
    {
        $this->admin_admit_card_response($student_id, FALSE);
    }

    public function admin_download($student_id)
    {
        $this->admin_admit_card_response($student_id, TRUE);
    }

    private function admin_admit_card_response($student_id, $download)
    {
        if (!$this->require_admin()) {
            return;
        }

        if (!ctype_digit((string) $student_id) || (int) $student_id < 1) {
            show_404();
            return;
        }

        $student = $this->Admit_card_model->get_released_student((int) $student_id);
        if (!$student) {
            show_404();
            return;
        }

        $pdf = $this->render_admit_card_pdf($student);
        if (!$this->Admit_card_model->confirm_admin_view((int) $student['id'])) {
            show_error('The admit card is no longer released. Refresh the list and try again.', 409);
            return;
        }

        $filename = preg_replace('/[^A-Za-z0-9._-]/', '_', $student['ref_no']) . '.pdf';
        header('Content-Type: application/pdf');
        header('Content-Disposition: ' . ($download ? 'attachment' : 'inline') . '; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($pdf));
        header('Cache-Control: no-store, private');
        echo $pdf;
    }

    public function download_bulk()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $download_all = $this->input->post('download_all', TRUE) === '1';
        $students = array();
        $student_ids = array();

        if ($download_all) {
            $students = $this->Admit_card_model->get_all_institution_released_students($institution['school_code']);
            foreach ($students as $student) {
                $student_ids[] = (int) $student['id'];
            }
        } else {
            $posted_ids = $this->input->post('student_ids');
            if (!is_array($posted_ids)) {
                show_error('Select one or more released admit cards to download.', 400);
                return;
            }

            foreach ($posted_ids as $posted_id) {
                if (is_scalar($posted_id) && ctype_digit((string) $posted_id) && (int) $posted_id > 0) {
                    $student_ids[] = (int) $posted_id;
                }
            }
        }
        $student_ids = array_values(array_unique($student_ids));

        if (count($student_ids) === 0) {
            show_error('There are no released admit cards to include in the ZIP.', 400);
            return;
        }

        if (!$download_all && count($student_ids) > 100) {
            show_error('Select between 1 and 100 admit cards per ZIP download.', 400);
            return;
        }

        if (!$download_all) {
            foreach ($student_ids as $student_id) {
                $student = $this->Admit_card_model->get_released_student($student_id, $institution['school_code']);
                if (!$student) {
                    show_error('One or more selected cards are no longer released for this institution. Refresh the list and try again.', 409);
                    return;
                }
                $students[] = $student;
            }
        }

        if (!class_exists('ZipArchive')) {
            show_error('The PHP Zip extension is required for bulk admit-card downloads.', 500);
            return;
        }

        $zip_path = tempnam(sys_get_temp_dir(), 'jnrc_admit_cards_');
        if ($zip_path === FALSE) {
            show_error('A temporary ZIP file could not be created.', 500);
            return;
        }

        $zip = new ZipArchive();
        if ($zip->open($zip_path, ZipArchive::OVERWRITE) !== TRUE) {
            unlink($zip_path);
            show_error('The bulk admit-card ZIP could not be opened.', 500);
            return;
        }

        $downloads = array();
        foreach ($students as $student) {
            $filename = preg_replace('/[^A-Za-z0-9._-]/', '_', $student['ref_no']);
            $zip_filename = $filename . '_' . (int) $student['id'] . '.pdf';
            if (!$zip->addFromString($zip_filename, $this->render_admit_card_pdf($student))) {
                $zip->close();
                unlink($zip_path);
                show_error('An admit card could not be added to the bulk ZIP.', 500);
                return;
            }
            $downloads[] = array(
                'student_id' => (int) $student['id']
            );
        }

        if (!$zip->close()) {
            unlink($zip_path);
            show_error('The bulk admit-card ZIP could not be completed.', 500);
            return;
        }

        if (!$this->Admit_card_model->record_downloads(
            $downloads,
            (int) $institution['id'],
            $institution['school_code']
        )) {
            unlink($zip_path);
            show_error('One or more admit cards were withdrawn before the download completed. Refresh the list and try again.', 409);
            return;
        }

        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="jnrc_admit_cards.zip"');
        header('Content-Length: ' . filesize($zip_path));
        header('Cache-Control: no-store, private');
        readfile($zip_path);
        unlink($zip_path);
    }

    private function render_admit_card_pdf($student)
    {
        $qr = $this->released_qr_data_uri($student);
        if ($qr === '') {
            $token = bin2hex(random_bytes(32));
            $qr = $this->qr_data_uri(site_url('verify/admit-card/' . $token), $student, $token);
            if (
                $qr === ''
                || !$this->Admit_card_model->replace_active_verification_token(
                    (int) $student['id'],
                    hash('sha256', $token)
                )
            ) {
                show_error('The admit-card verification QR could not be saved. Refresh and try again.', 500);
                return '';
            }
        }

        $data = array(
            'row' => array($student),
            'subject_row' => $this->get_exam_subjects($student),
            'selected_center_name' => $student['name_center'],
            'logo_data_uri' => $this->image_data_uri(FCPATH . 'assets/images/logo_pdf.png'),
            'photo_data_uris' => array($student['id'] => $this->student_photo_data_uri($student)),
            'signature_data_uris' => array($student['id'] => $this->student_signature_data_uri($student)),
            'registrar_signature_uri' => $this->image_data_uri(FCPATH . 'uploads/signatures/registrarsignature.png'),
            'qr_data_uris' => array($student['id'] => $qr)
        );

        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
        $pdf = new \Dompdf\Dompdf();
        $pdf->load_html($this->load->view('admin/admit_card_layout', $data, TRUE));
        $pdf->set_paper('A4', 'portrait');
        $pdf->render();
        return $pdf->output();
    }

    public function verify($token)
    {
        $student = $this->get_verified_student($token);
        $photo = $student ? $this->get_public_student_photo($student) : NULL;
        $data = array(
            'is_valid' => (bool) $student,
            'student' => $student,
            'photo_url' => $photo ? site_url('verify/admit-card-photo/' . $token) : ''
        );

        $this->load->view('frontend/admit_card_verify', $data);
    }

    public function verification_photo($token)
    {
        $student = $this->get_verified_student($token);
        if (!$student) {
            show_404();
            return;
        }

        $photo = $this->get_public_student_photo($student);
        if (!$photo) {
            show_404();
            return;
        }

        header('Content-Type: ' . $photo['mime']);
        header('Cache-Control: no-store, private');
        header('X-Content-Type-Options: nosniff');
        readfile($photo['path']);
    }

    private function get_verified_student($token)
    {
        if (!is_string($token) || !preg_match('/\A[a-f0-9]{64}\z/', $token)) {
            return NULL;
        }

        return $this->Admit_card_model->get_verified_student(hash('sha256', $token));
    }

    private function qr_data_uri($url, $student, $token)
    {
        if (!function_exists('imagecreatetruecolor')) {
            show_error('PHP GD is required to generate admit-card QR codes.', 500);
            return '';
        }

        $matrix = Encoder::encode($url, ErrorCorrectionLevel::M())->getMatrix();
        $module_size = 5;
        $margin = 4;
        $size = ($matrix->getWidth() + ($margin * 2)) * $module_size;
        $image = imagecreatetruecolor($size, $size);
        if ($image === FALSE) {
            show_error('The admit-card QR image could not be created.', 500);
            return '';
        }

        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagefill($image, 0, 0, $white);

        for ($y = 0; $y < $matrix->getHeight(); $y++) {
            for ($x = 0; $x < $matrix->getWidth(); $x++) {
                if ($matrix->get($x, $y) === 1) {
                    $left = ($x + $margin) * $module_size;
                    $top = ($y + $margin) * $module_size;
                    imagefilledrectangle(
                        $image,
                        $left,
                        $top,
                        $left + $module_size - 1,
                        $top + $module_size - 1,
                        $black
                    );
                }
            }
        }

        ob_start();
        $written = imagepng($image);
        $png = ob_get_clean();
        imagedestroy($image);
        if (!$written || $png === FALSE) {
            show_error('The admit-card QR image could not be encoded.', 500);
            return '';
        }

        $directory = $this->student_upload_directory($student);
        if ($directory === FALSE) {
            show_error('The student upload folder could not be created for the admit-card QR image.', 500);
            return '';
        }

        $qr_filename = 'admit_card_qr_' . substr(hash('sha256', $token), 0, 16) . '.png';
        $qr_path = $directory . DIRECTORY_SEPARATOR . $qr_filename;
        $saved_bytes = file_put_contents($qr_path, $png, LOCK_EX);
        if ($saved_bytes === FALSE || $saved_bytes !== strlen($png)) {
            show_error('The admit-card QR image could not be saved in the student upload folder.', 500);
            return '';
        }

        return 'data:image/png;base64,' . base64_encode($png);
    }

    private function released_qr_data_uri($student)
    {
        $token_hash = isset($student['verification_token_hash']) ? $student['verification_token_hash'] : '';
        if (!preg_match('/\A[a-f0-9]{64}\z/', (string) $token_hash)) {
            return '';
        }

        $ref_no = isset($student['ref_no']) ? basename((string) $student['ref_no']) : '';
        if ($ref_no === '' || $ref_no === '.' || $ref_no === '..') {
            return '';
        }

        $path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'exam_form' . DIRECTORY_SEPARATOR
            . $ref_no . DIRECTORY_SEPARATOR
            . 'admit_card_qr_' . substr($token_hash, 0, 16) . '.png';
        return $this->image_data_uri($path);
    }

    private function student_upload_directory($student)
    {
        $ref_no = isset($student['ref_no']) ? (string) $student['ref_no'] : '';
        if (
            $ref_no === ''
            || $ref_no === '.'
            || $ref_no === '..'
            || basename($ref_no) !== $ref_no
            || strpos($ref_no, "\0") !== FALSE
        ) {
            return FALSE;
        }

        $upload_root = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'exam_form';
        if (!is_dir($upload_root) && !@mkdir($upload_root, 0755, TRUE) && !is_dir($upload_root)) {
            return FALSE;
        }

        $directory = $upload_root . DIRECTORY_SEPARATOR . $ref_no;
        if (!is_dir($directory) && !@mkdir($directory, 0755, TRUE) && !is_dir($directory)) {
            return FALSE;
        }

        $real_root = realpath($upload_root);
        $real_directory = realpath($directory);
        if (
            $real_root === FALSE
            || $real_directory === FALSE
            || strpos($real_directory, $real_root . DIRECTORY_SEPARATOR) !== 0
            || !is_writable($real_directory)
        ) {
            return FALSE;
        }

        return $real_directory;
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
            || $this->session->userdata('loginstatus') !== '1'
            || !is_numeric($school_id)
            || !is_string($school_code)
            || $school_code === ''
        ) {
            redirect('institution_login');
            return FALSE;
        }

        $institution = $this->db
            ->select('id, school_code, school_name')
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

    private function get_exam_subjects($student)
    {
        $subjects = $this->db
            ->where('course', $student['course'])
            ->order_by('exam_date', 'ASC')
            ->order_by('time', 'ASC')
            ->get('subjects_details_tb')
            ->result_array();

        if (in_array($student['course'], array('1st Year ANM', '1st Year GNM'), TRUE)) {
            return $subjects;
        }

        $selected = array();
        for ($number = 1; $number <= 8; $number++) {
            $field = 'sub_' . $number;
            if (!empty($student[$field])) {
                $selected[] = trim($student[$field]);
            }
        }

        return array_values(array_filter($subjects, function ($subject) use ($selected) {
            foreach ($selected as $selected_name) {
                if ($this->exam_subject_names_match($selected_name, $subject['subject_name'])) {
                    return TRUE;
                }
            }

            return FALSE;
        }));
    }

    private function exam_subject_names_match($selected_name, $scheduled_name)
    {
        $selected_name = trim((string) $selected_name);
        $scheduled_name = trim((string) $scheduled_name);

        if (
            preg_match('/\Apractical\s+(ii|i)\b/i', $selected_name, $selected_practical)
            && preg_match('/\Apractical\b.{0,32}?\b(ii|i)\b/i', $scheduled_name, $scheduled_practical)
        ) {
            return strcasecmp($selected_practical[1], $scheduled_practical[1]) === 0;
        }

        $normalize = function ($name) {
            $name = preg_replace('/\s*\(written\)\s*$/i', '', trim((string) $name));
            $name = strtolower($name);
            $name = preg_replace('/[^a-z0-9]+/', ' ', $name);
            return trim(preg_replace('/\s+/', ' ', $name));
        };

        return $normalize($selected_name) === $normalize($scheduled_name);
    }

    private function student_photo_data_uri($student)
    {
        return $this->image_data_uri($this->student_photo_path($student));
    }

    private function student_photo_path($student)
    {
        return $this->student_image_path($student, 'img1');
    }

    private function student_image_path($student, $field)
    {
        $ref_no = basename((string) $student['ref_no']);
        if (!in_array($field, array('img1', 'img2'), TRUE)) {
            return '';
        }

        $filename = basename((string) $student[$field]);
        if ($ref_no === '' || $filename === '.' || $filename === '..' || $filename === '') {
            return '';
        }

        return FCPATH . 'uploads/exam_form/' . $ref_no . DIRECTORY_SEPARATOR . $filename;
    }

    private function student_signature_data_uri($student)
    {
        return $this->image_data_uri($this->student_image_path($student, 'img2'));
    }

    private function get_public_student_photo($student)
    {
        $real_path = realpath($this->student_photo_path($student));
        $upload_root = realpath(FCPATH . 'uploads/exam_form');
        if (
            $real_path === FALSE
            || $upload_root === FALSE
            || strpos($real_path, $upload_root . DIRECTORY_SEPARATOR) !== 0
            || !is_file($real_path)
            || !is_readable($real_path)
        ) {
            return NULL;
        }

        $image_info = @getimagesize($real_path);
        if (!$image_info || !in_array($image_info['mime'], array('image/jpeg', 'image/png'), TRUE)) {
            return NULL;
        }

        return array('path' => $real_path, 'mime' => $image_info['mime']);
    }

    private function image_data_uri($path)
    {
        $real_path = realpath($path);
        if ($real_path === FALSE || !is_file($real_path) || !is_readable($real_path)) {
            return '';
        }

        $image_info = @getimagesize($real_path);
        if (!$image_info || !in_array($image_info['mime'], array('image/jpeg', 'image/png'), TRUE)) {
            return '';
        }

        return 'data:' . $image_info['mime'] . ';base64,' . base64_encode(file_get_contents($real_path));
    }

    private function set_message($message, $type)
    {
        $this->session->set_flashdata('admit_card_message', $message);
        $this->session->set_flashdata('admit_card_message_type', $type);
    }
}
