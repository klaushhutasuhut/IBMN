<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    //metode default dalam kelas ini
    public function index()
    {
        //untuk menampilkan halaman login yang sudah di pisah menjadi template
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);
        $theme = array(
            "title" => 'Tambah IBMN',
            "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
            "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
            "content" => $this->load->view("screens/course/contents/profile/Myprofile", $data, true),
            "footer" => $this->load->view("screens/course/components/Footer", array(), true),
        );
        $this->load->view("screens/course/index", $theme);
    }

    public function editProfile()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);

        $this->form_validation->set_rules('nama', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $theme = array(
                "title" => 'Tambah IBMN',
                "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
                "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
                "content" => $this->load->view("screens/course/contents/profile/Editprofile", $data, true),
                "footer" => $this->load->view("screens/course/components/Footer", array(), true),
            );
            $this->load->view("screens/course/index", $theme);
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '7048';
                $config['upload_path'] = './assets/image';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/image/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->m_user->updateProfilePic('user', $email, $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->m_user->updateProfileNama('user', $email, $nama);
            $this->session->set_flashdata('message', 'Profile berhasil diedit!');
            redirect('profile');
        }
    }

    public function gantipassword()
    {
        $data['user'] = $this->m_auth->getWhereUser('user', ['email' => $this->session->userdata('email')]);

        $this->form_validation->set_rules('oldpassword', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('newpassword', 'Password Baru', 'required|trim|min_length[6]|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Ketik Ulang Password', 'required|trim|min_length[6]|matches[newpassword]');

        if ($this->form_validation->run() == false) {
            $theme = array(
                "title" => 'Tambah IBMN',
                "sidebar" => $this->load->view("screens/course/components/Sidebar", $data, true),
                "navbar" => $this->load->view("screens/course/components/Navbar", $data, true),
                "content" => $this->load->view("screens/course/contents/profile/gantipassword", $data, true),
                "footer" => $this->load->view("screens/course/components/Footer", array(), true),
            );
            $this->load->view("screens/course/index", $theme);
        } else {
            $passwordlama = $this->input->post('oldpassword');
            $passwordbaru = $this->input->post('newpassword');

            if (!password_verify($passwordlama, $data['user']['password'])) {
                $this->session->set_flashdata('gagal', 'Password lama salah!');
                redirect('profile/gantipassword');
            } else {
                if ($passwordlama == $passwordbaru) {
                    $this->session->set_flashdata('gagal', 'Password tidak boleh sama dengan yang lama');
                    redirect('profile/gantipassword');
                } else {
                    $passwordhash = password_hash($passwordbaru, PASSWORD_DEFAULT);

                    $this->m_user->updatePassword('user', 'email', $this->session->userdata('email'), 'password', $passwordhash);

                    $this->session->set_flashdata('message', 'Password berhasil di ganti!');
                    redirect('profile/gantipassword');
                }
            }
        }
    }
}
