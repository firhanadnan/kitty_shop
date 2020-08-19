<?php

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {

		$data['title'] = 'Login Page';

		$this->form_validation->set_rules('username','Username', 'trim|required');
		$this->form_validation->set_rules('password','Password', 'trim|required');

		if($this->form_validation->run() == FALSE ) {
			$this->load->view('backend/login', $data);
		} else {
			$this->_login();
		}
	}	
		
	private function _login(){
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		//get username from user
		$user = $this->db->get_where('user', ['username' => $username])->row_array();

		// cek user
		if($user){
			if($user['is_active'] == 1){
				if(password_verify($password, $user['password'])){
					$data = [
						'username' => $user['username'],
						'role_id' => $user['role_id'],
						'keterangan' => $user['keterangan'],
						'nama_lengkap' => $user['nama_lengkap'],
					];

					$this->session->set_userdata($data);
					if($user['role_id'] > 0){
						redirect('dashboard');
					} else {
						echo'access denied';
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak cocok !</div>');
                    redirect('auth');
				}
			} else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak aktif, silahkan hubungi administrator !</div>');
                redirect('auth');
			}
		} else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak terdaftar !</div>');
            redirect('auth');
        }
	}


	function logout() {
		$this->session->sess_destroy();
		redirect('auth');
	}

	function blocked() {
		$data['title'] = 'Blocked Page';
		$this->load->view('blocked', $data);
	}
}


