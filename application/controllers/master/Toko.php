<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') == '' || $this->session->userdata('status') == null) {
            redirect('auth');
        }

        $this->load->model("toko_model");
    }

    public function index()
    {
        $data = [
            "app_name"  => "TOKO RAGIL 2 REBORN",
            "title"     => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "toko"      => $this->toko_model->getAll(),
        ];

        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("master/toko/index", $data);
        $this->load->view("component/footer", $data);
    }

    public function save()
    {
        $alamat_lengkap = strtoupper($this->input->post("alamat_lengkap"));
        $nomor_wa       = $this->input->post("nomor_wa");
        $telepon        = $this->input->post("telepon");
        $email          = $this->input->post("email");

        $cek = $this->db
            ->get("m_toko")
            ->row();
        if (!$cek) {
            $dataInsert = [
                "alamat_lengkap"    => $alamat_lengkap,
                "nomor_wa"          => $nomor_wa,
                "telepon"           => $telepon,
                "email"             => $email,
                "created_at"        => date("Y-m-d H:i:s"),
                "created_by"        => $this->session->userdata('id'),
            ];

            $insert = $this->db->insert('m_toko', $dataInsert);

            if ($insert) {
                $this->session->set_flashdata("sukses", "Berhasil menambahkan data toko!");
            } else {
                $this->session->set_flashdata("gagal", "Terjadi kesalahan saat menambahkan toko!");
            }
        } else {
            $dataUpdate = [
                "alamat_lengkap"    => $alamat_lengkap,
                "nomor_wa"          => $nomor_wa,
                "telepon"           => $telepon,
                "email"             => $email,
                "updated_at"        => date("Y-m-d H:i:s"),
                "updated_by"        => $this->session->userdata('id'),
            ];

            $update = $this->db->update("m_toko", $dataUpdate);
            if ($update) {
                $this->session->set_flashdata("sukses", "Berhasil memperbaharui data toko!");
            } else {
                $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data toko");
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
