<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outlet extends CI_Controller
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
        $this->load->view('templates/outlet/header');
        $this->load->view('templates/outlet/sidebar');
        $this->load->view('templates/outlet/navbar');
        $this->load->view('outlet/index');
        $this->load->view('templates/outlet/footer');
    }
    public function datacs()
    {
        $this->load->view('templates/outlet/header');
        $this->load->view('templates/outlet/sidebar');
        $this->load->view('templates/outlet/navbar');
        $this->load->view('outlet/datacustomer');
        $this->load->view('templates/outlet/footer');
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
    public function addadmin()
    {
        $this->load->view('templates/outlet/header');
        $this->load->view('templates/outlet/sidebar');
        $this->load->view('templates/outlet/navbar');
        $this->load->view('outlet/addadmin');
        $this->load->view('templates/outlet/footer');
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
                'catatan' => 'input by superadmin',
                'fk_role' => $this->input->post('id_role')
            ];

            var_dump($db);

            if ($this->User_model->createUser($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }
            redirect('index.php/superadmin/datadmin');
        }
    }
}
