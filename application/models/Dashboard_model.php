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
}