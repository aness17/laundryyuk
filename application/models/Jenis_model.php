<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_model extends CI_Model
{
    private $table = 'jenisld';
    private $primary = 'id_jenis';

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function getJenis()
    {
        return $this->db->get($this->table)->result_array();
    }
    public function delete($id)
    {
        $this->db->where($this->primary, $id);
        return $this->db->delete($this->table);
    }
}