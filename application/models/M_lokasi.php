<?php
class M_lokasi extends CI_Model
{
    //mengambil data dari database
    function db_get($table)
    {
        $this->db->select('*'); //mengambil semua data
        $this->db->from($table); //dari table
        $query = $this->db->get(); //eksekusi query
        return $query; //mengembalikan nilai yang didapat
    }

    //menyimpan data kedalam database
    public function db_input($data, $table) //$data dan $table merupakan variable yang dikirim dari controller
    {
        $query = $this->db->insert($table, $data); //bagian ini merupakan query builder bawaan codeigniter
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

    function db_update($where, $data, $table)
    {
        $this->db->where($where);
        $query = $this->db->update($table, $data);
        return $query;
    }

    function db_delete($where, $table)
    {
        $this->db->where($where);
        $hasil = $this->db->delete($table);
        return $hasil;
    }
}
