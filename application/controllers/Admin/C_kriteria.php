<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_kriteria extends CI_Controller
{
    function __construct()
    {
        //akan berjalan ketika controller Beranda di jalankan
        parent::__construct();

        $this->load->model('M_kriteria');
        if ($this->session->userdata('login') == FALSE) {
            redirect(base_url('c_login/')); //mengarahkan ke halaman login
        }
    }

    public function index()
    {
        $data['content'] = 'admin/kriteria/V_kriteria';
        $data['kriteria'] = $this->M_kriteria->db_get('tbl_kriteria')->result();
        $this->load->view('admin/Main', $data);
    }

    public function ac_add_kriteria() //tambah kriteria
    {
        $kt = $this->input->post('kriteria'); //mengambil inputan dari form dengan method post
        $tp = $this->input->post('tipe');
        $map = $this->input->post('map');

        $data = array(
            'nama_kriteria' => $kt, //menyimpan data kedalam array
            'tipe_kriteria' => $tp, //menyimpan data kedalam array
            'api_map' => $map,
            'bobot_kriteria' => 0
        );
        $query = $this->M_kriteria->db_input($data, 'tbl_kriteria');
        if ($query) {
            $this->session->set_flashdata('alert', ' Kriteria Berhasil Ditambahkan!');
            redirect('admin/c_kriteria/');
        } else {
            $this->session->set_flashdata('alert', ' Gagal Menambahkan Kriteria!');
            redirect('admin/c_kriteria/');
        }
    }

    public function ac_update_kriteria() //merubah kriteria
    {
        $id = $this->input->post('id'); //mengambil inputan dari form dengan method post
        $kt = $this->input->post('kriteria'); //mengambil inputan dari form dengan method post
        $tp = $this->input->post('tipe');
        $map = $this->input->post('map');

        if ($id) {
            $data = array(
                'nama_kriteria' => $kt, //menyimpan data kedalam array
                'tipe_kriteria' => $tp,
                'api_map' => $map
            );

            $where = array(
                'id_kriteria' => $id // kondisi id yang akan di update
            );
            $query = $this->M_kriteria->db_update($where, $data, 'tbl_kriteria');
            if ($query) {
                $this->session->set_flashdata('alert', ' Kriteria Berhasil Diperbaharui!');
                redirect('admin/c_kriteria/');
            } else {
                $this->session->set_flashdata('alert', ' Gagal Memperbaharui Kriteria!');
                redirect('admin/c_kriteria/');
            }
        } else {
            $this->session->set_flashdata('alert', 'ID kriteria Kosong!'); //flash data
            redirect('admin/c_kriteria/');
        }
    }

    public function delete_kriteria()
    {
        $id = $this->input->post('id');
        $where = array('id_kriteria' => $id);
        $query = $this->M_kriteria->db_delete($where, 'tbl_kriteria');
        if ($query) {
            $this->session->set_flashdata('alert', ' Kriteria Berhasil Dihapus!');
            redirect('admin/c_kriteria/');
        } else {
            $this->session->set_flashdata('alert', ' Gagal Menghapus Kriteria!');
            redirect('admin/c_kriteria/');
        }
    }
}
