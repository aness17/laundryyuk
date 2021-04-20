<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $email_cs =$_POST['email'];
        $passwd_cs = $_POST['password'];

        $user= $this->db->get_where('user', ['email_cs' => $email_cs])->row_array();
        
        if ($user['id_cs']>0) {
            
            if ($user) {
                if ($passwd_cs==$user['password']) {
                    if ($user['fk_role'] == '1') {
                        $this->session->set_userdata('id', $user['id_cs']);
                        redirect('index.php/auth/dashboard');
                    } else if ($user['fk_role'] == '2') {
                        $this->session->set_userdata('id', $user['id_cs']);
                        redirect('index.php/outlet');
                    }else if ($user['fk_role'] == '3') {
                        $this->session->set_userdata('id', $user['id_cs']);
                        redirect('index.php/superadmin');
                    }else{
                        $this->session->set_userdata('id', $user['id_cs']);
                        redirect('index.php/agen');
                    }
                } else {
                    $this->session->set_flashdata('message_login', $this->flasher('danger', 'Wrong Password'));
                    redirect('index.php/login');
                }
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'User not registered'));
                redirect('index.php/login');
            }
        } else {
            $this->load->view('index.php/login');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email_cs]');
        $this->form_validation->set_rules('passwd', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run()) {
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
                'fk_role'=>'1',
                'catatan'=> 'input sendiri'
            ];

            if ($this->User_model->createUser($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }
            redirect('index.php/auth/login');
        }
        } else {
            $this->load->view('auth/register');
        }
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
}
