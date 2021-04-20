<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agen extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        $this->load->view('templates/agen/header');
        $this->load->view('templates/agen/sidebar');
        $this->load->view('templates/agen/navbar');
        $this->load->view('agen/index');
        $this->load->view('templates/agen/footer');
    }
    public function datacs()
    {
        $this->load->view('templates/agen/header');
        $this->load->view('templates/agen/sidebar');
        $this->load->view('templates/agen/navbar');
        $this->load->view('agen/datacustomer');
        $this->load->view('templates/agen/footer');
    }
    public function datacsagen()
    {
        $this->load->view('templates/agen/header');
        $this->load->view('templates/agen/sidebar');
        $this->load->view('templates/agen/navbar');
        $this->load->view('agen/datacsagen');
        $this->load->view('templates/agen/footer');
    }
    public function login_act()
    {
        $this->load->view('user/login');
    }
    public function pesan()
    {
        $this->load->view('user/pesan');
    }

    public function form_pesan()
    {
        $this->load->view('user/form_pesan');
    }

    public function logout()
    {
        $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been logged out'));
        $this->session->unset_userdata('id');
        redirect('index.php/auth/login');
    }

    public function flasher($class, $message)
    {
        return
            '<div class="alert alert-' . $class . ' alert-dismissible fade show" role="alert">
                ' . $message . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }

    public function breadcomb()
    {
        $crumbs = explode("/", $_SERVER["REQUEST_URI"]);
        $roti = [];

        for ($i = 0; $i < count($crumbs); $i++) {
            $roti[$i] = ucfirst(str_replace(array(".php", "_"), array("", " "), $crumbs[$i]) . ' ');
        }

        return array_slice($roti, 3);
    }
    public function addcs()
    {
        $this->load->view('templates/agen/header');
        $this->load->view('templates/agen/sidebar');
        $this->load->view('templates/agen/navbar');
        $this->load->view('agen/addcs');
        $this->load->view('templates/agen/footer');
    }
    public function add()
    {
        $email = $this->input->post('email');
        $pos = strpos($email, "@gmail.com") ? "ada" : "tidak ada";
        if ($pos == "tidak ada") {
            echo "<script>alert('harus gugel bund');history.go(-1);</script>";
            $this->session->set_flashdata('message_login', $this->flasher('danger', 'HARUS AKUN GUGEL'));
        } else {
            $db = [
                'nama_cs' => $this->input->post('nama'),
                'email_cs' => $this->input->post('email'),
                'passwd_cs' => password_hash($this->input->post('passwd'), PASSWORD_DEFAULT),
                'nohp_cs' => $this->input->post('nohp'),
                'alamat_cs' => $this->input->post('alamat'),
                'catatan' => 'input by agen '.$this->session->userdata('id'),
                'fk_role' => '1'
            ];

            if ($this->User_model->createUser($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }
            redirect('index.php/agen/datacsagen');
        }
    }
    
    public function editdata($id)
    {
        $users = $this->User_model->getUserById($id);
        $data = [
            'users' => $users
        ];
        $this->load->view('templates/agen/header');
        $this->load->view('templates/agen/sidebar');
        $this->load->view('templates/agen/navbar');
        $this->load->view('agen/edit', $data);
        $this->load->view('templates/agen/footer');
    }
    public function edit($id)
    {
        // $this->form_validation->set_rules('name', 'Username', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        // $this->form_validation->set_rules('address', 'Address', 'required');

        $db = [
            'id_cs' => $id,
            'nama_cs' => $this->input->post('nama'),
            'email_cs' => $this->input->post('email'),
            'passwd_cs' => password_hash($this->input->post('passwd'), PASSWORD_DEFAULT),
            'nohp_cs' => $this->input->post('nohp'),
            'alamat_cs' => $this->input->post('alamat'),
            'catatan' => 'input by agen '.$this->session->userdata('id'),
            'fk_role' => $this->input->post('id_role')
        ];

        if ($this->User_model->updateUser($db) > 0) {
            $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
        } else {
            $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
        }

        redirect('index.php/agen/datacsagen');
    }

    public function delete($id)
    {
        if ($id) {
            if ($this->User_model->deleteUser($id) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
            }
        } else {
            $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
        }
        redirect('index.php/agen/datacsagen');
    }
}
