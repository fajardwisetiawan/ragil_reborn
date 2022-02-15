<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_admin') == '' || $this->session->userdata('status_admin') == null) {
            redirect('auth');
        }

        $this->load->helper(array('form', 'url', 'file'));

        $this->load->model("penjualan_model");
    }

    public function index()
    {
        $data = [   
            "app_name"  => "TOKO RAGIL 2 REBORN",
            "title"     => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "laporan"   => $this->penjualan_model->getAll(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("laporan/penjualan/index", $data);
        $this->load->view("component/footer", $data);
    }

    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Produk');
        $sheet->setCellValue('C1', 'Harga');
        $sheet->setCellValue('D1', 'Ukuran');
        $sheet->setCellValue('E1', 'Jumlah');
        $sheet->setCellValue('F1', 'Catatan');
        $sheet->setCellValue('G1', 'Waktu');
        
        $penjualan = $this->penjualan_model->getAll();
        $no = 1;
        $x = 2;
        foreach($penjualan as $row)
        {
            $sheet->setCellValue('A'.$x, $no++);
            $sheet->setCellValue('B'.$x, $row->nama_produk);
            $sheet->setCellValue('C'.$x, number_format($row->harga,2));
            $sheet->setCellValue('D'.$x, $row->ukuran);
            $sheet->setCellValue('E'.$x, $row->jumlah);
            $sheet->setCellValue('F'.$x, $row->catatan);
            $sheet->setCellValue('G'.$x, $row->created_at);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-penjualan';
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
