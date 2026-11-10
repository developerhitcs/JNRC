<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passed_out_model extends CI_Model
{
    private $required_document_types = array(
        'applicant_photo',
        'applicant_signature',
        'tenth_marksheet',
        'tenth_passing_certificate',
        'twelfth_marksheet',
        'twelfth_passing_certificate',
        'aadhaar_card',
        'provisional_degree_diploma',
        'nursing_admit_cards',
        'nursing_marksheets',
        'verification_report',
        'transfer_certificate',
        'course_completion_certificate'
    );

    public function get_sessions($visible_only = FALSE)
    {
        $this->db->select('id, session_label, is_visible, created_at, updated_at')
            ->from('passed_out_sessions');

        if ($visible_only) {
            $this->db->where('is_visible', 1);
        }

        return $this->db->order_by('session_label', 'DESC')->get()->result_array();
    }

    public function save_session($session_id, $label, $visible, $admin_id)
    {
        $now = date('Y-m-d H:i:s');
        $data = array(
            'session_label' => $label,
            'is_visible' => $visible ? 1 : 0,
            'updated_by' => $admin_id,
            'updated_at' => $now
        );

        if ($session_id > 0) {
            $exists = $this->db->where('id', $session_id)->limit(1)->get('passed_out_sessions')->row_array();
            if (!$exists) {
                return FALSE;
            }
            return $this->db->where('id', $session_id)->update('passed_out_sessions', $data);
        }

        $data['created_by'] = $admin_id;
        $data['created_at'] = $now;
        return $this->db->insert('passed_out_sessions', $data);
    }

    public function set_session_visibility($session_id, $visible)
    {
        $exists = $this->db->where('id', $session_id)->limit(1)->get('passed_out_sessions')->row_array();
        if (!$exists) {
            return FALSE;
        }
        return $this->db->where('id', $session_id)
            ->update('passed_out_sessions', array(
                'is_visible' => $visible ? 1 : 0,
                'updated_at' => date('Y-m-d H:i:s')
            ));
    }

    public function delete_session($session_id)
    {
        $exists = $this->db->where('id', $session_id)->limit(1)->get('passed_out_sessions')->row_array();
        if (!$exists) {
            return FALSE;
        }
        return $this->db->where('id', $session_id)->delete('passed_out_sessions');
    }

    public function has_visible_session($label)
    {
        return (bool) $this->db->where('session_label', $label)
            ->where('is_visible', 1)
            ->limit(1)
            ->get('passed_out_sessions')
            ->row_array();
    }

    public function get_institution_records($institution_id, $school_code, $limit, $offset)
    {
        return $this->db->select('id, form_number, registration_number, session_label_snapshot, full_name, father_name, registration_type, status, review_remark, updated_at')
            ->from('passed_out_records')
            ->where('institution_id', $institution_id)
            ->where('school_code', $school_code)
            ->order_by('updated_at', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result_array();
    }

    public function get_admin_records($filters, $limit, $offset = 0)
    {
        $this->build_admin_records_query($filters);
        return $this->db->select('id, form_number, registration_number, session_label_snapshot, institution_name_snapshot, school_code, full_name, father_name, registration_type, status, updated_at')
            ->order_by('updated_at', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result_array();
    }

    public function count_admin_records($filters)
    {
        $this->build_admin_records_query($filters);
        return (int) $this->db->count_all_results();
    }

    private function build_admin_records_query($filters)
    {
        $this->db->from('passed_out_records');

        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (!empty($filters['session'])) {
            $this->db->where('session_label_snapshot', $filters['session']);
        }

        if (!empty($filters['search'])) {
            $this->db->group_start()
                ->like('full_name', $filters['search'])
                ->or_like('father_name', $filters['search'])
                ->or_like('form_number', $filters['search'])
                ->or_like('registration_number', $filters['search'])
                ->or_like('school_code', $filters['search'])
                ->group_end();
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $end_exclusive = date('Y-m-d', strtotime($filters['end_date'] . ' +1 day')) . ' 00:00:00';
            $this->db->where('created_at >=', $filters['start_date'] . ' 00:00:00')
                ->where('created_at <', $end_exclusive);
        }
    }

    public function get_institution_record($record_id, $institution_id, $school_code)
    {
        return $this->db->where('id', $record_id)
            ->where('institution_id', $institution_id)
            ->where('school_code', $school_code)
            ->get('passed_out_records')
            ->row_array();
    }

    public function get_admin_record($record_id)
    {
        return $this->db->where('id', $record_id)->get('passed_out_records')->row_array();
    }

    public function get_record_audit($record_id)
    {
        return $this->db->select('actor_type, action, status_from, status_to, remark, created_at')
            ->from('passed_out_record_audit')
            ->where('record_id', $record_id)
            ->order_by('created_at', 'DESC')
            ->get()
            ->result_array();
    }

    public function get_record_documents($record_id)
    {
        return $this->db->select('id, record_id, document_type, original_filename, mime_type, file_size, uploaded_at')
            ->from('passed_out_record_documents')
            ->where('record_id', $record_id)
            ->order_by('document_type')
            ->get()
            ->result_array();
    }

    public function get_document($record_id, $document_id)
    {
        return $this->db->where('id', $document_id)
            ->where('record_id', $record_id)
            ->get('passed_out_record_documents')
            ->row_array();
    }

    public function get_admin_records_export($filters)
    {
        $this->build_admin_records_query($filters);
        $rows = $this->db->select('passed_out_records.*')
            ->order_by('created_at', 'ASC')
            ->get()
            ->result_array();

        if (empty($rows)) {
            return array();
        }

        $ids = array();
        foreach ($rows as $row) {
            $ids[] = (int) $row['id'];
        }
        $documents = $this->db->select('record_id, document_type')
            ->from('passed_out_record_documents')
            ->where_in('record_id', $ids)
            ->get()
            ->result_array();
        $document_types = array();
        foreach ($documents as $document) {
            $document_types[$document['record_id']][] = $document['document_type'];
        }
        foreach ($rows as &$row) {
            $row['attached_documents'] = isset($document_types[$row['id']])
                ? implode(', ', $document_types[$row['id']])
                : '';
        }
        unset($row);

        return $rows;
    }

    public function save_institution_record($record_id, $fields, $documents, $institution, $actor_id, $submit)
    {
        if ($submit && (int) $fields['declaration_accepted'] !== 1) {
            return FALSE;
        }

        $this->db->trans_begin();
        $now = date('Y-m-d H:i:s');
        $previous = NULL;

        if ($record_id > 0) {
            $previous = $this->db->query(
                "SELECT * FROM passed_out_records
                 WHERE id = ? AND institution_id = ? AND school_code = ?
                   AND status IN ('draft', 'rejected', 'revision_requested')
                 FOR UPDATE",
                array($record_id, $institution['id'], $institution['school_code'])
            )
                ->row_array();

            if (!$previous) {
                $this->db->trans_rollback();
                return FALSE;
            }

            if (
                $fields['session_label_snapshot'] !== $previous['session_label_snapshot']
                && !$this->has_visible_session($fields['session_label_snapshot'])
            ) {
                $this->db->trans_rollback();
                return FALSE;
            }

            $fields['status'] = $submit ? 'submitted' : 'draft';
            $fields['submitted_at'] = $submit ? $now : NULL;
            if ($submit) {
                $fields['reviewed_at'] = NULL;
                $fields['reviewed_by'] = NULL;
            }
            $fields['updated_by'] = $actor_id;
            $fields['updated_at'] = $now;
            $this->db->where('id', $record_id)
                ->where('institution_id', $institution['id'])
                ->where('school_code', $institution['school_code'])
                ->where_in('status', array('draft', 'rejected', 'revision_requested'))
                ->update('passed_out_records', $fields);
            $status_from = $previous['status'];
            $action = $submit
                ? (in_array($status_from, array('rejected', 'revision_requested'), TRUE) ? 'resubmitted' : 'submitted')
                : 'updated';
        } else {
            if (!$this->has_visible_session($fields['session_label_snapshot'])) {
                $this->db->trans_rollback();
                return FALSE;
            }

            $fields['institution_id'] = $institution['id'];
            $fields['school_code'] = $institution['school_code'];
            $fields['institution_name_snapshot'] = $institution['school_name'];
            $fields['status'] = $submit ? 'submitted' : 'draft';
            $fields['submitted_at'] = $submit ? $now : NULL;
            $fields['created_by'] = $actor_id;
            $fields['updated_by'] = $actor_id;
            $fields['created_at'] = $now;
            $fields['updated_at'] = $now;

            if (!$this->db->insert('passed_out_records', $fields)) {
                $this->db->trans_rollback();
                return FALSE;
            }

            $record_id = (int) $this->db->insert_id();
            $status_from = NULL;
            $action = $submit ? 'submitted' : 'created';
        }

        $existing_documents = $this->db->query(
            'SELECT * FROM passed_out_record_documents WHERE record_id = ? FOR UPDATE',
            array($record_id)
        )->result_array();
        $existing_by_type = array();
        foreach ($existing_documents as $document) {
            $existing_by_type[$document['document_type']] = $document;
        }

        if ($submit) {
            foreach ($this->required_document_types as $required_type) {
                if (!isset($documents[$required_type]) && !isset($existing_by_type[$required_type])) {
                    $this->db->trans_rollback();
                    return FALSE;
                }
            }
        }

        $replaced_files = array();
        foreach ($documents as $document_type => $document) {
            if (isset($existing_by_type[$document_type])) {
                $replaced_files[] = $existing_by_type[$document_type]['stored_filename'];
                $this->db->where('id', $existing_by_type[$document_type]['id'])
                    ->update('passed_out_record_documents', $document);
            } else {
                $document['record_id'] = $record_id;
                $document['document_type'] = $document_type;
                $this->db->insert('passed_out_record_documents', $document);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->add_audit(
            $record_id,
            'institution',
            $actor_id,
            $action,
            $status_from,
            $submit ? 'submitted' : 'draft',
            NULL,
            $now
        );

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return array('id' => $record_id, 'replaced_files' => $replaced_files);
    }

    public function review_record($record_id, $decision, $remark, $admin_id)
    {
        $this->db->trans_begin();
        $record = $this->db->query(
            'SELECT id, status FROM passed_out_records WHERE id = ? FOR UPDATE',
            array($record_id)
        )->row_array();

        if (!$record || $record['status'] !== 'submitted') {
            $this->db->trans_rollback();
            return FALSE;
        }

        $now = date('Y-m-d H:i:s');
        $this->db->where('id', $record_id)->where('status', 'submitted')
            ->update('passed_out_records', array(
                'status' => $decision,
                'review_remark' => $remark,
                'reviewed_at' => $now,
                'reviewed_by' => $admin_id,
                'updated_at' => $now
            ));

        $this->add_audit(
            $record_id,
            'admin',
            $admin_id,
            $decision,
            'submitted',
            $decision,
            $remark,
            $now
        );

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    private function add_audit($record_id, $actor_type, $actor_id, $action, $from, $to, $remark, $now)
    {
        return $this->db->insert('passed_out_record_audit', array(
            'record_id' => $record_id,
            'actor_type' => $actor_type,
            'actor_id' => $actor_id,
            'action' => $action,
            'status_from' => $from,
            'status_to' => $to,
            'remark' => $remark,
            'created_at' => $now
        ));
    }
}
