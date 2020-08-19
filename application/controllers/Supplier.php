<?php

class Supplier extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Supplier_model','supplier');
	}

	function index() {
		$data['title'] = 'Manage Supplier';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/supplier/list_supplier');
		$this->load->view('template/backend/footer');
	}

	function supplier_json() {
		header('Content-type: application/json');
		echo $this->supplier->supplier_json();
	}


	function edit($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->supplier->get_by_id($id));
	}

	function delete($id){ //delete record method
	  $this->db->where('id_supplier',$id);
	  $this->db->delete('tb_supplier');
	}


	function add(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'nama' 	=> form_error('nama'),
                'alamat' 	=> form_error('alamat'),
                'tlp' 	=> form_error('tlp'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $insert = array(
	            	'nama' 	=> $this->input->post('nama'),
	                'alamat' 	=> $this->input->post('alamat'),
	                'tlp' 	=> $this->input->post('tlp')
				);
			$this->db->insert('tb_supplier', $insert);
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
                'nama' 	=> form_error('nama'),
                'alamat' 	=> form_error('alamat'),
                'tlp' 	=> form_error('tlp'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(
					'nama' 	=> $this->input->post('nama'),
	                'alamat' 	=> $this->input->post('alamat'),
	                'tlp' 	=> $this->input->post('tlp')
				);
			$this->db->where('id_supplier', $this->input->post('id'));
			$this->db->update('tb_supplier', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}


	private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('nama', 'nama', 'required',[
        	'required'=>'nama belum diisi !'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required',[
        	'required'=>'alamat belum diisi !'
        ]);
        $this->form_validation->set_rules('tlp', 'tlp', 'required',[
        	'required'=>'no telepon belum diisi !'
        ]);
	}
}