<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('status_admin') == '' || $this->session->userdata('status_admin') == null) {
            $this->load->view('auth/index');
        } else {
            redirect("dashboard");
        }
    }

    public function login_proses()
    {
        $username   = $this->input->post('username', true);
        $password   = md5($this->input->post('password', true));

        $getAdmin = $this->db
                ->get_where("m_admin", [
                    "username"  => $username,
                    "password"  => $password,
                ])
                ->row();
        
        if ($getAdmin) {
            $userData = [
                "id_admin"        => $getAdmin->id,
                "username_admin"  => $getAdmin->username,
                "nama_admin"      => $getAdmin->nama,
                "status_admin"    => "LOGIN",
            ];
            $this->session->set_userdata($userData);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('gagal', 'Username atau password salah');
            redirect("auth");
        }
    }

    public function logout_proses()
    {
        unset($_SESSION['id_admin']);
        unset($_SESSION['username_admin']);
        unset($_SESSION['nama_admin']);
        unset($_SESSION['status_admin']);
        // $this->session->sess_destroy();

        redirect("auth");
    }
}
