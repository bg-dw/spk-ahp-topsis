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
		if ($this->session->userdata('login') == TRUE) {
			redirect(base_url('admin/')); //mengarahkan ke halaman login
		}
	}
	public function index()
	{
		$data['content'] = 'guest/V_home';
		$data['loc'] = $this->M_lokasi->db_get('tbl_lokasi')->result();
		$kt = $this->M_kriteria->db_get('tbl_kriteria')->result();
		foreach ($kt as $val) { //membuat array baru
			$kriteria['id'][] = $val->id_kriteria;
			$kriteria['nama'][] = $val->nama_kriteria;
		}
		$data['kriteria'] = $kriteria;
		$this->load->view('guest/Main', $data);
	}

	function get_lokasi()
	{
		$loc = $this->M_lokasi->db_get('tbl_lokasi')->result();
		echo json_encode($loc);
	}
}
