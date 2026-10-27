<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function validate_token()
    {
        $token = $this->input->get('token');

        if (!$token) {
            show_error('Token missing', 400);
        }

        // Fetch token record
        $query = $this->db->get_where('auth_tokens', ['token' => $token]);
        $row = $query->row();

        if (!$row) {
            show_error('Invalid token', 401);
        }

        // Check if expired
        if (strtotime($row->expires_at) < time()) {
            show_error('Token expired', 401);
        }

        // Check if already used
        if ($row->used) {
            show_error('Token already used', 401);
        }

        // Mark token as used (VERY IMPORTANT)
        $this->db->where('token', $token)
                 ->update('auth_tokens', ['used' => 1]);

        // OPTIONAL: fetch user details
        $user = $this->db
            ->get_where('super_admin', ['id' => $row->user_id])
            ->row();

        if (!$user) {
            show_error('User not found', 404);
        }

        // Create session
        // $this->session->set_userdata([
        //     'user_id'  => $user->id,
        //     'username' => $user->username,
        //     'role'     => $user->role,
        //     'logged_in' => true
        // ]);
        
          $this->session->set_userdata([
                    'uid'         => $user->id,
                    'email'       => '',
                    'username'    => $user->username,
                    'first_name'  => 'Super',
                    'last_name'   => 'Admin',
                    'loginstatus' => 1,
                    'role_admin'  => 'admin'
                ]);

        // Redirect to dashboard
        redirect('admin');
    }
}

?>