<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
    public function index()
    {
        $this->load->view('user/index');
    }
    public function login()
    {
        $this->load->view('auth/login');
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
        $this->load->view('user/logout');
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function google(){
        $this->load->view('auth/google_login');
    }
    public function dashboard()
    {
        $this->load->view('user/dashboard');
    }


}
