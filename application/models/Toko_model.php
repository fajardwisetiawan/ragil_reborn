<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Toko_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get("m_toko")->row();
    }
}