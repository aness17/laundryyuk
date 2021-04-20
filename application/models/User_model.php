<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'user';
    private $primary = 'id_cs';

    public function createUser($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getUserById($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($this->primary, $id);
        return $this->db->get()->row_array();
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where($this->table, ['email_cs' => $email])->row_array();
    }

    public function getUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        return $this->db->get()->result_array();
    }

    public function updateUser($data)
    {
        $this->db->where($this->primary, $data[$this->primary]);
        return $this->db->update($this->table, $data);
    }

    public function deleteUser($id)
    {
        $this->db->where($this->primary, $id);
        return $this->db->delete($this->table);
    }
    public function selectAll()
    {
        $this->db->select('*');
        $this->db->from('user');
        return $this->db->get()->result_array();
    }
}
