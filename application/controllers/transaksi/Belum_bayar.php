<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Belum_bayar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_admin') == '' || $this->session->userdata('status_admin') == null) {
            redirect('auth');
        }

        $this->load->helper(array('form', 'url', 'file'));

        $this->load->model("belum_bayar_model");
    }

    public function index()
    {
        $data = [   
            "app_name"      => "TOKO RAGIL 2 REBORN",
            "title"         => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "transaksi"     => $this->belum_bayar_model->getAll(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("transaksi/belum_bayar/index", $data);
        $this->load->view("component/footer", $data);
    }

    public function verifikasi_pembayaran()
    {
        $id     = $this->input->post("id", TRUE);
        $cek    = $this->db
                ->get_where("tr_pemesanan", ["id" => $id])
                ->row();
        if ($cek) {
            $dataVerifikasi = [
                "status_pemesanan"  => "DIKEMAS",
                "updated_at"        => date("Y-m-d H:i:s"),
                "updated_by"        => $this->session->userdata('id_user'),
            ];
            $verifikasi_pembayaran = $this->db->update("tr_pemesanan", $dataVerifikasi, ["id" => $id]);
            if ($verifikasi_pembayaran) {
                echo json_encode([
                    'response_code'     => 200,
                    'response_message'  => 'Pemesanan berhasil diverifikasi',
                ]);
            } else {
                echo json_encode([
                    'response_code'     => 400,
                    'response_message'  => 'Pemesanan gagal diverifikasi',
                ]);
            }
        } else {
            echo json_encode([
                'response_code'     => 400,
                'response_message'  => 'Pemesanan tidak ditemukan',
            ]);
        }
    }
    
    public function batal_pembayaran()
    {
        $id     = $this->input->post("id", TRUE);
        $cek    = $this->db
                ->get_where("tr_pemesanan", ["id" => $id])
                ->row();
        if ($cek) {
            $dataBatal = [
                "status_pemesanan"  => "BATAL",
                "updated_at"        => date("Y-m-d H:i:s"),
                "updated_by"        => $this->session->userdata('id_user'),
            ];
            $batal_pembayaran = $this->db->update("tr_pemesanan", $dataBatal, ["id" => $id]);
            if ($batal_pembayaran) {
                echo json_encode([
                    'response_code'     => 200,
                    'response_message'  => 'Pemesanan berhasil dibatalkan',
                ]);
            } else {
                echo json_encode([
                    'response_code'     => 400,
                    'response_message'  => 'Pemesanan gagal dibatalkan',
                ]);
            }
        } else {
            echo json_encode([
                'response_code'     => 400,
                'response_message'  => 'Pemesanan tidak ditemukan',
            ]);
        }
    }
}
