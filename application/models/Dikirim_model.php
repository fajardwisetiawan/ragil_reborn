<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dikirim_model extends CI_Model
{
    public function getAll()
    {
        $data = $this->db
                ->select([
                    "tr_pemesanan.*",
                    "m_produk_ready.nama AS nama_produk_ready",
                    "m_produk_preorder.nama AS nama_produk_preorder",
                    "m_user.nama AS nama_user"
                ])
                ->join("m_produk_ready", "tr_pemesanan.id_produk = m_produk_ready.id AND tr_pemesanan.jenis_pemesanan = 'READY'", "LEFT")
                ->join("m_produk_preorder", "tr_pemesanan.id_produk = m_produk_preorder.id AND tr_pemesanan.jenis_pemesanan = 'PREORDER'", "LEFT")
                ->join("m_user", "tr_pemesanan.id_user = m_user.id", "LEFT")
                ->where('tr_pemesanan.deleted_at IS NULL', null, false)
                ->get_where("tr_pemesanan", ["tr_pemesanan.status_pemesanan" => "DIKIRIM"])
                ->result();
        return $data;
    }
}