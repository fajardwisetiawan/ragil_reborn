<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Batal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_admin') == '' || $this->session->userdata('status_admin') == null) {
            redirect('auth');
        }

        $this->load->helper(array('form', 'url', 'file'));

        $this->load->model("batal_model");
    }

    public function index()
    {
        $data = [   
            "app_name"      => "TOKO RAGIL 2 REBORN",
            "title"         => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "transaksi"     => $this->batal_model->getAll(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("transaksi/batal/index", $data);
        $this->load->view("component/footer", $data);
    }
}
