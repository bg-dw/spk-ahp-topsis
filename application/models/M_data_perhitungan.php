<?php
class M_data_perhitungan extends CI_Model
{
    //mengambil data dari database
    function db_get($table)
    {
        $this->db->select('*'); //mengambil semua data
        $this->db->from($table); //dari table
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    function get_data_lokasi()
    {
        $this->db->select('tbl_detail_lokasi.*,tbl_lokasi.*,tbl_kriteria.*'); //mengambil semua data
        $this->db->from('tbl_detail_lokasi'); //dari table
        $this->db->join('tbl_lokasi', 'tbl_detail_lokasi.id_lokasi=tbl_lokasi.id_lokasi');
        $this->db->join('tbl_kriteria', 'tbl_detail_lokasi.id_kriteria=tbl_kriteria.id_kriteria');
        $this->db->group_by('tbl_detail_lokasi.id_lokasi');
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    //menyimpan data kedalam database
    public function db_input($data, $table) //$data dan $table merupakan variable yang dikirim dari controller
    {
        $query = $this->db->insert($table, $data); //bagian ini merupakan query builder bawaan codeigniter
        return $query;
    }

    //menyimpan banyak data kedalam database
    public function db_input_batch($data, $table) //$data dan $table merupakan variable yang dikirim dari controller
    {
        $query = $this->db->insert_batch($table, $data); //bagian ini merupakan query builder bawaan codeigniter
        return $query;
    }

    function db_get_where($where, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    function get_detail($where)
    {
        $this->db->select('tbl_detail_lokasi.*,tbl_lokasi.*,tbl_kriteria.*'); //mengambil semua data
        $this->db->from('tbl_detail_lokasi'); //dari table
        $this->db->join('tbl_lokasi', 'tbl_detail_lokasi.id_lokasi=tbl_lokasi.id_lokasi');
        $this->db->join('tbl_kriteria', 'tbl_detail_lokasi.id_kriteria=tbl_kriteria.id_kriteria');
        // $this->db->group_by('tbl_detail_lokasi.id_lokasi');
        $this->db->where($where);
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    function db_update($where, $data, $table)
    {
        $this->db->where($where);
        $query = $this->db->update($table, $data);
        return $query;
    }

    function db_update_batch($data, $table)
    {
        $query = $this->db->update_batch($table, $data, 'id_detail');
        return $query;
    }

    function db_delete($where, $table)
    {
        $this->db->where($where);
        $hasil = $this->db->delete($table);
        return $hasil;
    }
}
