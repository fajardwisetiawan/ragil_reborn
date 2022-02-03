<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_ready_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->where('deleted_at IS NULL', null, false)->get("m_produk_ready")->result();
    }

    public function uploadGambar()
    {
        $id_admin   = $this->session->userdata('id');
        $newName    = time() . "_" . $id_admin;

        $config['upload_path']      = './images/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['file_name']        = $newName;
        $config['max_size']         = '2048';
        $config['remove_space']     = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
}