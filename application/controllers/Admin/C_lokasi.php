<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_lokasi extends CI_Controller
{
    function __construct()
    {
        //akan berjalan ketika controller Beranda di jalankan
        parent::__construct();

        $this->load->model('M_lokasi');
        if ($this->session->userdata('login') == FALSE) {
            redirect(base_url('c_login/')); //mengarahkan ke halaman login
        }
    }
    public function index()
    {
        $data['content'] = 'admin/lokasi/V_lokasi';
        $data['lokasi'] = $this->M_lokasi->db_get('tbl_lokasi')->result();
        $this->load->view('admin/Main', $data);
    }

    public function add_lokasi()
    {
        $data['content'] = 'admin/lokasi/V_add_lokasi';
        $this->load->view('admin/Main', $data);
    }

    public function ac_add_lokasi() //tambah lokasi
    {
        $lt = $this->input->post('lat'); //mengambil inputan dari form dengan method post
        $lg = $this->input->post('lang');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');

        $data = array(
            'lat' => $lt, //menyimpan data kedalam array
            'lang' => $lg,
            'nama_lokasi' => $nama,
            'alamat_lokasi' => $alamat
        );
        $query = $this->M_lokasi->db_input($data, 'tbl_lokasi');
        if ($query) {
            $this->session->set_flashdata('alert', ' Lokasi Berhasil Ditambahkan!');
            redirect('admin/c_lokasi/');
        } else {
            $this->session->set_flashdata('alert', ' Gagal Menambahkan Lokasi!');
            redirect('admin/c_lokasi/');
        }
    }

    public function update_lokasi($id)
    {
        $data['content'] = 'admin/lokasi/V_update_lokasi';
        $where = array(
            'id_lokasi' => $id
        );
        $data['lokasi'] = $this->M_lokasi->db_get_where($where, 'tbl_lokasi')->row();
        $this->load->view('admin/Main', $data);
    }



    public function ac_update_lokasi() //merubah lokasi
    {
        $id = $this->input->post('id_lokasi'); //mengambil inputan dari form dengan method post
        $lt = $this->input->post('lat');
        $lg = $this->input->post('lang');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');

        if ($id) {
            $data = array(
                'lat' => $lt, //menyimpan data kedalam array
                'lang' => $lg,
                'nama_lokasi' => $nama,
                'alamat_lokasi' => $alamat
            );

            $where = array(
                'id_lokasi' => $id // kondisi id yang akan di update
            );
            $query = $this->M_lokasi->db_update($where, $data, 'tbl_lokasi');
            if ($query) {
                $this->session->set_flashdata('alert', ' Lokasi Berhasil Diperbaharui!');
                redirect('admin/c_lokasi/');
            } else {
                $this->session->set_flashdata('alert', ' Gagal Memperbaharui Lokasi!');
                redirect('admin/c_lokasi/');
            }
        } else {
            $this->session->set_flashdata('alert', 'ID Lokasi Kosong!'); //flash data
            redirect('admin/c_lokasi/');
        }
    }

    public function delete_lokasi()
    {
        $id = $this->input->post('id');
        $where = array('id_lokasi' => $id);
        $query = $this->M_lokasi->db_delete($where, 'tbl_lokasi');
        if ($query) {
            $this->session->set_flashdata('alert', ' Lokasi Berhasil Dihapus!');
            redirect('admin/c_lokasi/');
        } else {
            $this->session->set_flashdata('alert', ' Gagal Menghapus Lokasi!');
            redirect('admin/c_lokasi/');
        }
    }
}
