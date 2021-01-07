<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model
{
    public function getWhereUser($table, $where)
    {
        return $this->db->get_where($table, $where)->row_array();
    }

    public function getWhereAccess($table, $data)
    {
        return $this->db->get_where($table, $data);
    }
}
