<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('status') == '' || $this->session->userdata('status') == null) {
            $this->load->view('auth/index');
        } else {
            redirect("dashboard");
        }
    }

    public function login_proses()
    {
        $username   = $this->input->post('username', true);
        $pass       = $this->input->post('password', true);

        $getAdmin = $this->db
                ->get_where("m_admin", [
                    "username"  => $username
                ])
                ->row()->count;

        $db2 = $this->load->database('pegasus', TRUE);
        $db2->select('*');
        $db2->from('master.user');
        $db2->where(array('username' => $username));
        $query      = $db2->get()->result_array();

        $decoded    = $this->decode($pass);
        $hashed     = $query[0]['password'];
        $crypt      = crypt($pass, $hashed);

        // die(json_encode($crypt . "=========" . $hashed));
        
        if ($crypt === $hashed) {
            $countUser = $this->db
                ->select("COUNT(id) as count")
                ->get_where("lpju.m_user", [
                    "username"  => $username
                ])
                ->row()->count;

            if ($countUser > 0) {

                $cekUser     = $this->db
                    ->get_where("lpju.m_user", [
                        "username"    => $username,
                    ])
                    ->row();

                $deleted_at = $cekUser->deleted_at;

                if ($deleted_at == null || $deleted_at == "") {
                    $username            = $cekUser->username;
                    $nama                = $cekUser->nama;
                    $role                = $cekUser->role;

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://app.smartsiklon.co.id/index.php/auth/login.json',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => 'username=KOMINFO&password=12345&mobile=1',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded'
                    ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    $json = json_decode($response, false);
                    $success = $json->success;

                    if ($success == true) {
                        $userData        = [
                            "username"          => $username,
                            "nama"              => $nama,
                            "role"              => $role,
                            "token"             => $json->token,
                            "user_id"           => $json->user->user_id
                        ];
                        $this->session->set_userdata($userData);
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata('failed', 'Gagal mendapatkan token');
                    redirect("auth");
                    }
                } else {
                    $this->session->set_flashdata('failed', 'User tidak ditemukan');
                    redirect("auth");
                }
            } else {
                $this->session->set_flashdata('failed', 'Akses ditolak');
                redirect("auth");
            }
        } else {
            $this->session->set_flashdata('failed', 'Username atau password salah');
            redirect("auth");
        }
    }

    public function logout_proses()
    {
        unset($_SESSION['username']);
        unset($_SESSION['nama']);
        unset($_SESSION['role']);
        $this->session->sess_destroy();

        redirect("http://eoffice.banyumaskab.go.id/logout");
    }
}
