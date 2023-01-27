<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_login extends CI_Controller
{
    function __construct()
    {
        //akan berjalan ketika controller C_login di jalankan
        parent::__construct();
        $this->load->model('M_login');
    }
    //halaman beranda login
    public function index()
    {
        if ($this->session->userdata('login') == TRUE && $this->session->userdata('user') != '') {
            redirect('admin/home/'); //mengarahkan ke halaman admin
        }
        $this->load->view('login/V_login');

        //menghancurkan/menghilangkan session yang sudah dibuat ketika login
        $this->session->sess_destroy();
    }

    //cek username dan password login
    public function cek_login()
    {
        $uname = $this->input->post('uname');
        $pass = $this->input->post('upass');

        $query = $this->M_login->auth_db_login($uname, $pass); //memanggil fungsi cek_db_login dari model M_login dengan parameter $uname , $pass
        if ($query->num_rows() > 0) {
            $data = $query->row_array(); //mengambil data dengan cara membuatnya menjadi array
            $this->session->set_userdata('login', TRUE); //memberikan nilai TRUE pada userdata login
            $this->session->set_userdata('user', $data['username']); //memberikan nilai yang di ambil dari databae pada userdata user
            $this->session->set_userdata('pass', $data['password']);
            $this->session->set_userdata('nama', $data['nama_admin']);
            $this->session->set_userdata('id', $data['id_admin']);
            redirect('admin/home/');
        } else {
            $this->session->set_flashdata('warning', 'Username atau Password anda salah!'); //membuat flashdata dengan parameter warning
            redirect(base_url('c_login'));
        }
        // redirect('c_login/');
    }

    //logout akun
    public function logout()
    {
        $this->session->sess_destroy(); //menghancurkan/menghilangkan session yang sudah dibuat ketika login
        redirect(base_url());
    }
}
