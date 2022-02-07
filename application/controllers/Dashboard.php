<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') == '' || $this->session->userdata('status') == null) {
            redirect('auth');
        }

        $this->load->model("dashboard_model");
    }

    public function index()
    {
        $data = [
            "app_name"          => "TOKO RAGIL 2 REBORN",
            "title"             => strtoupper(str_replace("_", " ", $this->router->fetch_class())),
            'belum_bayar_today' => $this->dashboard_model->getSumBelumBayarToday(),
            'dikemas_today'     => $this->dashboard_model->getSumDikemasToday(),
            'dikirim_today'     => $this->dashboard_model->getSumDikirimToday(),
            'batal_today'       => $this->dashboard_model->getSumBatalToday(),

            'belum_bayar_all'   => $this->dashboard_model->getSumBelumBayarAll(),
            'dikemas_all'       => $this->dashboard_model->getSumDikemasAll(),
            'dikirim_all'       => $this->dashboard_model->getSumDikirimAll(),
            'batal_all'         => $this->dashboard_model->getSumBatalAll(),

            'bulan_ini'         => $this->dashboard_model->getThisMonth(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("dashboard/index", $data);
        $this->load->view("component/footer", $data);
    }
}
