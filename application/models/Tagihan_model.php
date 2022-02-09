<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model
{
    public function getAll()
    {
        return $this->db
            ->order_by("id", "DESC")
            ->limit(30)
            ->where('deleted_at IS NULL', null, false)
            ->get_where("tr_tagihan")
            ->result();
    }

    public function getPemesanan($id_tagihan)
    {
        return $this->db
            ->select([
                "tr_pemesanan.*",
                "m_produk.nama AS nama_produk",
            ])
            ->join("m_produk", "tr_pemesanan.id_produk = m_produk.id", "LEFT")
            ->where('tr_pemesanan.deleted_at IS NULL', null, false)
            ->get_where("tr_pemesanan", ["tr_pemesanan.id_tagihan" => $id_tagihan])
            ->result();
    }
}