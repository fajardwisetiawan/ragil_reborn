<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getSumBelumBayarToday()
    {
        $today  = date("Y-m-d");
        $todayX = $today . " 00:00:00";
        $todayY = $today . " 23:59:59";

        $data = $this->db
            ->where([
                "status_pemesanan"  => "BELUM_BAYAR",
                "created_at >="     => $todayX,
                "created_at <="     => $todayY
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getSumDikemasToday()
    {
        $today  = date("Y-m-d");
        $todayX = $today . " 00:00:00";
        $todayY = $today . " 23:59:59";

        $data = $this->db
            ->where([
                "status_pemesanan"  => "DIKEMAS",
                "created_at >="     => $todayX,
                "created_at <="     => $todayY
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getSumDikirimToday()
    {
        $today  = date("Y-m-d");
        $todayX = $today . " 00:00:00";
        $todayY = $today . " 23:59:59";

        $data = $this->db
            ->where([
                "status_pemesanan"  => "DIKIRIM",
                "created_at >="     => $todayX,
                "created_at <="     => $todayY
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getSumBatalToday()
    {
        $today  = date("Y-m-d");
        $todayX = $today . " 00:00:00";
        $todayY = $today . " 23:59:59";

        $data = $this->db
            ->where([
                "status_pemesanan"  => "BATAL",
                "created_at >="     => $todayX,
                "created_at <="     => $todayY
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getSumBelumBayarAll()
    {
        $data = $this->db
            ->where([
                "status_pemesanan"  => "BELUM_BAYAR",
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getSumDikemasAll()
    {
        $data = $this->db
            ->where([
                "status_pemesanan"  => "DIKEMAS",
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getSumDikirimAll()
    {
        $data = $this->db
            ->where([
                "status_pemesanan"  => "DIKIRIM",
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getSumBatalAll()
    {
        $data = $this->db
            ->where([
                "status_pemesanan"  => "BATAL",
            ])
            ->get("tr_pemesanan")
            ->result();
        return count($data);
    }

    public function getThisMonth()
    {
        $date = date('Y-m');
        $data = $this->db
            ->select([
                "m_produk_ready.nama AS nama_produk_ready",
                "m_produk_preorder.nama AS nama_produk_preorder",
                "SUM(jumlah) as total",
            ])
            ->join("m_produk_ready", "tr_pemesanan.id_produk = m_produk_ready.id AND tr_pemesanan.jenis_pemesanan = 'READY'", "LEFT")
            ->join("m_produk_preorder", "tr_pemesanan.id_produk = m_produk_preorder.id AND tr_pemesanan.jenis_pemesanan = 'PREORDER'", "LEFT")
            ->group_by([
                "m_produk_ready.nama",
                "m_produk_preorder.nama",
            ])
            ->where("DATE_FORMAT(tr_pemesanan.created_at,'%Y-%m')", $date)
            ->where("tr_pemesanan.deleted_at IS NULL", null, false)
            ->get("tr_pemesanan")
            ->result();
        return $data;
    }
}