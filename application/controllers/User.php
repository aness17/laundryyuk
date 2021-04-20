<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->model('Type_model');

        if ($this->session->userdata('id') === null) {
            redirect('login');
        }
    }
    public function index()
    {
        $data['produk'] = $this->Product_model->tampil_data()->result();

        $this->load->view('user/header');
        $this->load->view('user/navbar');
        $this->load->view('user/home', $data);
        $this->load->view('user/footer');
    }
}
