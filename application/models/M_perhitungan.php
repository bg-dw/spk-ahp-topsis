<?php
class M_perhitungan extends CI_Model
{
    //mengambil data dari database
    function db_get($table)
    {
        $this->db->select('*'); //mengambil semua data
        $this->db->from($table); //dari table
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    //mengambil data dengan sebuah kondisi
    function db_get_where_in($table, $where)
    {
        $this->db->select('*'); //mengambil semua data
        $this->db->from($table); //dari table
        $this->db->where_in($where);
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    function get_detail($id_lokasi)
    {
        $this->db->select('tbl_detail_lokasi.*,tbl_lokasi.nama_lokasi,tbl_kriteria.bobot_kriteria'); //mengambil semua data
        $this->db->from('tbl_detail_lokasi'); //dari table
        $this->db->join('tbl_lokasi', 'tbl_detail_lokasi.id_lokasi=tbl_lokasi.id_lokasi');
        $this->db->join('tbl_kriteria', 'tbl_detail_lokasi.id_kriteria=tbl_kriteria.id_kriteria');
        $this->db->where_in('tbl_detail_lokasi.id_lokasi', $id_lokasi);
        // $this->db->order_by('tbl_detail_lokasi.id_kriteria', 'ASC');
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    function get_detail_group($id_lokasi)
    {
        $this->db->select('tbl_detail_lokasi.*,tbl_lokasi.*,tbl_kriteria.bobot_kriteria'); //mengambil semua data
        $this->db->from('tbl_detail_lokasi'); //dari table
        $this->db->join('tbl_lokasi', 'tbl_detail_lokasi.id_lokasi=tbl_lokasi.id_lokasi');
        $this->db->join('tbl_kriteria', 'tbl_detail_lokasi.id_kriteria=tbl_kriteria.id_kriteria');
        $this->db->where_in('tbl_detail_lokasi.id_lokasi', $id_lokasi);
        $this->db->group_by('tbl_detail_lokasi.id_lokasi');
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    function db_update_batch($data, $table, $by)
    {
        $query = $this->db->update_batch($table, $data, $by);
        return $query;
    }
}
