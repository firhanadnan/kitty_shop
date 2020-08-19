<?php

class Satuan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Satuan_model','satuan');
	}

	function index() {
		$data['title'] = 'Manage Jenis';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/satuan/list_satuan');
		$this->load->view('template/backend/footer');
	}

	function satuan_json() {
		header('Content-type: application/json');
		echo $this->satuan->satuan_json();
	}


	function edit($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->satuan->get_by_id($id));
	}

	function delete($id){ //delete record method
	  $this->db->where('id_satuan',$id);
	  $this->db->delete('tb_satuan');
	}


	function add(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'kode_satuan' 	=> form_error('nama_satuan'),
                'nama_satuan' 	=> form_error('nama_satuan'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $insert = array(
	            	'kode_satuan' 	=> $this->input->post('kode_satuan'),
	            	'nama_satuan' 	=> $this->input->post('nama_satuan'),
				);
			$this->db->insert('tb_satuan', $insert);
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
                'kode_satuan' 	=> form_error('kode_satuan'),
                'nama_satuan' 	=> form_error('nama_satuan'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(
					'kode_satuan' 	=> $this->input->post('kode_satuan'),
					'nama_satuan' 	=> $this->input->post('nama_satuan'),
				);
			$this->db->where('id_satuan', $this->input->post('id'));
			$this->db->update('tb_satuan', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}


	private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('kode_satuan', 'kode_satuan', 'required',[
        	'required'=>'kode_satuan belum diisi !'
        ]);
        $this->form_validation->set_rules('nama_satuan', 'nama_satuan', 'required',[
        	'required'=>'nama_satuan belum diisi !'
        ]);
	}
}