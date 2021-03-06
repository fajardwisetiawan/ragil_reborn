<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_ready extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status_admin') == '' || $this->session->userdata('status_admin') == null) {
            redirect('auth');
        }

        $this->load->helper(array('form', 'url', 'file'));

        $this->load->model("produk_ready_model");
    }

    public function index()
    {
        $data = [   
            "app_name"      => "TOKO RAGIL 2 REBORN",
            "title"         => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "produk"        => $this->produk_ready_model->getAll(),
            "kategori"      => $this->produk_ready_model->getKategori(),
            "kategori_edit" => $this->produk_ready_model->getKategori(),
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
        $kategori   = $this->input->post("kategori");
        $gambar     = $this->input->post("gambar");

        $cek = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->get_where("m_produk", ["nama" => $nama, "jenis_barang"  => "READY"])
            ->row();
        if (!$cek) {

            if (!empty($_FILES["gambar"]["name"])) {
                $upload = $this->produk_ready_model->uploadGambar();

                if ($upload['result'] == "success") {
                    $dataInsert = [
                        "nama"          => $nama,
                        "deskripsi"     => $deskripsi,
                        "harga"         => $harga,
                        "id_kategori"   => $kategori,
                        "gambar"        => $upload['file']['file_name'],
                        "jenis_barang"  => "READY",
                        "created_at"    => date("Y-m-d H:i:s"),
                        "created_by"    => $this->session->userdata('id_user'),
                    ];
        
                    $insert = $this->db->insert('m_produk', $dataInsert);
        
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
                    "id_kategori"   => $kategori,
                    "jenis_barang"  => "READY",
                    "created_at"    => date("Y-m-d H:i:s"),
                    "created_by"    => $this->session->userdata('id_user'),
                ];
    
                $insert = $this->db->insert('m_produk', $dataInsert);
    
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
            ->get_where("m_produk", ["id" => $id])
            ->row();
        echo json_encode($data);
    }

    public function update()
    {
        $id         = $this->input->post("id_edit");
        $nama       = $this->input->post("nama_edit");
        $deskripsi  = $this->input->post("deskripsi_edit");
        $harga      = $this->input->post("harga_edit");
        $kategori   = $this->input->post("kategori_edit");

        $cekById = $this->db
                ->where('deleted_at IS NULL', null, false)
                ->get_where("m_produk", ["id" => $id])
                ->row();

        if ($cekById->nama == $nama) {
            if (!empty($_FILES["gambar_edit"]["name"])) {
                $upload         = $this->produk_ready_model->uploadGambarEdit();
                $gambar_lama    = $this->input->post('gambar_lama', true);
                $path           = "./images/" . $gambar_lama;
    
                if ($upload['result'] == "success") {
                    $dataUpdate = [
                        "nama"          => $nama,
                        "deskripsi"     => $deskripsi,
                        "harga"         => $harga,
                        "id_kategori"   => $kategori,
                        "gambar"        => $upload['file']['file_name'],
                        "updated_at"    => date("Y-m-d H:i:s"),
                        "updated_by"    => $this->session->userdata('id_user'),
                    ];
        
                    $update = $this->db->update("m_produk", $dataUpdate, ["id" => $id]);
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
                    "id_kategori"   => $kategori,
                    "updated_at"    => date("Y-m-d H:i:s"),
                    "updated_by"    => $this->session->userdata('id_user'),
                ];
    
                $update = $this->db->update("m_produk", $dataUpdate, ["id" => $id]);
                if ($update) {
                    $this->session->set_flashdata("sukses", "Berhasil memperbaharui data produk ready!");
                } else {
                    $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data produk ready");
                }
            }
        } else {
            $cekByNama = $this->db
                ->where('deleted_at IS NULL', null, false)
                ->get_where("m_produk", ["nama" => $nama])
                ->row();
            if (!$cekByNama) {
                if (!empty($_FILES["gambar_edit"]["name"])) {
                    $upload         = $this->produk_ready_model->uploadGambarEdit();
                    $gambar_lama    = $this->input->post('gambar_lama', true);
                    $path           = "./images/" . $gambar_lama;
        
                    if ($upload['result'] == "success") {
                        $dataUpdate = [
                            "nama"          => $nama,
                            "deskripsi"     => $deskripsi,
                            "harga"         => $harga,
                            "id_kategori"   => $kategori,
                            "gambar"        => $upload['file']['file_name'],
                            "updated_at"    => date("Y-m-d H:i:s"),
                            "updated_by"    => $this->session->userdata('id_user'),
                        ];
            
                        $update = $this->db->update("m_produk", $dataUpdate, ["id" => $id]);
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
                        "id_kategori"   => $kategori,
                        "updated_at"    => date("Y-m-d H:i:s"),
                        "updated_by"    => $this->session->userdata('id_user'),
                    ];
        
                    $update = $this->db->update("m_produk", $dataUpdate, ["id" => $id]);
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
                ->get_where("m_produk", ["id" => $id])
                ->row();
        if ($cek) {
            $dataDelete = [
                "deleted_at"    => date("Y-m-d H:i:s"),
                "deleted_by"    => $this->session->userdata('id_user'),
            ];
            $delete = $this->db->update("m_produk", $dataDelete, ["id" => $id]);
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

    public function detail($id_produk = null)
    {
        $data = [   
            "app_name"      => "TOKO RAGIL 2 REBORN",
            "title"         => ucwords(str_replace("_", " ", $this->router->fetch_class())),
            "produk"        => $this->produk_ready_model->getStok($id_produk),
            "ukuran"        => $this->produk_ready_model->getUkuran(),
            "ukuran_edit"   => $this->produk_ready_model->getUkuran(),
        ];

        // die(json_encode($data));
        $this->load->view("component/header", $data);
        $this->load->view("component/sidebar", $data);
        $this->load->view("master/produk_ready/detail", $data);
        $this->load->view("component/footer", $data);
    }

    public function add_detail()
    {
        $id_produk  = $this->input->post("id_produk");
        $ukuran     = $this->input->post("ukuran");
        $stok       = $this->input->post("stok");

        $cek = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->get_where("m_stok", ["id_produk" => $id_produk, "id_ukuran" => $ukuran])
            ->row();

        if (!$cek) {
            $dataInsert = [
                "id_produk"     => $id_produk,
                "id_ukuran"     => $ukuran,
                "stok"          => $stok,
                "created_at"    => date("Y-m-d H:i:s"),
                "created_by"    => $this->session->userdata('id_user'),
            ];

            $insert = $this->db->insert('m_stok', $dataInsert);

            if ($insert) {
                $this->session->set_flashdata("sukses", "Berhasil menambahkan data stok!");
            } else {
                $this->session->set_flashdata("gagal", "Terjadi kesalahan saat menambahkan stok!");
            }
        } else {
            $this->session->set_flashdata("gagal", "Maaf, stok sudah terdaftar!");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function getDetailById($id = null)
    {
        $data = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->get_where("m_stok", ["id" => $id])
            ->row();
        echo json_encode($data);
    }

    public function update_detail()
    {
        $id         = $this->input->post("id_edit");
        $id_produk  = $this->input->post("id_produk_edit");
        $ukuran     = $this->input->post("ukuran_edit");
        $stok       = $this->input->post("stok_edit");

        $cekById = $this->db
                ->where('deleted_at IS NULL', null, false)
                ->get_where("m_stok", ["id" => $id])
                ->row();

        if ($cekById->id_produk == $id_produk && $cekById->id_ukuran == $ukuran) {
            $dataUpdate = [
                "id_produk"     => $id_produk,
                "id_ukuran"     => $ukuran,
                "stok"          => $stok,
                "updated_at"    => date("Y-m-d H:i:s"),
                "updated_by"    => $this->session->userdata('id_user'),
            ];

            $update = $this->db->update("m_stok", $dataUpdate, ["id" => $id]);
            if ($update) {
                $this->session->set_flashdata("sukses", "Berhasil memperbaharui data stok!");
            } else {
                $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data stok");
            }
        } else {
            $cekByUkuran = $this->db
                ->where('deleted_at IS NULL', null, false)
                ->get_where("m_stok", ["id_produk" => $id_produk, "id_ukuran" => $ukuran])
                ->row();
            if (!$cekByUkuran) {
                $dataUpdate = [
                    "id_produk"     => $id_produk,
                    "id_ukuran"     => $ukuran,
                    "stok"          => $stok,
                    "updated_at"    => date("Y-m-d H:i:s"),
                    "updated_by"    => $this->session->userdata('id_user'),
                ];
    
                $update = $this->db->update("m_stok", $dataUpdate, ["id" => $id]);
                if ($update) {
                    $this->session->set_flashdata("sukses", "Berhasil memperbaharui data stok!");
                } else {
                    $this->session->set_flashdata("gagal", "Terjadi kesalahan saat mengubah data stok");
                }
            } else {
                $this->session->set_flashdata("gagal", "Maaf, stok sudah terdaftar!");
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_detail()
    {
        $id     = $this->input->post("id", TRUE);
        $cek    = $this->db
                ->get_where("m_stok", ["id" => $id])
                ->row();
        if ($cek) {
            $dataDelete = [
                "deleted_at"    => date("Y-m-d H:i:s"),
                "deleted_by"    => $this->session->userdata('id_user'),
            ];
            $delete = $this->db->update("m_stok", $dataDelete, ["id" => $id]);
            if ($delete) {
                echo json_encode([
                    'response_code'     => 200,
                    'response_message'  => 'Stok berhasil dihapus',
                ]);
            } else {
                echo json_encode([
                    'response_code'     => 400,
                    'response_message'  => 'Stok gagal dihapus',
                ]);
            }
        } else {
            echo json_encode([
                'response_code'     => 400,
                'response_message'  => 'Stok tidak ditemukan',
            ]);
        }
    }
}
