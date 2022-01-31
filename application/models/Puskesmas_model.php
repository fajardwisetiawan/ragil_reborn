<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Puskesmas_model extends CI_Model
{
    private $_table = "simpus.m_puskesmas";

    public $id_puskesmas;
    public $nama;
    public $alamat;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required'],

            // ['field' => 'price',
            // 'label' => 'Price',
            // 'rules' => 'numeric'],
            
            ['field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_puskesmas" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_puskesmas = "1298";
        $this->nama = $post["nama"];
        $this->alamat = $post["alamat"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_puskesmas = $post["id"];
        $this->nama = $post["nama"];
        $this->alamat = $post["alamat"];
        return $this->db->update($this->_table, $this, array('id_puskesmas' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_puskesmas" => $id));
    }
}