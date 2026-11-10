<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passed_out extends CI_Controller
{
    private $registration_types = array('ANM', 'GNM', 'B.Sc Nursing', 'Post Basic B.Sc Nursing', 'M.Sc Nursing');
    private $marital_statuses = array('Single', 'Married', 'Widow', 'Separated');
    private $categories = array('General', 'SC', 'ST', 'OBC');
    private $document_fields = array(
        'applicant_photo' => array('field' => 'applicant_photo', 'label' => 'Applicant Photograph', 'required' => TRUE),
        'applicant_signature' => array('field' => 'applicant_signature', 'label' => 'Applicant Signature', 'required' => TRUE),
        'tenth_marksheet' => array('field' => 'tenth_marksheet', 'label' => '10th Marksheet', 'required' => TRUE),
        'tenth_passing_certificate' => array('field' => 'tenth_passing_certificate', 'label' => '10th Passing Certificate', 'required' => TRUE),
        'twelfth_marksheet' => array('field' => 'twelfth_marksheet', 'label' => '12th Marksheet', 'required' => TRUE),
        'twelfth_passing_certificate' => array('field' => 'twelfth_passing_certificate', 'label' => '12th Passing Certificate', 'required' => TRUE),
        'aadhaar_card' => array('field' => 'aadhaar_card', 'label' => 'Aadhaar Card', 'required' => TRUE),
        'provisional_degree_diploma' => array('field' => 'provisional_degree_diploma', 'label' => 'Provisional Degree / Diploma', 'required' => TRUE),
        'nursing_admit_cards' => array('field' => 'nursing_admit_cards', 'label' => 'All Nursing Admit Cards (combine pages in one PDF)', 'required' => TRUE),
        'nursing_marksheets' => array('field' => 'nursing_marksheets', 'label' => 'All Nursing Marksheets (combine pages in one PDF)', 'required' => TRUE),
        'verification_report' => array('field' => 'verification_report', 'label' => 'Verification Report', 'required' => TRUE),
        'transfer_certificate' => array('field' => 'transfer_certificate', 'label' => 'Transfer Certificate', 'required' => TRUE),
        'course_completion_certificate' => array('field' => 'course_completion_certificate', 'label' => 'Course Completion Certificate', 'required' => TRUE),
        'other_supporting' => array('field' => 'other_supporting', 'label' => 'Other Supporting Document (optional)', 'required' => FALSE)
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->helper(array('url', 'form'));
        $this->load->model('Passed_out_model');
    }

    public function institution_index()
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        $page = max(1, (int) $this->input->get('page'));
        $limit = 50;
        $data = array(
            'title' => 'Passed-out Registration Forms',
            'records' => $this->Passed_out_model->get_institution_records(
                (int) $institution['id'],
                $institution['school_code'],
                $limit,
                ($page - 1) * $limit
            ),
            'page' => $page,
            'limit' => $limit,
            'message' => $this->session->flashdata('passed_out_message'),
            'message_type' => $this->session->flashdata('passed_out_message_type')
        );

        $this->load->view('institution/include/header');
        $this->load->view('institution/passed_out_records', $data);
        $this->load->view('institution/include/footer');
    }

    public function institution_form($record_id = 0)
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        $record = NULL;
        if ((int) $record_id > 0) {
            $record = $this->Passed_out_model->get_institution_record(
                (int) $record_id,
                (int) $institution['id'],
                $institution['school_code']
            );
            if (!$record || !in_array($record['status'], array('draft', 'rejected', 'revision_requested'), TRUE)) {
                show_404();
                return;
            }
        }

        $sessions = $this->Passed_out_model->get_sessions(TRUE);
        if ($record && !in_array($record['session_label_snapshot'], array_column($sessions, 'session_label'), TRUE)) {
            $sessions[] = array(
                'id' => 0,
                'session_label' => $record['session_label_snapshot'],
                'is_visible' => 0
            );
        }

        $data = array(
            'title' => $record ? 'Edit Registration Form' : 'New Registration Form',
            'record' => $record,
            'documents' => $record ? $this->Passed_out_model->get_record_documents($record['id']) : array(),
            'document_fields' => $this->document_fields,
            'sessions' => $sessions,
            'institution' => $institution,
            'registration_types' => $this->registration_types,
            'marital_statuses' => $this->marital_statuses,
            'categories' => $this->categories,
            'message' => $this->session->flashdata('passed_out_message'),
            'message_type' => $this->session->flashdata('passed_out_message_type')
        );

        $this->load->view('institution/include/header');
        $this->load->view('institution/passed_out_form', $data);
        $this->load->view('institution/include/footer');
    }

    public function institution_record($record_id)
    {
        $institution = $this->require_institution();
        if (!$institution) {
            return;
        }

        $record = $this->Passed_out_model->get_institution_record(
            (int) $record_id,
            (int) $institution['id'],
            $institution['school_code']
        );
        if (!$record) {
            show_404();
            return;
        }

        $this->load->view('institution/include/header');
        $this->load->view('institution/passed_out_record', array(
            'record' => $record,
            'documents' => $this->Passed_out_model->get_record_documents($record_id),
            'document_fields' => $this->document_fields
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
            show_404();
            return;
        }

        $posted_id = $this->input->post('record_id', TRUE);
        if (!is_scalar($posted_id) || !ctype_digit((string) $posted_id)) {
            $this->set_message('The registration form identifier is invalid.', 'warning');
            redirect('institution/passed-out');
            return;
        }
        $record_id = (int) $posted_id;
        $actor_id = $this->session->userdata('uid');
        $actor_id = is_numeric($actor_id) ? (int) $actor_id : NULL;
        $submit = $this->input->post('submit_action', TRUE) === 'submit';
        $fields = $this->get_form_fields();
        $error = $this->validate_form_fields($fields, $submit);
        if ($error !== '') {
            $this->set_message($error, 'danger');
            redirect($record_id > 0 ? 'institution/passed-out/edit/' . $record_id : 'institution/passed-out/new');
            return;
        }

        $existing_documents = array();
        if ($record_id > 0) {
            $existing_record = $this->Passed_out_model->get_institution_record(
                $record_id,
                (int) $institution['id'],
                $institution['school_code']
            );
            if (!$existing_record || !in_array($existing_record['status'], array('draft', 'rejected', 'revision_requested'), TRUE)) {
                show_404();
                return;
            }
            $existing_documents = $this->Passed_out_model->get_record_documents($record_id);
        }

        $upload_error = '';
        $documents = $this->upload_documents($upload_error);
        if ($upload_error !== '') {
            $this->remove_uploaded_documents($documents);
            $this->set_message($upload_error, 'danger');
            redirect($record_id > 0 ? 'institution/passed-out/edit/' . $record_id : 'institution/passed-out/new');
            return;
        }

        if ($submit) {
            $available = array();
            $missing = array();
            foreach ($existing_documents as $document) {
                $available[$document['document_type']] = TRUE;
            }
            foreach ($documents as $document_type => $document) {
                $available[$document_type] = TRUE;
            }
            foreach ($this->document_fields as $document_type => $definition) {
                if ($definition['required'] && !isset($available[$document_type])) {
                    $missing[] = $definition['label'];
                }
            }
            if (!empty($missing)) {
                $saved_draft = $this->Passed_out_model->save_institution_record(
                    $record_id,
                    $fields,
                    $documents,
                    $institution,
                    $actor_id,
                    FALSE
                );
                if (!$saved_draft) {
                    $this->remove_uploaded_documents($documents);
                    $this->set_message('The draft could not be saved. Please try again.', 'danger');
                    redirect($record_id > 0 ? 'institution/passed-out/edit/' . $record_id : 'institution/passed-out/new');
                    return;
                }

                $this->remove_replaced_documents($saved_draft['replaced_files']);
                $this->set_message(
                    'Saved as a draft. Attach the remaining required documents before submitting: ' . implode(', ', $missing) . '.',
                    'warning'
                );
                redirect('institution/passed-out/edit/' . (int) $saved_draft['id']);
                return;
            }
        }

        $saved_id = $this->Passed_out_model->save_institution_record(
            $record_id,
            $fields,
            $documents,
            $institution,
            $actor_id,
            $submit
        );
        if (!$saved_id) {
            $this->remove_uploaded_documents($documents);
            $this->set_message('The form could not be saved. It may have been submitted or approved, or the selected session is no longer available.', 'danger');
            redirect('institution/passed-out');
            return;
        }

        $this->remove_replaced_documents($saved_id['replaced_files']);
        $this->set_message(
            $submit ? 'Registration form submitted to JNRC for review.' : 'Registration form saved as a draft.',
            'success'
        );
        redirect('institution/passed-out');
    }

    public function admin_index()
    {
        if (!$this->require_admin()) {
            return;
        }

        $filters = array(
            'status' => $this->query_text('status'),
            'session' => $this->query_text('session'),
            'search' => $this->query_text('search')
        );
        if (!in_array($filters['status'], array('', 'submitted', 'approved', 'rejected', 'revision_requested', 'draft'), TRUE)) {
            $filters['status'] = '';
        }

        $limit = 50;
        $total = $this->Passed_out_model->count_admin_records($filters);
        $pages = max(1, (int) ceil($total / $limit));
        $page = min(max(1, (int) $this->input->get('page')), $pages);
        $data = array(
            'title' => 'Passed-out Registration Review',
            'filters' => $filters,
            'records' => $this->Passed_out_model->get_admin_records($filters, $limit, ($page - 1) * $limit),
            'total' => $total,
            'page' => $page,
            'pages' => $pages,
            'message' => $this->session->flashdata('passed_out_message'),
            'message_type' => $this->session->flashdata('passed_out_message_type')
        );

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/passed_out_review', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_export()
    {
        if (!$this->require_admin()) {
            return;
        }

        $start_date = $this->query_text('start_date');
        $end_date = $this->query_text('end_date');
        if (!$this->is_valid_date($start_date) || !$this->is_valid_date($end_date) || $start_date > $end_date) {
            show_error('Choose a valid start and end date for the export.', 400);
            return;
        }

        $filters = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'session' => $this->query_text('session'),
            'search' => $this->query_text('search'),
            'status' => $this->query_text('status')
        );
        if (!in_array($filters['status'], array('', 'submitted', 'approved', 'rejected', 'revision_requested', 'draft'), TRUE)) {
            $filters['status'] = '';
        }

        $rows = $this->Passed_out_model->get_admin_records_export($filters);

        $columns = array(
            'Record ID' => 'id',
            'Form No.' => 'form_number',
            'Registration No.' => 'registration_number',
            'Status' => 'status',
            'Created At' => 'created_at',
            'Submitted At' => 'submitted_at',
            'Reviewed At' => 'reviewed_at',
            'Passed-out Session' => 'session_label_snapshot',
            'Institution' => 'institution_name_snapshot',
            'Institution Code' => 'school_code',
            'Applicant Name' => 'full_name',
            "Father's Name" => 'father_name',
            'Marital Status' => 'marital_status',
            'Age' => 'age',
            'Date of Birth' => 'date_of_birth',
            'Identification' => 'identification',
            'Permanent Address' => 'permanent_address',
            'Present Address' => 'present_address',
            '10th School' => 'tenth_school',
            '10th Board' => 'tenth_board',
            '10th Roll No.' => 'tenth_roll_number',
            '10th Passing Year' => 'tenth_passing_year',
            '10th Marks' => 'tenth_marks_obtained',
            '10th Total Marks' => 'tenth_total_marks',
            '12th School' => 'twelfth_school',
            '12th Board' => 'twelfth_board',
            '12th Roll No.' => 'twelfth_roll_number',
            '12th Passing Year' => 'twelfth_passing_year',
            '12th Marks' => 'twelfth_marks_obtained',
            '12th Total Marks' => 'twelfth_total_marks',
            'Nursing Course' => 'registration_type',
            'Nursing Institution' => 'nursing_institution',
            'Nursing Council' => 'nursing_council',
            'Nursing Roll No.' => 'nursing_roll_number',
            'Nursing Enrollment No.' => 'nursing_enrollment_number',
            'Nursing Passing Year' => 'nursing_passing_year',
            'Nursing Marks' => 'nursing_marks_obtained',
            'Nursing Total Marks' => 'nursing_total_marks',
            'Last Semester / Year' => 'nursing_last_semester',
            'Professional Qualification' => 'professional_qualification',
            'Nationality' => 'nationality',
            'Religion' => 'religion',
            'Training From' => 'training_from',
            'Training To' => 'training_to',
            'Passing Month and Year' => 'passing_date',
            'Category' => 'category',
            'Qualifying Institution' => 'qualifying_institution',
            'Council / University' => 'qualifying_council',
            'Declaration Accepted' => 'declaration_accepted',
            'Declaration Date' => 'declaration_date',
            'Place' => 'declaration_place',
            'Contact No.' => 'contact_number',
            'Email' => 'email',
            'Aadhaar No.' => 'aadhaar_number',
            'Review Remark' => 'review_remark',
            'Attached Documents' => 'attached_documents'
        );

        $filename = 'passed-out-forms-' . $start_date . '-to-' . $end_date . '.xlsx';
        $export_path = $this->create_xlsx_export($columns, $rows);
        if ($export_path === FALSE) {
            show_error('Unable to create the Excel export. Check that the PHP Zip extension is enabled and writable temporary storage is available.', 500);
            return;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0, no-store, private');
        header('Content-Length: ' . filesize($export_path));
        readfile($export_path);
        unlink($export_path);
    }

    private function create_xlsx_export($columns, $rows)
    {
        if (!class_exists('ZipArchive')) {
            return FALSE;
        }

        $export_path = tempnam(sys_get_temp_dir(), 'jnrc_passed_out_');
        if ($export_path === FALSE) {
            return FALSE;
        }

        $sheet_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        $sheet_xml .= '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData>';
        $row_number = 1;
        $sheet_xml .= $this->xlsx_row_xml($row_number, array_keys($columns), 1);

        foreach ($rows as $record) {
            $row_number++;
            $values = array();
            foreach ($columns as $field) {
                $value = isset($record[$field]) ? $record[$field] : '';
                if ($field === 'declaration_accepted') {
                    $value = $value ? 'Yes' : 'No';
                }
                $values[] = (string) $value;
            }
            $sheet_xml .= $this->xlsx_row_xml($row_number, $values);
        }

        $sheet_xml .= '</sheetData></worksheet>';

        $workbook_files = array(
            '[Content_Types].xml' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
                . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
                . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
                . '<Default Extension="xml" ContentType="application/xml"/>'
                . '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
                . '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
                . '<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
                . '</Types>',
            '_rels/.rels' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
                . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
                . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>'
                . '</Relationships>',
            'xl/workbook.xml' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
                . '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" '
                . 'xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
                . '<sheets><sheet name="Passed-out Forms" sheetId="1" r:id="rId1"/></sheets></workbook>',
            'xl/_rels/workbook.xml.rels' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
                . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
                . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
                . '<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>'
                . '</Relationships>',
            'xl/worksheets/sheet1.xml' => $sheet_xml,
            'xl/styles.xml' => '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
                . '<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
                . '<fonts count="2"><font><sz val="11"/><name val="Calibri"/></font><font><b/><sz val="11"/><name val="Calibri"/></font></fonts>'
                . '<fills count="2"><fill><patternFill patternType="none"/></fill><fill><patternFill patternType="gray125"/></fill></fills>'
                . '<borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders>'
                . '<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
                . '<cellXfs count="2"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'
                . '<xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0" applyFont="1"/></cellXfs>'
                . '<cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles></styleSheet>'
        );

        $archive = new ZipArchive();
        if ($archive->open($export_path, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            unlink($export_path);
            return FALSE;
        }

        foreach ($workbook_files as $path => $contents) {
            if (!$archive->addFromString($path, $contents)) {
                $archive->close();
                unlink($export_path);
                return FALSE;
            }
        }

        if (!$archive->close()) {
            unlink($export_path);
            return FALSE;
        }

        return $export_path;
    }

    private function xlsx_row_xml($row_number, $values, $style_id = 0)
    {
        $row_xml = '<row r="' . $row_number . '">';
        foreach ($values as $column_index => $value) {
            $cell_reference = $this->excel_column_name($column_index) . $row_number;
            $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', (string) $value);
            $style = $style_id ? ' s="' . $style_id . '"' : '';
            $row_xml .= '<c r="' . $cell_reference . '"' . $style . ' t="inlineStr"><is><t xml:space="preserve">'
                . htmlspecialchars($value, ENT_QUOTES | ENT_XML1, 'UTF-8')
                . '</t></is></c>';
        }

        return $row_xml . '</row>';
    }

    private function excel_column_name($index)
    {
        $name = '';
        for ($index++; $index > 0; $index = intdiv($index - 1, 26)) {
            $name = chr(65 + (($index - 1) % 26)) . $name;
        }

        return $name;
    }

    public function admin_record($record_id)
    {
        if (!$this->require_admin()) {
            return;
        }

        $record = $this->Passed_out_model->get_admin_record((int) $record_id);
        if (!$record) {
            show_404();
            return;
        }

        $data = array(
            'title' => 'Review Registration Form',
            'record' => $record,
            'documents' => $this->Passed_out_model->get_record_documents($record_id),
            'document_fields' => $this->document_fields,
            'audit' => $this->Passed_out_model->get_record_audit((int) $record_id),
            'message' => $this->session->flashdata('passed_out_message'),
            'message_type' => $this->session->flashdata('passed_out_message_type')
        );
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/passed_out_record', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_review($record_id)
    {
        if (!$this->require_admin()) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $decision = $this->input->post('decision', TRUE);
        $posted_remark = $this->input->post('review_remark', FALSE);
        $remark = is_scalar($posted_remark) ? trim((string) $posted_remark) : '';
        if (
            !in_array($decision, array('approved', 'rejected', 'revision_requested'), TRUE)
            || strlen($remark) > 4000
            || ($decision !== 'approved' && $remark === '')
        ) {
            $this->set_message('Choose a valid decision. A remark is required when rejecting or requesting corrections.', 'warning');
            redirect('admin/passed-out/' . (int) $record_id);
            return;
        }

        $admin_id = $this->session->userdata('uid');
        $admin_id = is_numeric($admin_id) ? (int) $admin_id : NULL;
        if (!$this->Passed_out_model->review_record((int) $record_id, $decision, $remark, $admin_id)) {
            $this->set_message('Only a submitted form can be reviewed. Refresh the form and try again.', 'warning');
            redirect('admin/passed-out/' . (int) $record_id);
            return;
        }

        $this->set_message('Registration form marked ' . str_replace('_', ' ', $decision) . '.', 'success');
        redirect('admin/passed-out/' . (int) $record_id);
    }

    public function download_document($record_id, $document_id)
    {
        $record_id = (string) $record_id;
        $document_id = (string) $document_id;
        if (!ctype_digit($record_id) || !ctype_digit($document_id)) {
            show_404();
            return;
        }

        if ($this->session->userdata('role_admin') !== 'admin') {
            $institution = $this->require_institution();
            if (!$institution || !$this->Passed_out_model->get_institution_record(
                (int) $record_id,
                (int) $institution['id'],
                $institution['school_code']
            )) {
                show_404();
                return;
            }
        }

        $document = $this->Passed_out_model->get_document((int) $record_id, (int) $document_id);
        if (!$document || !preg_match('/\A[a-f0-9]{32}\.(?:jpg|jpeg|png|pdf)\z/i', $document['stored_filename'])) {
            show_404();
            return;
        }

        $storage_root = realpath(APPPATH . 'storage' . DIRECTORY_SEPARATOR . 'passed_out_records');
        $path = $storage_root
            ? realpath($storage_root . DIRECTORY_SEPARATOR . $document['stored_filename'])
            : FALSE;
        if (!$storage_root || !$path || dirname($path) !== $storage_root || !is_file($path) || !is_readable($path)) {
            show_404();
            return;
        }

        $mime = $document['mime_type'];
        if (!in_array($mime, array('application/pdf', 'image/jpeg', 'image/png'), TRUE)) {
            show_404();
            return;
        }
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($path));
        header('Content-Disposition: attachment; filename="passed-out-document-' . (int) $document['id'] . '"');
        header('Cache-Control: no-store, private');
        header('X-Content-Type-Options: nosniff');
        readfile($path);
    }

    public function admin_sessions()
    {
        if (!$this->require_admin()) {
            return;
        }

        $data = array(
            'title' => 'Passed-out Sessions',
            'sessions' => $this->Passed_out_model->get_sessions(FALSE),
            'message' => $this->session->flashdata('passed_out_message'),
            'message_type' => $this->session->flashdata('passed_out_message_type')
        );
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/sidebar');
        $this->load->view('admin/passed_out_sessions', $data);
        $this->load->view('admin/include/footer');
    }

    public function admin_save_session()
    {
        if (!$this->require_admin()) {
            return;
        }
        if ($this->input->method(TRUE) !== 'POST') {
            show_404();
            return;
        }

        $posted_session_id = $this->input->post('session_id', TRUE);
        if (!is_scalar($posted_session_id) || !ctype_digit((string) $posted_session_id)) {
            $this->set_message('The session identifier is invalid.', 'warning');
            redirect('admin/passed-out/sessions');
            return;
        }
        $session_id = (int) $posted_session_id;
        $action = $this->input->post('action', TRUE);
        if ($action === 'delete' || $action === 'toggle') {
            $ok = $action === 'delete'
                ? $this->Passed_out_model->delete_session($session_id)
                : $this->Passed_out_model->set_session_visibility($session_id, $this->input->post('is_visible') === '1');
            $this->set_message($ok ? 'Session updated.' : 'The session could not be updated.', $ok ? 'success' : 'danger');
            redirect('admin/passed-out/sessions');
            return;
        }

        $posted_label = $this->input->post('session_label', FALSE);
        $label = is_scalar($posted_label) ? trim((string) $posted_label) : '';
        if ($label === '' || strlen($label) > 100) {
            $this->set_message('Enter a session label of at most 100 characters.', 'warning');
            redirect('admin/passed-out/sessions');
            return;
        }

        $admin_id = $this->session->userdata('uid');
        $admin_id = is_numeric($admin_id) ? (int) $admin_id : NULL;
        $ok = $this->Passed_out_model->save_session(
            $session_id,
            $label,
            $this->input->post('is_visible') === '1',
            $admin_id
        );
        $this->set_message($ok ? 'Session saved.' : 'The session could not be saved.', $ok ? 'success' : 'danger');
        redirect('admin/passed-out/sessions');
    }

    private function get_form_fields()
    {
        $text_fields = array(
            'form_number', 'registration_number', 'session_label_snapshot',
            'full_name', 'father_name', 'marital_status', 'date_of_birth',
            'identification', 'permanent_address', 'present_address',
            'educational_qualification', 'roll_number', 'professional_qualification',
            'tenth_school', 'tenth_board', 'tenth_roll_number', 'tenth_passing_year',
            'tenth_marks_obtained', 'tenth_total_marks', 'twelfth_school', 'twelfth_board',
            'twelfth_roll_number', 'twelfth_passing_year', 'twelfth_marks_obtained',
            'twelfth_total_marks', 'nursing_institution', 'nursing_council',
            'nursing_roll_number', 'nursing_enrollment_number', 'nursing_passing_year',
            'nursing_marks_obtained', 'nursing_total_marks', 'nursing_last_semester',
            'nationality', 'religion', 'training_from', 'training_to', 'passing_date',
            'category', 'qualifying_council', 'registration_type', 'declaration_date',
            'declaration_place', 'contact_number', 'email', 'aadhaar_number'
        );
        $fields = array();
        foreach ($text_fields as $field) {
            $value = $this->input->post($field, FALSE);
            $fields[$field] = is_scalar($value) ? trim((string) $value) : '';
        }

        $age = $this->input->post('age', FALSE);
        $fields['age'] = ($age === NULL || $age === '')
            ? NULL
            : (is_scalar($age) && ctype_digit((string) $age) ? (int) $age : -1);
        $fields['qualifying_institution'] = $this->institution_field_value('qualifying_institution');
        $fields['declaration_accepted'] = $this->input->post('declaration_accepted') === '1' ? 1 : 0;
        foreach (array('form_number', 'registration_number', 'marital_status', 'date_of_birth', 'identification', 'present_address', 'educational_qualification', 'roll_number', 'professional_qualification', 'tenth_school', 'tenth_board', 'tenth_roll_number', 'tenth_passing_year', 'tenth_marks_obtained', 'tenth_total_marks', 'twelfth_school', 'twelfth_board', 'twelfth_roll_number', 'twelfth_passing_year', 'twelfth_marks_obtained', 'twelfth_total_marks', 'nursing_institution', 'nursing_council', 'nursing_roll_number', 'nursing_enrollment_number', 'nursing_passing_year', 'nursing_marks_obtained', 'nursing_total_marks', 'nursing_last_semester', 'nationality', 'religion', 'training_from', 'training_to', 'passing_date', 'category', 'qualifying_institution', 'qualifying_council', 'declaration_date', 'declaration_place', 'contact_number', 'email', 'aadhaar_number') as $optional) {
            if ($fields[$optional] === '') {
                $fields[$optional] = NULL;
            }
        }
        return $fields;
    }

    private function upload_documents(&$error)
    {
        $documents = array();
        $error = '';
        $directory = APPPATH . 'storage' . DIRECTORY_SEPARATOR . 'passed_out_records';

        if (!is_dir($directory) && !@mkdir($directory, 0750, TRUE) && !is_dir($directory)) {
            $error = 'The private document storage directory could not be created.';
            return $documents;
        }
        $real_directory = realpath($directory);
        $real_upload_root = realpath(APPPATH);
        if (
            $real_directory === FALSE
            || $real_upload_root === FALSE
            || strpos($real_directory, $real_upload_root . DIRECTORY_SEPARATOR) !== 0
            || !is_writable($real_directory)
        ) {
            $error = 'The private document storage directory is unavailable.';
            return $documents;
        }

        foreach ($this->document_fields as $document_type => $definition) {
            $field = $definition['field'];
            if (!isset($_FILES[$field])) {
                continue;
            }
            if (is_array($_FILES[$field]['name'])) {
                $error = 'Upload one image or PDF per document field.';
                break;
            }
            if ((int) $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            $config = array(
                'upload_path' => $real_directory . DIRECTORY_SEPARATOR,
                'allowed_types' => 'pdf|jpg|jpeg|png',
                'max_size' => 5120,
                'file_name' => bin2hex(random_bytes(16)),
                'file_ext_tolower' => TRUE,
                'remove_spaces' => TRUE,
                'detect_mime' => TRUE,
                'mod_mime_fix' => TRUE,
                'overwrite' => FALSE
            );
            $this->upload->initialize($config, TRUE);
            if (!$this->upload->do_upload($field)) {
                $error = strip_tags($this->upload->display_errors('', ''));
                break;
            }

            $uploaded = $this->upload->data();
            $mime = $this->validated_document_mime($uploaded['full_path']);
            $extension = strtolower(pathinfo($uploaded['file_name'], PATHINFO_EXTENSION));
            $expected_extensions = array(
                'application/pdf' => array('pdf'),
                'image/jpeg' => array('jpg', 'jpeg'),
                'image/png' => array('png')
            );
            if (
                $mime === FALSE
                || !isset($expected_extensions[$mime])
                || !in_array($extension, $expected_extensions[$mime], TRUE)
                || !preg_match('/\A[a-f0-9]{32}\.(?:jpg|jpeg|png|pdf)\z/i', $uploaded['file_name'])
            ) {
                @unlink($uploaded['full_path']);
                $error = 'Only valid PDF, JPEG, or PNG documents can be uploaded.';
                break;
            }

            $documents[$document_type] = array(
                'stored_filename' => $uploaded['file_name'],
                'original_filename' => basename($uploaded['orig_name']),
                'mime_type' => $mime,
                'file_size' => (int) $uploaded['file_size'] * 1024,
                'uploaded_at' => date('Y-m-d H:i:s')
            );
        }

        if ($error !== '') {
            $this->remove_uploaded_documents($documents);
            return array();
        }

        return $documents;
    }

    private function validated_document_mime($path)
    {
        if (!is_file($path) || !is_readable($path) || !function_exists('finfo_open')) {
            return FALSE;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (!$finfo) {
            return FALSE;
        }
        $mime = finfo_file($finfo, $path);
        finfo_close($finfo);

        if ($mime === 'application/pdf') {
            $handle = fopen($path, 'rb');
            $signature = $handle ? fread($handle, 5) : '';
            if ($handle) {
                fclose($handle);
            }
            return $signature === '%PDF-' ? $mime : FALSE;
        }

        $image = @getimagesize($path);
        if (!$image || !in_array($image['mime'], array('image/jpeg', 'image/png'), TRUE) || $image['mime'] !== $mime) {
            return FALSE;
        }

        return $mime;
    }

    private function remove_uploaded_documents($documents)
    {
        foreach ($documents as $document) {
            if (!empty($document['stored_filename'])) {
                $this->remove_private_document($document['stored_filename']);
            }
        }
    }

    private function remove_replaced_documents($filenames)
    {
        foreach ($filenames as $filename) {
            $this->remove_private_document($filename);
        }
    }

    private function remove_private_document($filename)
    {
        if (!preg_match('/\A[a-f0-9]{32}\.(?:jpg|jpeg|png|pdf)\z/i', $filename)) {
            return;
        }
        $root = realpath(APPPATH . 'storage' . DIRECTORY_SEPARATOR . 'passed_out_records');
        if ($root === FALSE) {
            return;
        }
        $path = realpath($root . DIRECTORY_SEPARATOR . $filename);
        if ($path && dirname($path) === $root && is_file($path)) {
            @unlink($path);
        }
    }

    private function institution_field_value($field)
    {
        $value = $this->input->post($field, FALSE);
        return is_scalar($value) ? trim((string) $value) : '';
    }

    private function validate_form_fields($fields, $submit)
    {
        $required = array(
            'full_name' => 'Applicant name',
            'father_name' => "Father's name",
            'session_label_snapshot' => 'Passed-out session',
            'permanent_address' => 'Permanent address',
            'registration_type' => 'Registration type'
        );
        foreach ($required as $field => $label) {
            if ($fields[$field] === '') {
                return $label . ' is required.';
            }
        }

        $limits = array(
            'form_number' => 50, 'registration_number' => 100, 'session_label_snapshot' => 100,
            'full_name' => 150, 'father_name' => 150, 'marital_status' => 30,
            'roll_number' => 100, 'nationality' => 100, 'religion' => 100,
            'training_from' => 30, 'training_to' => 30, 'category' => 30,
            'qualifying_institution' => 255, 'qualifying_council' => 255,
            'registration_type' => 100, 'declaration_place' => 150,
            'contact_number' => 30, 'email' => 190, 'aadhaar_number' => 12,
            'tenth_school' => 255, 'tenth_board' => 255, 'tenth_roll_number' => 100,
            'tenth_passing_year' => 10, 'tenth_marks_obtained' => 30, 'tenth_total_marks' => 30,
            'twelfth_school' => 255, 'twelfth_board' => 255, 'twelfth_roll_number' => 100,
            'twelfth_passing_year' => 10, 'twelfth_marks_obtained' => 30, 'twelfth_total_marks' => 30,
            'nursing_institution' => 255, 'nursing_council' => 255,
            'nursing_roll_number' => 100, 'nursing_enrollment_number' => 100,
            'nursing_passing_year' => 10, 'nursing_marks_obtained' => 30,
            'nursing_total_marks' => 30, 'nursing_last_semester' => 100,
            'tenth_marks_obtained' => 30, 'tenth_total_marks' => 30,
            'twelfth_marks_obtained' => 30, 'twelfth_total_marks' => 30
        );
        foreach ($limits as $field => $max) {
            if ($this->text_length((string) $fields[$field]) > $max) {
                return 'One or more values exceed the allowed field length.';
            }
        }
        foreach (array('identification' => 2000, 'permanent_address' => 2000, 'present_address' => 2000, 'educational_qualification' => 2000, 'professional_qualification' => 2000) as $field => $max) {
            if ($this->text_length((string) $fields[$field]) > $max) {
                return 'Address or qualification details may not exceed 2,000 characters.';
            }
        }
        if (!in_array($fields['registration_type'], $this->registration_types, TRUE)) {
            return 'Choose a valid registration type.';
        }
        if ($fields['marital_status'] !== NULL && !in_array($fields['marital_status'], $this->marital_statuses, TRUE)) {
            return 'Choose a valid marital status.';
        }
        if ($fields['category'] !== NULL && !in_array($fields['category'], $this->categories, TRUE)) {
            return 'Choose a valid category.';
        }
        if ($fields['age'] !== NULL && ($fields['age'] < 1 || $fields['age'] > 120)) {
            return 'Age must be between 1 and 120.';
        }
        foreach (array('date_of_birth', 'declaration_date') as $date_field) {
            if ($fields[$date_field] !== NULL && !$this->is_valid_date($fields[$date_field])) {
                return 'Enter valid dates using the date picker.';
            }
        }
        if ($fields['passing_date'] !== NULL && !$this->is_valid_month($fields['passing_date'])) {
            return 'Enter a valid passing month and year using the month picker.';
        }
        if ($fields['email'] !== NULL && !filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            return 'Enter a valid email address.';
        }
        if ($fields['contact_number'] !== NULL && !preg_match('/\A[0-9+() \-]{7,30}\z/', $fields['contact_number'])) {
            return 'Enter a valid contact number.';
        }
        if ($fields['aadhaar_number'] !== NULL && !preg_match('/\A[0-9]{12}\z/', $fields['aadhaar_number'])) {
            return 'Aadhaar number must contain exactly 12 digits.';
        }
        if ($submit && $fields['declaration_accepted'] !== 1) {
            return 'Confirm the applicant declaration before submitting for review.';
        }
        return '';
    }

    private function query_text($key)
    {
        $value = $this->input->get($key, TRUE);
        return is_scalar($value) ? trim((string) $value) : '';
    }

    private function is_valid_date($value)
    {
        $date = DateTime::createFromFormat('!Y-m-d', $value);
        return $date && $date->format('Y-m-d') === $value;
    }

    private function is_valid_month($value)
    {
        return (bool) preg_match('/\A[0-9]{4}-(0[1-9]|1[0-2])\z/', $value);
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

        $institution = $this->db->select('id, school_code, school_name, address')
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

    private function set_message($message, $type)
    {
        $this->session->set_flashdata('passed_out_message', $message);
        $this->session->set_flashdata('passed_out_message_type', $type);
    }
}
