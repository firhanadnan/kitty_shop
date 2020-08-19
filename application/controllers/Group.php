<?php

class Group extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Group_model','group');
		is_logged_in();
	}

	function index() {
		$data['title'] = 'Manage Group';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/group/list_group');
		$this->load->view('template/backend/footer');
	}

	function group_json() {
		header('Content-type: application/json');
		echo $this->group->group_json();
	}

	function edit_group($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->group->get_id_group($id));
	}

	function delete_group($id){ //delete record method
	  $this->db->where('group_id',$id);
	  $this->db->delete('menu_group');
	}

	function add_group(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate_group();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'group_name' 	=> form_error('group_name'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $insert = array(
	                'group_name' 	=> $this->input->post('group_name')
				);
			$this->db->insert('menu_group', $insert);
            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
	}

	public function update_group()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validate_group();

        if ($this->form_validation->run() == FALSE){
			$errors = array(
                'group_name' 	=> form_error('group_name'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(
	                'group_name' 	=> $this->input->post('group_name')
				);
			$this->db->where('group_id', $this->input->post('id'));
			$this->db->update('menu_group', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	private function _validate_group()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('group_name', 'Group Name', 'required',[
        	'required'=>'group belum diisi !'
        ]);
	}
}