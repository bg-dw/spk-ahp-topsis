<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_data_perhitungan extends CI_Controller
{
    function __construct()
    {
        //akan berjalan ketika controller Beranda di jalankan
        parent::__construct();

        $this->load->model('M_data_perhitungan');
        if ($this->session->userdata('login') == FALSE) {
            redirect(base_url('c_login/')); //mengarahkan ke halaman login
        }
    }

    public function index()
    {
        $data['content'] = 'admin/data_perhitungan/V_data_perhitungan';
        $data['lokasi'] = $this->M_data_perhitungan->get_data_lokasi()->result();
        $this->load->view('admin/Main', $data);
    }

    public function add_data_perhitungan()
    {
        $data['content'] = 'admin/data_perhitungan/V_add_detail';
        $data['lokasi'] = $this->M_data_perhitungan->db_get('tbl_lokasi')->result();
        $data['kriteria'] = $this->M_data_perhitungan->db_get('tbl_kriteria')->result();
        $this->load->view('admin/Main', $data);
    }

    public function ac_add_data_perhitungan() //tambah data_perhitungan
    {
        $id_loc = $this->input->post('id_lokasi'); //mengambil inputan dari form dengan method post
        $id_kt = $this->input->post('id_kt');
        $nilai = $this->input->post('nilai');

        $id = explode(" ", $id_loc);
        // var_dump($id);
        $data = array();
        for ($i = 0; $i < count($id_kt); $i++) {
            array_push($data, array(
                'id_lokasi' => $id[0], //menyimpan data kedalam array
                'id_kriteria' => $id_kt[$i], //menyimpan data kedalam array
                'nilai' => $nilai[$i]
            ));
        }
        $query = $this->M_data_perhitungan->db_input_batch($data, 'tbl_detail_lokasi');
        if ($query) {
            $this->session->set_flashdata('alert', ' Data Perhitungan Berhasil Ditambahkan!');
            redirect('admin/c_data_perhitungan/');
        } else {
            $this->session->set_flashdata('alert', ' Gagal Menambahkan Data Perhitungan!');
            redirect('admin/c_data_perhitungan/');
        }
    }

    public function update_data_perhitungan($id_lokasi)
    {
        $data['content'] = 'admin/data_perhitungan/V_update_detail';
        $where = array('tbl_detail_lokasi.id_lokasi' => $id_lokasi);
        $data['detail'] = $this->M_data_perhitungan->get_detail($where)->result();
        $this->load->view('admin/Main', $data);
    }

    public function ac_update_data_perhitungan() //merubah data_perhitungan
    {
        $id_dt = $this->input->post('id_detail'); //mengambil inputan dari form dengan method post
        $nilai = $this->input->post('nilai');

        if ($id_dt) {
            $data = array();
            for ($i = 0; $i < count($id_dt); $i++) {
                array_push($data, array(
                    'id_detail' => $id_dt[$i],
                    'nilai' => $nilai[$i]
                ));
            }
            $query = $this->M_data_perhitungan->db_update_batch($data, 'tbl_detail_lokasi');
            if ($query) {
                $this->session->set_flashdata('alert', ' Data Perhitungan Berhasil Ditambahkan!');
                redirect('admin/c_data_perhitungan/');
            } else {
                $this->session->set_flashdata('alert', ' Gagal Menambahkan Data Perhitungan!');
                redirect('admin/c_data_perhitungan/');
            }
        } else {
            $this->session->set_flashdata('alert', 'ID Data Perhitungan Kosong!'); //flash data
            redirect('admin/c_data_perhitungan/');
        }
    }

    public function delete_data_perhitungan()
    {
        $id = $this->input->post('id');
        $where = array('id_lokasi' => $id);
        $query = $this->M_data_perhitungan->db_delete($where, 'tbl_detail_lokasi');
        if ($query) {
            $this->session->set_flashdata('alert', ' Data Perhitungan Berhasil Dihapus!');
            redirect('admin/c_data_perhitungan/');
        } else {
            $this->session->set_flashdata('alert', ' Gagal Menghapus Data Perhitungan!');
            redirect('admin/c_data_perhitungan/');
        }
    }
}
