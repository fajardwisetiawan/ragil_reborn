<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dikirim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') == '' || $this->session->userdata('status') == null) {
            $this->load->view('auth/login');
        }

        $this->load->helper(array('form', 'url', 'file'));

        $this->load->model("dikirim_model");
    }

    public function index()
    {
        $data = [   
            "app_name"      => "TOKO RAGIL 2 REBORN",
            "title"         => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "transaksi"     => $this->dikirim_model->getAll(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("transaksi/dikirim/index", $data);
        $this->load->view("component/footer", $data);
    }
}
