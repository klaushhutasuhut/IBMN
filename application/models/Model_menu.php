<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_menu extends CI_Model
{
    public function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function getWhereMenu($table, $data)
    {
        return $this->db->get_where($table, $data)->row_array();
    }

    public function getUserMenu($table, $where)
    {
        return $this->db->get_where($table, $where)->result_array();
    }

    public function querySideBar($table, $role_id)
    {
        $this->db->select('user_menu.id, menu, icon');
        $this->db->from($table);
        $this->db->join('user_access', 'user_menu.id = user_access.menu_id', 'left');
        $this->db->where('user_access.role_id', $role_id);
        $this->db->order_by('user_access.menu_id', 'asc');
        return $this->db->get()->result_array();
    }

    public function insertMenu($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function updateMenu($table, $id, $menu, $icon)
    {
        $this->db->set('icon', $icon);
        $this->db->set('menu', $menu);
        $this->db->where('id', $id);
        $this->db->update($table);
    }

    public function deleteMenu($table, $id)
    {
        $this->db->delete($table, $id);
    }



    public function getWhereSubMenu($table, $menuId)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('menu_id', $menuId, 'AND user_sub_menu.is_active = 1');
        return $this->db->get()->result_array();
    }

    public function getQuerySubMenu($table)
    {
        $this->db->select('user_sub_menu.*, user_menu.menu');
        $this->db->from($table);
        $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id', 'left');
        return $this->db->get()->result_array();
    }

    public function insertSubMenu($data)
    {
        return $this->db->insert('user_sub_menu', $data);
    }

    public function updateSubMenu($table, $id, $menu, $judul, $link, $active)
    {
        $this->db->set('is_active', $active);
        $this->db->set('url', $link);
        $this->db->set('title', $judul);
        $this->db->set('menu_id', $menu);
        $this->db->where('id', $id);
        $this->db->update($table);
    }

    public function deleteSubMenu($table, $id)
    {
        $this->db->delete($table, $id);
    }




    public function getAkses($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function getWhereAkses($table, $data)
    {
        return $this->db->get_where($table, $data)->row_array();
    }

    public function getAksesMenu($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function insertAksesMenu($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function deleteAksesMenu($table, $data)
    {
        $this->db->delete($table, $data);
    }
}
