<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dikemas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') == '' || $this->session->userdata('status') == null) {
            $this->load->view('auth/login');
        }

        $this->load->helper(array('form', 'url', 'file'));

        $this->load->model("dikemas_model");
    }

    public function index()
    {
        $data = [   
            "app_name"      => "TOKO RAGIL 2 REBORN",
            "title"         => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "transaksi"     => $this->dikemas_model->getAll(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("transaksi/dikemas/index", $data);
        $this->load->view("component/footer", $data);
    }

    public function verifikasi_pengiriman()
    {
        $id     = $this->input->post("id", TRUE);
        $cek    = $this->db
                ->get_where("tr_pemesanan", ["id" => $id])
                ->row();
        if ($cek) {
            $dataVerifikasi = [
                "status_pemesanan"  => "DIKIRIM",
                "updated_at"        => date("Y-m-d H:i:s"),
                "updated_by"        => $this->session->userdata('id'),
            ];
            $verifikasi_pengiriman = $this->db->update("tr_pemesanan", $dataVerifikasi, ["id" => $id]);
            if ($verifikasi_pengiriman) {
                echo json_encode([
                    'response_code'     => 200,
                    'response_message'  => 'Pengiriman berhasil diverifikasi',
                ]);
            } else {
                echo json_encode([
                    'response_code'     => 400,
                    'response_message'  => 'Pengiriman gagal diverifikasi',
                ]);
            }
        } else {
            echo json_encode([
                'response_code'     => 400,
                'response_message'  => 'Pengiriman tidak ditemukan',
            ]);
        }
    }
}
