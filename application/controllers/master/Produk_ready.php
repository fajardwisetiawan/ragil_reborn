<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_ready extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') == '' || $this->session->userdata('status') == null) {
            $this->load->view('auth/login');
        }

        $this->load->helper(array('form', 'url', 'file'));

        $this->load->model("produk_ready_model");
    }

    public function index()
    {
        $data = [
            "app_name"  => "TOKO RAGIL 2 REBORN",
            "title"     => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "produk"    => $this->produk_ready_model->getAll(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("master/produk_ready/index", $data);
        $this->load->view("component/footer", $data);
    }

    public function add()
    {
        $nama       = $this->input->post("nama");
        $deskripsi  = $this->input->post("deskripsi");
        $harga      = $this->input->post("harga");
        $stok       = $this->input->post("stok");
        $ukuran     = $this->input->post("ukuran");
        $kategori   = $this->input->post("kategori");
        $gambar     = $this->input->post("gambar");

        $cek = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->get_where("m_produk_ready", ["nama" => $nama])
            ->row();
        if (!$cek) {

            if (!empty($_FILES["gambar"]["name"])) {
                $upload = $this->produk_ready_model->uploadGambar();

                if ($upload['result'] == "success") {
                    $dataInsert = [
                        "nama"          => $nama,
                        "deskripsi"     => $deskripsi,
                        "harga"         => $harga,
                        "stok"          => $stok,
                        "ukuran"        => $ukuran,
                        "kategori"      => $kategori,
                        "gambar"        => $upload['file']['file_name'],
                        "created_at"    => date("Y-m-d H:i:s"),
                        "created_by"    => $this->session->userdata('id'),
                    ];
        
                    $insert = $this->db->insert('m_produk_ready', $dataInsert);
        
                    if ($insert) {
                        $this->session->set_flashdata("sukses", "Berhasil menambahkan data produk ready!");
                    } else {
                        $this->session->set_flashdata("gagal", "Terjadi kesalahan saat menambahkan produk ready!");
                    }
                } else {
                    $this->session->set_flashdata('failed', $upload['error']);
                }
            } else {
                $dataInsert = [
                    "nama"          => $nama,
                    "deskripsi"     => $deskripsi,
                    "harga"         => $harga,
                    "stok"          => $stok,
                    "ukuran"        => $ukuran,
                    "kategori"      => $kategori,
                    "created_at"    => date("Y-m-d H:i:s"),
                    "created_by"    => $this->session->userdata('id'),
                ];
    
                $insert = $this->db->insert('m_produk_ready', $dataInsert);
    
                if ($insert) {
                    $this->session->set_flashdata("sukses", "Berhasil menambahkan data produk ready!");
                } else {
                    $this->session->set_flashdata("gagal", "Terjadi kesalahan saat menambahkan produk ready!");
                }
            }
        } else {
            $this->session->set_flashdata("gagal", "Maaf, produk ready sudah terdaftar!");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function getById($id = null)
    {
        $data = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->get_where("m_produk_ready", ["id" => $id])
            ->row();
        echo json_encode($data);
    }

    public function update()
    {
        $id         = $this->input->post("id_edit");
        $nama       = $this->input->post("nama_edit");
        $deskripsi  = $this->input->post("deskripsi_edit");
        $harga      = $this->input->post("harga_edit");
        $stok       = $this->input->post("stok_edit");
        $ukuran     = $this->input->post("ukuran_edit");
        $kategori   = $this->input->post("kategori_edit");
        $gambar     = $this->input->post("gambar_edit");


        $cekById = $this->db
                ->where('deleted_at IS NULL', null, false)
                ->get_where("m_produk_ready", ["id" => $id])
                ->row();

        if ($cekById->nama == $nama) {
            if (!empty($_FILES["gambar"]["name"])) {
                $upload         = $this->produk_ready_model->uploadGambar();
                $gambar_lama    = $this->input->post('gambar_lama', true);
                $path           = "./images/" . $gambar_lama;
    
                if ($upload['result'] == "success") {
                    $dataUpdate = [
                        "nama"          => $nama,
                        "deskripsi"     => $deskripsi,
                        "harga"         => $harga,
                        "stok"          => $stok,
                        "ukuran"        => $ukuran,
                        "kategori"      => $kategori,
                        "gambar"        => $upload['file']['file_name'],
                        "updated_at"    => date("Y-m-d H:i:s"),
                        "updated_by"    => $this->session->userdata('id'),
                    ];
        
                    $update = $this->db->update("m_produk_ready", $dataUpdate, ["id" => $id]);
                    $delete_file = unlink($path);
    
                    if ($update && $delete_file) {
                        $this->session->set_flashdata("sukses", "Berhasil memperbaharui data produk ready!");
                    } else {
                        $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data produk ready");
                    }
                } else {
                    $this->session->set_flashdata('failed', $upload['error']);
                }
            } else {
                $dataUpdate = [
                    "nama"          => $nama,
                    "deskripsi"     => $deskripsi,
                    "harga"         => $harga,
                    "stok"          => $stok,
                    "ukuran"        => $ukuran,
                    "kategori"      => $kategori,
                    "updated_at"    => date("Y-m-d H:i:s"),
                    "updated_by"    => $this->session->userdata('id'),
                ];
    
                $update = $this->db->update("m_produk_ready", $dataUpdate, ["id" => $id]);
                if ($update) {
                    $this->session->set_flashdata("sukses", "Berhasil memperbaharui data produk ready!");
                } else {
                    $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data produk ready");
                }
            }
        } else {
            $cekByNama = $this->db
                ->where('deleted_at IS NULL', null, false)
                ->get_where("m_produk_ready", ["nama" => $nama])
                ->row();
            if (!$cekByNama) {
                if (!empty($_FILES["gambar"]["name"])) {
                    $upload         = $this->produk_ready_model->uploadGambar();
                    $gambar_lama    = $this->input->post('gambar_lama', true);
                    $path           = "./images/" . $gambar_lama;
        
                    if ($upload['result'] == "success") {
                        $dataUpdate = [
                            "nama"          => $nama,
                            "deskripsi"     => $deskripsi,
                            "harga"         => $harga,
                            "stok"          => $stok,
                            "ukuran"        => $ukuran,
                            "kategori"      => $kategori,
                            "gambar"        => $upload['file']['file_name'],
                            "updated_at"    => date("Y-m-d H:i:s"),
                            "updated_by"    => $this->session->userdata('id'),
                        ];
            
                        $update = $this->db->update("m_produk_ready", $dataUpdate, ["id" => $id]);
                        $delete_file = unlink($path);
        
                        if ($update && $delete_file) {
                            $this->session->set_flashdata("sukses", "Berhasil memperbaharui data produk ready!");
                        } else {
                            $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data produk ready");
                        }
                    } else {
                        $this->session->set_flashdata('failed', $upload['error']);
                    }
                } else {
                    $dataUpdate = [
                        "nama"          => $nama,
                        "deskripsi"     => $deskripsi,
                        "harga"         => $harga,
                        "stok"          => $stok,
                        "ukuran"        => $ukuran,
                        "kategori"      => $kategori,
                        "updated_at"    => date("Y-m-d H:i:s"),
                        "updated_by"    => $this->session->userdata('id'),
                    ];
        
                    $update = $this->db->update("m_produk_ready", $dataUpdate, ["id" => $id]);
                    if ($update) {
                        $this->session->set_flashdata("sukses", "Berhasil memperbaharui data produk ready!");
                    } else {
                        $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data produk ready");
                    }
                }
            } else {
                $this->session->set_flashdata("gagal", "Maaf, produk ready sudah terdaftar!");
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete()
    {
        $id     = $this->input->post("id", TRUE);
        $cek    = $this->db
                ->get_where("m_produk_ready", ["id" => $id])
                ->row();
        if ($cek) {
            $dataDelete = [
                "deleted_at"    => date("Y-m-d H:i:s"),
                "deleted_by"    => $this->session->userdata('id'),
            ];
            $delete = $this->db->update("m_produk_ready", $dataDelete, ["id" => $id]);
            if ($delete) {
                echo json_encode([
                    'response_code'     => 200,
                    'response_message'  => 'Produk ready berhasil dihapus',
                ]);
            } else {
                echo json_encode([
                    'response_code'     => 400,
                    'response_message'  => 'Produk ready gagal dihapus',
                ]);
            }
        } else {
            echo json_encode([
                'response_code'     => 400,
                'response_message'  => 'Produk ready tidak ditemukan',
            ]);
        }
    }
}
