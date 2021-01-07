<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        //untuk menampilkan halaman login yang sudah di pisah menjadi template
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['member'] = $this->m_user->queryPinjamMember('user', ['email' => $this->session->userdata('email')]);

        $theme = array(
            "title" => 'Member IBMN || Peminjaman',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/member/Barangsaya", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function addPengembalian()
    {
        $this->form_validation->set_rules('tgl_pinjam', 'Kode Barang', 'required');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'id_pinjam' => $this->input->post('idpinjam'),
                'user_id' => $this->input->post('iduser'),
                'id_barang' => $this->input->post('idbarang'),
                'tgl_kembali' => time(),
                'tgl_pinjam' => $this->input->post('tgl_pinjam'),
                'keterangan' => $this->input->post('keterangan')
            ];
            $this->m_barang->insertKembali('barang_kembali', $data);
            $this->session->set_flashdata('message', 'Barang berhasil dikembalikan! Tunggu konfirmasi admin');
            redirect('member');
        }
    }

    public function Barang()
    {
        //untuk menampilkan halaman login yang sudah di pisah menjadi template
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['barang'] = $this->m_barang->getBarangWhere('barang', ['status' => 'Tersedia']);

        $theme = array(
            "title" => 'Member IBMN || Table Barang',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/member/Tablebarang", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function Booking()
    {
        $this->m_barang->updateStatusBarang('barang', 'kd_barang', $this->input->post('rowkd'), 'status', 'Di Booking');

        $data = [
            'user_id' => $this->input->post('rowuser'),
            'id_barang' => $this->input->post('rowid'),
            'tgl_pinjam' => time(),
            'keterangan' => '',
            'ijin' => 1,
        ];

        $this->m_barang->insertPinjam('barang_pinjam', $data);
        $this->session->set_flashdata('message', 'Barang di booking!');
        redirect('member/barang');
    }
}
