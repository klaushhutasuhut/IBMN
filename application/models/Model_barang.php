<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang extends CI_Model
{
    public function getBarang($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function getBarangWhere($table, $where)
    {
        return $this->db->get_where($table, $where)->result_array();
    }

    public function getBarangMember($table, $id)
    {
        $this->db->select('barang.kd_barang, barang.nama_brg, barang_pinjam.id, barang_pinjam.id_barang, barang_pinjam.tgl_pinjam, barang_pinjam.keterangan, barang_pinjam.ijin, barang_kembali.id_pinjam');
        $this->db->from($table);
        $this->db->join('barang', 'barang_pinjam.id_barang = barang.id', 'left');
        $this->db->join('barang_kembali', 'barang_pinjam.id = barang_kembali.id_pinjam', 'left');
        $this->db->where('barang_pinjam.user_id', $id);
        $this->db->order_by('barang_pinjam.id', 'asc');
        return $this->db->get()->result_array();
    }

    public function countBarangMember($table, $id)
    {
        $this->db->select('barang.kd_barang, barang.nama_brg, barang_pinjam.tgl_pinjam, barang_pinjam.keterangan');
        $this->db->from($table);
        $this->db->join('barang', 'barang_pinjam.id_barang = barang.id', 'left');
        $this->db->where('barang_pinjam.user_id', $id);
        $this->db->order_by('barang_pinjam.id', 'asc');
        return $this->db->get()->num_rows();
    }

    public function getDetailBarang($table)
    {
        $this->db->select('barang.kd_barang, barang.nama_brg, barang.status, barang_pinjam.tgl_pinjam, user.nama');
        $this->db->from($table);
        $this->db->join('barang_pinjam', 'barang.id = barang_pinjam.id_barang', 'left');
        $this->db->join('user', 'barang_pinjam.user_id = user.id', 'left');
        $this->db->order_by('barang.id', 'asc');
        return $this->db->get()->result_array();
    }

    public function queryKodeBarang($table, $id)
    {
        $this->db->select('barang_pinjam.tgl_pinjam, barang.kd_barang');
        $this->db->from($table);
        $this->db->join('barang', 'barang_pinjam.id_barang = barang.id', 'left');
        $this->db->where('barang_pinjam.user_id', $id);
        $this->db->where('barang_pinjam.ijin = 0');
        return $this->db->get()->result_array();
    }

    public function getQueryPeminjaman($table)
    {
        $this->db->select('barang.id, barang.kd_barang, barang.status, barang.nama_brg, user.id as id_user, user.email, barang_pinjam.tgl_pinjam, barang_pinjam.keterangan');
        $this->db->from($table);
        $this->db->join('barang', 'barang_pinjam.id_barang = barang.id', 'left');
        $this->db->join('user', 'barang_pinjam.user_id = user.id', 'left');
        $this->db->order_by('barang_pinjam.id', 'asc');
        return $this->db->get()->result_array();
    }

    public function getQueryPengembalian($table)
    {
        $this->db->select('barang_kembali.id, barang_kembali.id_pinjam, barang_kembali.id_barang, barang_kembali.keterangan, barang.kd_barang, user.nama, barang_pinjam.tgl_pinjam, barang_pinjam.ijin, barang_kembali.tgl_kembali');
        $this->db->from($table);
        $this->db->join('barang', 'barang_kembali.id_barang = barang.id', 'left');
        $this->db->join('user', 'barang_kembali.user_id = user.id', 'left');
        $this->db->join('barang_pinjam', 'barang_kembali.id_pinjam = barang_pinjam.id', 'left');
        $this->db->order_by('barang_kembali.id', 'asc');
        return $this->db->get()->result_array();
    }

    public function getRekapData($table)
    {
        $this->db->select('user.email, user.nama, barang.kd_barang, barang.nama_brg, pinjam_detail.tgl_pinjam, pinjam_detail.keterangan');
        $this->db->from($table);
        $this->db->join('barang', 'pinjam_detail.id_barang = barang.id', 'left');
        $this->db->join('user', 'pinjam_detail.user_id = user.id', 'left');
        $this->db->order_by('pinjam_detail.id', 'asc');
        return $this->db->get()->result_array();
    }

    public function insertRowBarang($data)
    {
        return $this->db->insert('barang', $data);
    }

    public function insertPinjam($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function insertKembali($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function updateStatusBarang($table, $where, $row, $set, $status)
    {
        $this->db->set($set, $status);
        $this->db->where($where, $row);
        $this->db->update($table);
    }

    public function updatePinjam($table, $where, $row, $set1, $ket, $set2, $ijin, $set3, $tgl)
    {
        $this->db->set($set2, $ijin);
        $this->db->set($set1, $ket);
        $this->db->set($set3, $tgl);
        $this->db->where($where, $row);
        $this->db->update($table);
    }

    public function updateIjin($table, $where, $row, $set, $ijin)
    {
        $this->db->set($set, $ijin);
        $this->db->where($where, $row);
        $this->db->update($table);
    }

    public function deletePinjam($table, $where)
    {
        $this->db->delete($table, $where);
    }

    public function deleteKembali($table, $where)
    {
        $this->db->delete($table, $where);
    }
}
