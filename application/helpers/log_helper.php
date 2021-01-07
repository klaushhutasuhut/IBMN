<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->m_menu->getWhereMenu('user_menu', ['menu' => $menu]);
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->m_auth->getWhereAccess('user_access', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('error');
        }
    }
}

function cek_akses($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->m_menu->getAksesMenu('user_access', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
