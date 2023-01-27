<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		//akan berjalan ketika controller Beranda di jalankan
		parent::__construct();

		$this->load->model('M_lokasi');
		$this->load->model('M_kriteria');
		$this->load->model('M_lokasi');
		if ($this->session->userdata('login') == FALSE) {
			redirect(base_url('c_login/')); //mengarahkan ke halaman login
		}
	}
	public function index()
	{
		$data['content'] = 'admin/V_home';
		$data['lokasi'] = $this->M_lokasi->db_get('tbl_lokasi')->num_rows();
		$data['loc'] = $this->M_lokasi->db_get('tbl_lokasi')->result();
		$data['kriteria'] = $this->M_kriteria->db_get('tbl_kriteria')->num_rows();
		$this->load->view('admin/Main', $data);
	}

	function get_lokasi()
	{
		$loc = $this->M_lokasi->db_get('tbl_lokasi')->result();
		echo json_encode($loc);
	}
}
