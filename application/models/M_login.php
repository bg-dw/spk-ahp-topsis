<?php
class M_login extends CI_Model
{
    function auth_db_login($uname, $pwd)
    {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $where = array('username' => $uname, 'password' => $pwd);
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
}
