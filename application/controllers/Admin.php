<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    //metode default dalam kelas ini
    public function index()
    {
        //untuk menampilkan halaman login yang sudah di pisah menjadi template
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['member'] = $this->m_user->queryDetailMember('user');

        $theme = array(
            "title" => 'Tambah IBMN',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/admin/Tableuser", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function Register()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'Email telah di gunakan']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_create' => time(),
                'jum_pinjam' => 0
            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_create' => time()
            ];
            $this->m_user->insertUser('user', $data);
            $this->m_user->insertUserToken('user_token', $user_token);

            $this->_sendEmail($token);

            $this->session->set_flashdata('message', 'Data user berhasil disimpan!');
            redirect('admin');
        }
    }

    private function _sendEmail($token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ibmn.teams@gmail.com',
            'smtp_pass' => 'klaus215',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('ibmn.teams@gmail.com', 'IBMN');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Verifikasi Akun');
        $this->email->message('Klik Link ini untuk verifikasi akun: <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '& token=' . urlencode($token) . '">Link ini</a>');
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
        }
    }

    public function Barang()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['barang'] = $this->m_barang->getDetailBarang('barang');

        $theme = array(
            "title" => 'Tambah IBMN',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/admin/Tablebarang", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function addBarang()
    {
        $this->form_validation->set_rules('kode_brg', 'Kode', 'required|trim|is_unique[barang.kd_barang]', ['is_unique' => 'Kode telah digunakan']);
        $this->form_validation->set_rules('nama_brg', 'Nama Barang', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->Barang();
        } else {
            $data = [
                'kd_barang' => $this->input->post('kode_brg'),
                'nama_brg' => $this->input->post('nama_brg'),
                'status' => 'Tersedia'
            ];
            $this->m_barang->insertRowBarang($data);
            $this->session->set_flashdata('message', 'Data barang berhasil disimpan!');
            redirect('admin/barang');
        }
    }

    public function Peminjaman()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['pinjam'] = $this->m_barang->getQueryPeminjaman('barang_pinjam');
        $data['barang'] = $this->m_barang->getBarangWhere('barang', ['status' => 'Tersedia']);
        $data['select'] = $this->m_barang->getBarang('barang');
        $data['userlist'] = $this->m_user->getAllMember('user', 'role_id != 1');

        $theme = array(
            "title" => 'Tambah IBMN',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/admin/Tablepeminjaman", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function addPeminjaman()
    {
        $this->form_validation->set_rules('kode_brg', 'Kode Barang', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == false) {
            $this->Peminjaman();
        } else {
            $kode = $this->input->post('kode_brg');
            $data = [
                'user_id' => $this->input->post('email'),
                'id_barang' => $kode,
                'tgl_pinjam' => time(),
                'keterangan' => $this->input->post('ket'),
            ];
            $this->m_barang->updateStatusBarang('barang', 'id', $kode, 'status', 'Di Pinjam');
            $this->m_barang->insertPinjam('barang_pinjam', $data);
            $this->m_barang->insertPinjam('pinjam_detail', $data);
            $this->session->set_flashdata('message', 'Data peminjaman berhasil disimpan!');
            redirect('admin/peminjaman');
        }
    }

    public function terimaBooking()
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->Peminjaman();
        } else {
            $data = [
                'user_id' => $this->input->post('useremail'),
                'id_barang' => $this->input->post('kdbarang'),
                'tgl_pinjam' => time(),
                'keterangan' => $this->input->post('keterangan'),
            ];
            $ijin = 0;
            $this->m_barang->insertPinjam('pinjam_detail', $data);
            $this->m_barang->updatePinjam('barang_pinjam', 'id_barang', $this->input->post('kdbarang'), 'keterangan', $this->input->post('keterangan'), 'ijin', $ijin, 'tgl_pinjam', time());
            $this->m_barang->updateStatusBarang('barang', 'id', $this->input->post('kdbarang'), 'status', 'Di Pinjam');
            $this->session->set_flashdata('message', 'Booking di setujui ganti!');
            redirect('admin/peminjaman');
        }
    }

    public function batalBooking($id)
    {
        $this->m_barang->updateStatusBarang('barang', 'id', $id, 'status', 'Tersedia');
        $this->m_barang->deletePinjam('barang_pinjam', array('id_barang' => $id));
        $this->session->set_flashdata('message', 'Booking di batalkan!');
        redirect('admin/peminjaman');
    }

    public function Pengembalian()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['kembali'] = $this->m_barang->getQueryPengembalian('barang_kembali');

        $theme = array(
            "title" => 'Tambah IBMN',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/admin/Tablepengembalian", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function cekPengembalian()
    {
        $this->form_validation->set_rules('pinjam', 'ID', 'required');

        if ($this->form_validation->run() == false) {
            $this->Pengembalian()();
        } else {
            $kode = $this->input->post('kdbarang');
            $this->m_barang->updateStatusBarang('barang', 'kd_barang', $kode, 'status', 'Tersedia');
            $this->m_barang->deleteKembali('barang_kembali', ['id' => $this->input->post('kembali')]);
            $this->m_barang->deletePinjam('barang_pinjam', ['id' => $this->input->post('pinjam')]);
            $this->session->set_flashdata('message', 'Barang sudah di konfirmasi!');
            redirect('admin/pengembalian');
        }
    }

    public function batalPengembalian($id)
    {
        $ijin = 2;
        $this->m_barang->updateIjin('barang_pinjam', 'id', $id, 'ijin', $ijin);
        $this->session->set_flashdata('message', 'Pesan sudah dikirim!');
        redirect('admin/pengembalian');
    }

    public function confirmBatalKembali($id)
    {
        $this->m_barang->updateStatusBarang('barang', 'id', $id, 'status', 'Tersedia');
        $this->m_barang->deleteKembali('barang_kembali', array('id_barang' => $id));
        $this->m_barang->deletepinjam('barang_pinjam', array('id_barang' => $id));
        $this->session->set_flashdata('message', 'Status barang sudah Tersedia!');
        redirect('admin/pengembalian');
    }

    public function report()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $data['rekap'] = $this->m_barang->getRekapData('pinjam_detail');

        $theme = array(
            "title" => 'Tambah IBMN',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/report/laporan", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }
}
