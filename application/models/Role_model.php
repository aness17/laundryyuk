<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    private $table = 'roles';

    public function getRole()
    {
        return $this->db->get($this->table)->result_array();
    }
}
