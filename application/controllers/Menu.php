<?php


class Menu extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Menu_model','menu');
		is_logged_in();
	}

	function index() {
		$data['title'] = 'Manage Menu';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/menu/list_menu');
		$this->load->view('template/backend/footer');
	}

	function menu_json() {
		header('Content-type: application/json');
		echo $this->menu->menu_json();
	}


	function edit($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->menu->get_by_id($id));
	}

	function delete($id){ //delete record method
	  $this->db->where('menu_id',$id);
	  $this->db->delete('menu');
	}


	function add(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'menu_title' 	=> form_error('menu_title'),
                'menu_link' 	=> form_error('menu_link'),
                'menu_icon' 	=> form_error('menu_icon'),
                'group_name' 	=> form_error('group_name'),
                'menu_type' 	=> form_error('menu_type'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $insert = array(
					'menu_title' 	=> $this->input->post('menu_title'),
	                'menu_link' 	=> $this->input->post('menu_link'),
	                'menu_icon' 	=> $this->input->post('menu_icon'),
	                'group_id' 	=> $this->input->post('group_name'),
	                'menu_type' 	=> $this->input->post('menu_type')
				);
			$this->db->insert('menu', $insert);
            $data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
	}

	public function update()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE){
			$errors = array(
                'menu_title' 	=> form_error('menu_title'),
                'menu_link' 	=> form_error('menu_link'),
                'menu_icon' 	=> form_error('menu_icon'),
                'group_name' 	=> form_error('group_name'),
                'menu_type' 	=> form_error('menu_type'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(
					'menu_title' 	=> $this->input->post('menu_title'),
	                'menu_link' 	=> $this->input->post('menu_link'),
	                'menu_icon' 	=> $this->input->post('menu_icon'),
	                'group_id' 	=> $this->input->post('group_name'),
	                'menu_type' 	=> $this->input->post('menu_type')
				);
			$this->db->where('menu_id', $this->input->post('id'));
			$this->db->update('menu', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}


	private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('menu_title', 'menu_title', 'required',[
        	'required'=>'title belum diisi !'
        ]);
        $this->form_validation->set_rules('menu_link', 'menu_link', 'required',[
        	'required'=>'url belum diisi !'
        ]);
        $this->form_validation->set_rules('menu_icon', 'menu_icon', 'required',[
        	'required'=>'icon belum diisi !'
        ]);
	}
}