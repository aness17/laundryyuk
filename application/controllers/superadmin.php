<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
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
        $this->load->model('Jenis_model');
        $this->load->model('Layanan_model');
    }
    public function index()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/index');
        $this->load->view('templates/admin/footer');
    }
    public function datacs()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/datacustomer');
        $this->load->view('templates/admin/footer');
    }
    public function datadmin()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/dataadmin');
        $this->load->view('templates/admin/footer');
    }
    public function datajenis()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/datajenislaundry');
        $this->load->view('templates/admin/footer');
    }
    public function datalayanan()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/datalayanan');
        $this->load->view('templates/admin/footer');
    }
    public function editdata($id)
    {
        $users = $this->User_model->getUserById($id);
        $data = [
            'users' => $users
        ];
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/edit', $data);
        $this->load->view('templates/admin/footer');
    }
    public function logout()
    {
        $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been logged out'));
        $this->session->unset_userdata('id');
        redirect('index.php/auth/login');
    }

    public function addadmin()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/addadmin');
        $this->load->view('templates/admin/footer');
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

            // var_dump($db);

            if ($this->User_model->createUser($db) > 0) {
                $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
            } else {
                $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
            }
            redirect('index.php/superadmin/datadmin');
        }
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
            'catatan' => 'input by superadmin',
            'fk_role' => $this->input->post('id_role')
        ];

        if ($this->User_model->updateUser($db) > 0) {
            $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
        } else {
            $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
        }

        if ($db['fk_role'] == '1') {
            redirect('index.php/superadmin/datacs');
        } else {
            redirect('index.php/superadmin/datadmin');
        }
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
        redirect('index.php/superadmin/datadmin');
    }
    public function addlayanan()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/layanan/add');
        $this->load->view('templates/admin/footer');
    }
    public function add2()
    {
        $db = [
            'nama_layanan' => $this->input->post('nama'),
            'estimasi_waktu_layanan' => $this->input->post('estimasi'),
            'harga_layanan' => $this->input->post('harga')
        ];

        // var_dump($db);

        if ($this->Layanan_model->create($db) > 0) {
            $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
        } else {
            $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
        }
        redirect('index.php/superadmin/datalayanan');
    }
    public function addjenis()
    {
        $this->load->view('templates/admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/admin/navbar');
        $this->load->view('admin/jenis/add');
        $this->load->view('templates/admin/footer');
    }
    public function add3()
    {
        $db = [
            'nama_jenis' => $this->input->post('nama'),
            'satuan_jenis' => $this->input->post('satuan'),
            'estimasi_waktu_jenis' => $this->input->post('estimasi'),
            'harga_jenis' => $this->input->post('harga')
        ];

        if ($this->Jenis_model->create($db) > 0) {
            $this->session->set_flashdata('message_login', $this->flasher('success', 'User has been registered!'));
        } else {
            $this->session->set_flashdata('message_login', $this->flasher('danger', 'Failed to create User'));
        }
        redirect('index.php/superadmin/datalayanan');
    }
    public function deletejenis($id)
    {
        if ($id) {
            if ($this->Jenis_model->delete($id) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
            }
        } else {
            $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
        }
        redirect('index.php/superadmin/datalayanan');
    }
    public function deletelayanan($id)
    {
        if ($id) {
            if ($this->Layanan_model->delete($id) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Add Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Add Data'));
            }
        } else {
            $this->session->set_flashdata('message', $this->flasher('danger', 'Id Is null'));
        }
        redirect('index.php/superadmin/datalayanan');
    }

    public function editjenis($id = "")
    {
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('estimasi', 'Estimasi', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');

        $jenis = $this->Jenis_model->getUserById($id);
        $data = [
            'jenis' => $jenis
        ];

        if ($this->form_validation->run()) {
            $db = [
                'id_jenis' => $id,
                'nama_jenis' => $this->input->post('nama'),
                'satuan_jenis' => $this->input->post('satuan'),
                'estimasi_waktu_jenis' => $this->input->post('estimasi'),
                'harga_jenis' => $this->input->post('harga')
            ];

            if ($this->Jenis_model->update($db) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
            }
            redirect('index.php/admin/datalayanan');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/jenis/edit', $data);
            $this->load->view('templates/admin/footer');
        }
    }
    public function editlayanan($id)
    {
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('estimasi', 'Estimasi', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        
        $layanan = $this->Layanan_model->getUserById($id);
        $data = [
            'layanan' => $layanan
        ];

        if ($id == " ") {
            $db = [
                'id_layanan' => $id,
                'nama_layanan' => $this->input->post('nama'),
                'estimasi_waktu_layanan' => $this->input->post('estimasi'),
                'harga_layanan' => $this->input->post('harga')
            ];

            if ($this->Layanan_model->update($db) > 0) {
                $this->session->set_flashdata('message', $this->flasher('success', 'Success To Edit Data'));
            } else {
                $this->session->set_flashdata('message', $this->flasher('danger', 'Failed To Edit Data'));
            }
            redirect('index.php/admin/datalayanan');
        } else {
            $this->load->view('templates/admin/header');
            $this->load->view('templates/admin/sidebar');
            $this->load->view('templates/admin/navbar');
            $this->load->view('admin/layanan/edit', $data);
            $this->load->view('templates/admin/footer');
        }
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
}
