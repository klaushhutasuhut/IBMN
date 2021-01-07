<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('email', 'role_id' == 1)) {
			redirect('admin');
		} else if ($this->session->userdata('email', 'role_id' == 2)) {
			redirect('member');
		}
		$theme = array(
			"title" => 'Login IBMN',
			"content" => $this->load->view("screens/login/contents/Form", array(), true),
		);
		$this->load->view("screens/login/index", $theme);
	}

	public function Login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$this->ValidateLogin();
		}
	}

	private function ValidateLogin()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('pass');

		$user = $this->m_auth->getWhereUser('user', ['email' => $email]);

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('admin');
					}
					redirect('member');
				} else {
					$this->session->set_flashdata('gagal', 'Password salah silahkan login kembali!');
					$this->index();
				}
			} else {
				$this->session->set_flashdata('gagal', 'Email belum active silahkan cek email anda');
				$this->index();
			}
		} else {
			$this->session->set_flashdata('gagal', 'Email tidak terdaftar');
			$this->index();
		}
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			if ($this->session->userdata('email', 'role_id' == 1)) {
				redirect('admin');
			} else if ($this->session->userdata('email', 'role_id' == 2)) {
				redirect('member');
			}
			$theme = array(
				"title" => 'Forget Password',
				"content" => $this->load->view("screens/login/contents/Forgotpass", array(), true),
			);
			$this->load->view("screens/login/index", $theme);
		} else {
			$email = $this->input->post('email');
			$user = $this->m_auth->getWhereUser('user', ['email' => $email, 'is_active' => 1]);

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_create' => time()
				];

				$this->m_user->insertUserToken('user_token', $user_token);
				$this->_sendEmail($token);

				$this->session->set_flashdata('message', 'Silahkan cek email untuk reset password!');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('gagal', 'Email tidak terdaftar atau belum aktif!');
				redirect('auth/forgotpassword');
			}
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
		$this->email->subject('Reset Password');
		$this->email->message('Klik Link ini untuk mengganti password: <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '& token=' . urlencode($token) . '">Reset password</a>');
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->m_auth->getWhereUser('user', ['email' => $email]);

		if ($user) {
			$user_token = $this->m_auth->getWhereUser('user_token', ['token' => $token]);

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('gagal', 'Ganti password gagal! salah token');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('gagal', 'Ganti password gagal! salah email');
			redirect('auth');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		$this->form_validation->set_rules('pass1', 'Password Baru', 'required|trim|min_length[6]|matches[pass2]');
		$this->form_validation->set_rules('pass2', 'Ketik Ulang Password', 'required|trim|min_length[6]|matches[pass1]');

		if ($this->form_validation->run() == false) {
			$theme = array(
				"title" => 'Ganti Password',
				"content" => $this->load->view("screens/login/contents/Resetpass", array(), true),
			);
			$this->load->view("screens/login/index", $theme);
		} else {
			$password = password_hash($this->input->post('pass1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->m_user->updatePassword('user', 'email', $email, 'password', $password);
			$this->m_user->deleteUser('user_token', 'email');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', 'Password berhasil di ganti! silahkan login');
			redirect('auth');
		}
	}

	public function Verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->m_auth->getWhereUser('user', ['email' => $email]);

		if ($user) {
			$user_token = $this->m_auth->getWhereUser('user_token', ['token' => $token]);

			if ($user_token) {
				if (time() - $user_token['date_create'] < (60 * 60 * 24)) {
					$this->m_user->updateUser('user', 'email', $email, 'is_active', 1);

					$this->m_user->deleteUser('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', ' ' . $email . 'Aktivasi berhasil silahkan login');
					redirect('auth');
				} else {
					$this->m_user->deleteUser('user', ['email' => $email]);
					$this->m_user->deleteUser('user_token', ['email' => $email]);

					$this->session->set_flashdata('gagal', 'Aktivasi Akun Gagal! Token Expired');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('gagal', 'Aktivasi Akun Gagal! Salah token.');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('gagal', 'Aktivasi Akun Gagal! Salah email.');
			redirect('auth');
		}
	}

	public function Logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', 'Anda telah logout');
		redirect('auth');
	}
}
