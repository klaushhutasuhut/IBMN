<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    public function getUser($table, $where)
    {
        return $this->db->get($table, $where)->result_array();
    }

    public function getAllMember($table, $where)
    {
        return $this->db->get_where($table, $where)->result_array();
    }

    public function queryDetailMember($table)
    {
        $this->db->select('user.id, user.email, user.nama, count(barang_pinjam.user_id = user.id) as jum');
        $this->db->from($table);
        $this->db->join('barang_pinjam', 'user.id = barang_pinjam.user_id', 'left');
        $this->db->where('user.role_id != 1 AND barang_pinjam.ijin = 0');
        return $this->db->get()->result_array();
    }

    public function queryPinjamMember($table, $where)
    {
        $this->db->select('user.id, user.nama, count(barang_pinjam.user_id = user.id) as jum');
        $this->db->from($table);
        $this->db->join('barang_pinjam', 'user.id = barang_pinjam.user_id', 'left');
        $this->db->where($where);
        $this->db->where('barang_pinjam.ijin = 0');
        return $this->db->get()->row_array();
    }

    public function insertUser($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function insertUserToken($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function updateUser($table, $where, $email, $set, $data)
    {
        $this->db->set($set, $data);
        $this->db->where($where, $email);
        $this->db->update($table);
    }

    public function updateProfileNama($table, $where, $set)
    {
        $this->db->set('nama', $set);
        $this->db->where('email', $where);
        $this->db->update($table);
    }

    public function updateProfilePic($table, $where, $image)
    {
        $this->db->set('image', $image);
        $this->db->where('email', $where);
        $this->db->update($table);
    }

    public function updatePassword($table, $where, $row, $set, $password)
    {
        $this->db->set($set, $password);
        $this->db->where($where, $row);
        $this->db->update($table);
    }

    public function deleteUser($table, $where)
    {
        $this->db->delete($table, $where);
    }
}
