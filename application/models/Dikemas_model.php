<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dikemas_model extends CI_Model
{
    public function getAll()
    {
        $data = $this->db
                ->select([
                    "tr_pemesanan.*",
                    "m_produk.nama AS nama_produk",
                    "m_user.nama AS nama_user"
                ])
                ->join("m_produk", "tr_pemesanan.id_produk = m_produk.id", "LEFT")
                ->join("m_user", "tr_pemesanan.id_user = m_user.id", "LEFT")
                ->where('tr_pemesanan.deleted_at IS NULL', null, false)
                ->get_where("tr_pemesanan", ["tr_pemesanan.status_pemesanan" => "DIKEMAS"])
                ->result();
        return $data;
    }
}