<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admit_card_model extends CI_Model
{
    public function get_filter_options()
    {
        return array(
            'sessions' => $this->db
                ->distinct()
                ->select('batch_session')
                ->order_by('batch_session', 'DESC')
                ->get('exam_form_tb')
                ->result_array(),
            'courses' => $this->db
                ->distinct()
                ->select('course')
                ->order_by('course')
                ->get('exam_form_tb')
                ->result_array(),
            'institutions' => $this->db
                ->distinct()
                ->select('c.school_code, c.school_name')
                ->from('exam_form_tb e')
                ->join('college_list c', 'c.school_code = e.issue_by', 'left')
                ->where('e.issue_by IS NOT NULL', NULL, FALSE)
                ->order_by('c.school_name')
                ->get()
                ->result_array(),
            'centers' => $this->db
                ->select('id, name_center')
                ->order_by('name_center')
                ->get('center_tb')
                ->result_array()
        );
    }

    public function count_admin_students($filters)
    {
        $this->build_admin_query($filters, TRUE);
        return (int) $this->db->count_all_results();
    }

    public function get_admin_students($filters, $limit, $offset)
    {
        $this->build_admin_query($filters, FALSE);
        return $this->db
            ->order_by('e.id', 'DESC')
            ->limit($limit, $offset)
            ->get()
            ->result_array();
    }

    public function get_institution_students($school_code, $limit, $offset)
    {
        return $this->db
            ->select('e.id, e.ref_no, e.batch_session, e.course, e.name, e.father_name, e.admit_card_roll_no, r.download_count')
            ->from('exam_form_tb e')
            ->join('admit_card_release r', 'r.student_id = e.id', 'inner')
            ->where('e.issue_by', $school_code)
            ->where('r.status', 'released')
            ->where('r.center_id IS NOT NULL', NULL, FALSE)
            ->order_by('e.batch_session', 'DESC')
            ->order_by('e.course')
            ->order_by('e.name')
            ->limit($limit, $offset)
            ->get()
            ->result_array();
    }

    public function get_released_student($student_id, $school_code = NULL)
    {
        $this->db
            ->select('e.*, c.school_name, c.id AS institution_id, r.status AS release_status, r.center_id, ct.name_center')
            ->select('(SELECT t.token_hash FROM admit_card_verification_token t WHERE t.student_id = e.id AND t.revoked_at IS NULL ORDER BY t.id DESC LIMIT 1) AS verification_token_hash', FALSE)
            ->from('exam_form_tb e')
            ->join('admit_card_release r', 'r.student_id = e.id', 'inner')
            ->join('college_list c', 'c.school_code = e.issue_by', 'left')
            ->join('center_tb ct', 'ct.id = r.center_id', 'left')
            ->where('e.id', $student_id)
            ->where('r.status', 'released');
        $this->db->where('r.center_id IS NOT NULL', NULL, FALSE);

        if ($school_code !== NULL) {
            $this->db->where('e.issue_by', $school_code);
        }

        return $this->db->get()->row_array();
    }

    public function get_release_candidates($student_ids)
    {
        return $this->db
            ->select('id, ref_no')
            ->where_in('id', $student_ids)
            ->get('exam_form_tb')
            ->result_array();
    }

    public function set_release_state($student_ids, $status, $admin_id, $center_id = NULL, $verification_tokens = array())
    {
        if ($status === 'released' && !$this->db->where('id', $center_id)->get('center_tb')->row_array()) {
            return FALSE;
        }

        if ($status === 'released') {
            foreach ($student_ids as $student_id) {
                if (
                    !isset($verification_tokens[$student_id])
                    || !preg_match('/\A[a-f0-9]{64}\z/', (string) $verification_tokens[$student_id])
                ) {
                    return FALSE;
                }
            }
        }

        $this->db->trans_begin();
        $now = date('Y-m-d H:i:s');

        foreach ($student_ids as $student_id) {
            $student = $this->db
                ->select('id')
                ->where('id', $student_id)
                ->get('exam_form_tb')
                ->row_array();

            if (!$student) {
                $this->db->trans_rollback();
                return FALSE;
            }

            $release = $this->db
                ->where('student_id', $student_id)
                ->get('admit_card_release')
                ->row_array();

            $release_data = array(
                'status' => $status,
                'updated_by' => $admin_id,
                'updated_at' => $now
            );

            if ($status === 'released') {
                $release_data['released_by'] = $admin_id;
                $release_data['released_at'] = $now;
                $release_data['center_id'] = $center_id;
            }

            if ($release) {
                $this->db->where('student_id', $student_id)
                    ->update('admit_card_release', $release_data);
            } else {
                $release_data['student_id'] = $student_id;
                $this->db->insert('admit_card_release', $release_data);
            }

            $this->db->insert('admit_card_audit', array(
                'student_id' => $student_id,
                'action' => $status,
                'actor_type' => 'admin',
                'actor_id' => $admin_id,
                'created_at' => $now
            ));

            if ($status === 'withdrawn') {
                $this->db->set('revoked_at', $now)
                    ->where('student_id', $student_id)
                    ->where('revoked_at IS NULL', NULL, FALSE)
                    ->update('admit_card_verification_token');
            } elseif ($status === 'released') {
                $this->db->set('revoked_at', $now)
                    ->where('student_id', $student_id)
                    ->where('revoked_at IS NULL', NULL, FALSE)
                    ->update('admit_card_verification_token');
                $this->db->insert('admit_card_verification_token', array(
                    'student_id' => $student_id,
                    'token_hash' => $verification_tokens[$student_id],
                    'created_at' => $now
                ));
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    public function record_download($student_id, $institution_id, $school_code)
    {
        return $this->record_downloads(
            array(array('student_id' => $student_id)),
            $institution_id,
            $school_code
        );
    }

    public function confirm_admin_view($student_id)
    {
        $this->db->trans_begin();
        $release = $this->db->query(
            'SELECT status FROM admit_card_release WHERE student_id = ? FOR UPDATE',
            array($student_id)
        )->row_array();

        if (!$release || $release['status'] !== 'released') {
            $this->db->trans_rollback();
            return FALSE;
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    public function replace_active_verification_token($student_id, $token_hash)
    {
        if (!preg_match('/\A[a-f0-9]{64}\z/', (string) $token_hash)) {
            return FALSE;
        }

        $this->db->trans_begin();
        $release = $this->db->query(
            'SELECT status FROM admit_card_release WHERE student_id = ? FOR UPDATE',
            array($student_id)
        )->row_array();

        if (!$release || $release['status'] !== 'released') {
            $this->db->trans_rollback();
            return FALSE;
        }

        $now = date('Y-m-d H:i:s');
        $this->db->set('revoked_at', $now)
            ->where('student_id', $student_id)
            ->where('revoked_at IS NULL', NULL, FALSE)
            ->update('admit_card_verification_token');
        $this->db->insert('admit_card_verification_token', array(
            'student_id' => $student_id,
            'token_hash' => $token_hash,
            'created_at' => $now
        ));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    public function record_downloads($downloads, $institution_id, $school_code)
    {
        if (empty($downloads)) {
            return FALSE;
        }

        $this->db->trans_begin();
        $student_ids = array();
        foreach ($downloads as $download) {
            $student_ids[] = (int) $download['student_id'];
        }
        $placeholders = implode(',', array_fill(0, count($student_ids), '?'));
        $releases = $this->db->query(
            'SELECT student_id, status FROM admit_card_release WHERE student_id IN (' . $placeholders . ') FOR UPDATE',
            $student_ids
        )->result_array();

        if (count($releases) !== count($student_ids)) {
            $this->db->trans_rollback();
            return FALSE;
        }

        foreach ($releases as $release) {
            if ($release['status'] !== 'released') {
                $this->db->trans_rollback();
                return FALSE;
            }
        }

        $now = date('Y-m-d H:i:s');
        foreach ($downloads as $download) {
            $student_id = (int) $download['student_id'];
            $this->db->insert('admit_card_download_log', array(
                'student_id' => $student_id,
                'institution_id' => $institution_id,
                'school_code' => $school_code,
                'downloaded_at' => $now
            ));

            $this->db->set('download_count', 'download_count + 1', FALSE)
                ->set('updated_at', $now)
                ->where('student_id', $student_id)
                ->where('status', 'released')
                ->update('admit_card_release');

            if ($this->db->affected_rows() !== 1) {
                $this->db->trans_rollback();
                return FALSE;
            }

            $this->db->insert('admit_card_audit', array(
                'student_id' => $student_id,
                'action' => 'downloaded',
                'actor_type' => 'institution',
                'actor_id' => $institution_id,
                'school_code' => $school_code,
                'created_at' => $now
            ));

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    public function get_verified_student($token_hash)
    {
        return $this->db
            ->select('e.id, e.ref_no, e.name, e.father_name, e.img1')
            ->from('admit_card_verification_token t')
            ->join('admit_card_release r', 'r.student_id = t.student_id', 'inner')
            ->join('exam_form_tb e', 'e.id = t.student_id', 'inner')
            ->where('t.token_hash', $token_hash)
            ->where('t.revoked_at IS NULL', NULL, FALSE)
            ->where('r.status', 'released')
            ->where('r.center_id IS NOT NULL', NULL, FALSE)
            ->get()
            ->row_array();
    }

    private function build_admin_query($filters, $count_only)
    {
        $select = $count_only
            ? 'COUNT(*) AS total'
            : 'e.id, e.ref_no, e.batch_session, e.course, e.issue_by, e.name, e.father_name, e.admit_card_roll_no, e.img1, c.school_name, r.status AS release_status, r.download_count, r.center_id, ct.name_center';

        $this->db
            ->select($select)
            ->from('exam_form_tb e')
            ->join('college_list c', 'c.school_code = e.issue_by', 'left')
            ->join('admit_card_release r', 'r.student_id = e.id', 'left')
            ->join('center_tb ct', 'ct.id = r.center_id', 'left');

        foreach (array('session' => 'e.batch_session', 'course' => 'e.course', 'institution' => 'e.issue_by') as $filter => $column) {
            if (isset($filters[$filter]) && $filters[$filter] !== '') {
                $this->db->where($column, $filters[$filter]);
            }
        }

        if (isset($filters['status']) && $filters['status'] !== '') {
            if ($filters['status'] === 'pending') {
                $this->db->group_start()
                    ->where('r.id IS NULL', NULL, FALSE)
                    ->or_where('r.status', 'pending')
                    ->group_end();
            } elseif ($filters['status'] === 'downloaded') {
                $this->db->where('r.status', 'released')->where('r.download_count >', 0);
            } else {
                $this->db->where('r.status', $filters['status']);
            }
        }

        if (isset($filters['search']) && $filters['search'] !== '') {
            $this->db->group_start()
                ->like('e.name', $filters['search'])
                ->or_like('e.ref_no', $filters['search'])
                ->or_like('e.admit_card_roll_no', $filters['search'])
                ->group_end();
        }
    }
}
