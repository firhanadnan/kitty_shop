<?php

class Material extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Material_model','material');
	}

	function index() {
		$data['title'] = 'Manage Barang';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/material/list_material');
		$this->load->view('template/backend/footer');
	}

	function material_json() {
		header('Content-type: application/json');
		echo $this->material->material_json();
	}


	function edit($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->material->get_by_id($id));
	}

	function delete($id){ //delete record method
	  $this->db->where('id_barang',$id);
	  $this->db->delete('tb_bahan_baku');
	}


	function add(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'nama_barang' 	=> form_error('nama_barang'),
                'satuan' 	=> form_error('satuan'),
                'harga_beli' 	=> form_error('harga_beli'),
                'stok' 	=> form_error('stok'),
                'min_stok' 	=> form_error('min_stok'),
                'kategori' 	=> form_error('kategori'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $insert = array(
	            	'nama_barang' 	=> $this->input->post('nama_barang'),
	            	'satuan' 	=> $this->input->post('satuan'),
	                'harga_beli' 	=> $this->input->post('harga_beli'),
	                'stok' 	=> $this->input->post('stok'),
	                'min_stok' 	=> $this->input->post('min_stok'),
	                'kategori' 	=> $this->input->post('kategori'),
	                'username' 	=> $this->session->userdata('username')
				);
			$this->db->insert('tb_bahan_baku', $insert);
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
                'nama_barang' 	=> form_error('nama_barang'),
                'satuan' 	=> form_error('satuan'),
                'harga_beli' 	=> form_error('harga_beli'),
                'stok' 	=> form_error('stok'),
                'min_stok' 	=> form_error('min_stok'),
                'kategori' 	=> form_error('kategori'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(
					'nama_barang' 	=> $this->input->post('nama_barang'),
	            	'satuan' 	=> $this->input->post('satuan'),
	                'harga_beli' 	=> $this->input->post('harga_beli'),
	                'stok' 	=> $this->input->post('stok'),
	                'min_stok' 	=> $this->input->post('min_stok'),
	                'kategori' 	=> $this->input->post('kategori'),
	                'username' 	=> $this->session->userdata('username')
				);
			$this->db->where('id_barang', $this->input->post('id'));
			$this->db->update('tb_bahan_baku', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}


	private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'required',[
        	'required'=>'nama barang belum diisi !'
        ]);
        $this->form_validation->set_rules('satuan', 'satuan', 'required',[
        	'required'=>'satuan belum diisi !'
        ]);
        $this->form_validation->set_rules('harga_beli', 'harga_beli', 'required',[
        	'required'=>'harga beli belum diisi !'
        ]);
        $this->form_validation->set_rules('stok', 'stok', 'required',[
        	'required'=>'stok belum diisi !'
        ]);
        $this->form_validation->set_rules('min_stok', 'min_stok', 'required',[
        	'required'=>'minimal stok belum diisi !'
        ]);
        $this->form_validation->set_rules('kategori', 'kategori', 'required',[
        	'required'=>'kategori belum diisi !'
        ]);
	}
	
}