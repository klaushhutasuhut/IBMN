<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['menu'] = $this->m_menu->getMenu();
        $theme = array(
            "title" => 'Pengaturan Menu User',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/menu/Menu", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function addmenu()
    {

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon')
            ];
            $this->m_menu->insertMenu('user_menu', $data);
            $this->session->set_flashdata('message', 'Menu Berhasil ditambahkan!');
            redirect('menu');
        }
    }

    public function editMenu()
    {
        $this->form_validation->set_rules('nm_menu', 'Menu', 'required');
        $this->form_validation->set_rules('mn_icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $this->m_menu->updateMenu('user_menu', $this->input->post('id_menu'), $this->input->post('nm_menu'), $this->input->post('mn_icon'));
            $this->session->set_flashdata('message', 'Menu Berhasil diganti!');
            redirect('menu');
        }
    }

    public function deleteMenu($id)
    {
        $this->m_menu->deleteMenu('user_menu', array('id' => $id));
        $this->session->set_flashdata('message', 'Menu berhasil dihapus!');
        redirect('menu');
    }

    public function subMenu()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['subMenu'] = $this->m_menu->getQuerySubMenu('user_sub_menu');
        $data['menu'] = $this->m_menu->getMenu();
        $theme = array(
            "title" => 'Pengaturan Submenu User',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/menu/Submenu", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function addSubMenu()
    {
        $this->form_validation->set_rules('menuId', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Submenu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');

        if ($this->form_validation->run() == false) {
            $this->submenu();
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menuId'),
                'url' => $this->input->post('url'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->m_menu->insertSubMenu($data);
            $this->session->set_flashdata('message', 'Submenu berhasil ditambahkan!');
            redirect('menu/submenu');
        }
    }

    public function editSubMenu()
    {
        $this->form_validation->set_rules('idmenu', 'Menu', 'required');
        $this->form_validation->set_rules('judul', 'Submenu', 'required');
        $this->form_validation->set_rules('link', 'Url', 'required');

        if ($this->form_validation->run() == false) {
            $this->submenu();
        } else {
            $this->m_menu->updateSubMenu('user_sub_menu', $this->input->post('idsub'), $this->input->post('idmenu'), $this->input->post('judul'), $this->input->post('link'), $this->input->post('isactive'));
            $this->session->set_flashdata('message', 'Menu Berhasil diganti!');
            redirect('menu/submenu');
        }
    }

    public function deleteSubMenu($id)
    {
        $this->m_menu->deleteSubMenu('user_sub_menu', array('id' => $id));
        $this->session->set_flashdata('message', 'Submenu berhasil dihapus!');
        redirect('menu/submenu');
    }

    public function aksesMenu()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['akses'] = $this->m_menu->getAkses('user_role');
        $theme = array(
            "title" => 'Pengaturan Akses User',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/menu/aksesmenu", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function aksesuser($id)
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['akses'] = $this->m_menu->getWhereAkses('user_role', ['id' => $id]);
        $data['menu'] = $this->m_menu->getUserMenu('user_menu', 'id != 1');
        $theme = array(
            "title" => 'Pengaturan Akses User',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/menu/aksesrole", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function gantiakses()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->m_menu->getAksesMenu('user_access', $data);

        if ($result->num_rows() < 1) {
            $this->m_menu->insertAksesMenu('user_access', $data);
        } else {
            $this->m_menu->deleteAksesMenu('user_access', $data);
        }
        $this->session->set_flashdata('message', 'Akses user diganti!');
    }
}
