<?php

class User extends CI_Controller{
	public $validation_for = '';

	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('datatables');
		$this->load->helper('form');
		is_logged_in();
	}

	public function index(){
		$data['title'] = 'Manage user';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
				
		$this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar', $data);
        $this->load->view('backend/user/list_user');
        $this->load->view('template/backend/footer');

	}

	function user_json() { //get product data and encode to be JSON object
      header('Content-Type: application/json');
      echo $this->User_model->user_json();
    }

   	function get_role() { //get product data and encode to be JSON object
      header('Content-Type: application/json');
      echo json_encode($this->User_model->get_role());
    }

	function edit($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->User_model->get_by_id($id));
	}

	function delete($id){ //delete record method
	  $user = $this->User_model->get_by_id($id);
				if(file_exists('uploads/user/'.$user->photo) && $user->photo)
					unlink('uploads/user/'.$user->photo);
						
	  $this->db->where('user_id',$id);
	  $this->db->delete('user');
	}

	function add(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'username' 	=> form_error('username'),
                'password' 	=> form_error('password'),
                'nama_lengkap' 	=> form_error('nama_lengkap'),
                'is_active' 	=> form_error('is_active'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $data = array(
					'username' 	=> $this->input->post('username'),
					'password' 	=> $this->input->post('password'),
	                'nama_lengkap' 	=> password_verify($this->input->post('nama_lengkap')),
	                'role_id' 	=> $this->input->post('role_id'),
	                'is_active' 	=> $this->input->post('is_active')
				);
           	if(!empty($_FILES['photo']['name']))
			{
				$upload = $this->_do_upload();
				$data['photo'] = $upload;
			}


			$this->User_model->save($data);
            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'uploads/user/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	public function update()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE){
			$errors = array(
				'username' 	=> form_error('username'),
                'password' 	=> form_error('password'),
                'nama_lengkap' 	=> form_error('nama_lengkap'),
                'is_active' 	=> form_error('is_active'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$data = array(
					'username' 	=> $this->input->post('username'),
					'password' 	=> $this->input->post('password'),
	                'nama_lengkap' 	=> password_hash($this->input->post('nama_lengkap')),
	                'role_id' 	=> $this->input->post('role_id'),
	                'is_active' 	=> $this->input->post('is_active')
				);
			//if remove photo checked
			if($this->input->post('remove_photo')){
				if(file_exists('uploads/user/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
					unlink('uploads/user/'.$this->input->post('remove_photo'));
					$data['photo'] = '';
			}

			if(!empty($_FILES['photo']['name']))
			{
				$upload = $this->_do_upload();
				
				//delete file
				$user = $this->User_model->get_by_id($this->input->post('id'));
				if(file_exists('uploads/user/'.$user->photo) && $user->photo)
					unlink('uploads/user/'.$user->photo);

				$data['photo'] = $upload;
			}

			$this->db->where('user_id', $this->input->post('id'));
			$this->db->update('user', $data);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	private function _validate()
	{

		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('username', 'username', 'required',[
        	'required'=>'username belum diisi !'
        ]);
        $this->form_validation->set_rules('password', 'password', 'required',[
        	'required'=>'password belum diisi !'
        ]);
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required',[
        	'required'=>'nama belum diisi !'
        ]);
    }
}

?>