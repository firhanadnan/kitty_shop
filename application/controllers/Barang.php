<?php

class Barang extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Barang_model','barang');
		
	}

	function index() {
		$data['title'] = 'Manage barang';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/barang/list_barang');
		$this->load->view('template/backend/footer');
	}

	function detail() {
		$data['title'] = 'Manage barang';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/barang/detail_barang');
		$this->load->view('template/backend/footer');
	}

	function barang_json() {
		header('Content-type: application/json');
		echo $this->barang->barang_json();
	}


	function edit($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->barang->get_by_id($id));
	}

	function delete($id){ //delete record method
	  $this->db->where('id_barang',$id);
	  $this->db->delete('tb_barang');
	}


	function add(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'kd_barang' 	=> form_error('kd_barang'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $insert = array(
	            	'kd_barang' 	=> $this->input->post('kd_barang'),
				);
			$this->db->insert('tb_barang', $insert);
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
                'kd_barang' 	=> form_error('kd_barang'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(
					'kd_barang' 	=> $this->input->post('kd_barang'),
				);
			$this->db->where('id_barang', $this->input->post('id'));
			$this->db->update('tb_barang', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	function add_ukuran() {
		$data = [
			'kd_barang' => $this->input->post('kd_barang'),
			'ukuran' => $this->input->post('size'),
			'warna' => $this->input->post('warna'),
			'qty' => $this->input->post('qty'),
			'harga_beli' => $this->input->post('harga_beli'),
			'harga_jual' => $this->input->post('harga_jual')
		];

		$this->db->insert('tb_ukuran', $data);
		$this->session->set_flashdata('flash', 'Ditambahkan');
		redirect('barang');
	}

	function edit_ukuran($id) {
		$data['title'] = 'Form Update';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['ukuran'] = $this->barang->getUkuranId($id);
        
        $this->form_validation->set_rules('kd_barang', 'kd_barang', 'required');
        $this->form_validation->set_rules('warna', 'warna', 'required');
        $this->form_validation->set_rules('qty', 'qty', 'required');
        $this->form_validation->set_rules('harga_beli', 'harga_beli', 'required');
        $this->form_validation->set_rules('harga_jual', 'harga_jual', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/backend/header', $data);
			$this->load->view('template/backend/sidebar', $data);
			$this->load->view('backend/barang/ubah_ukuran');
			$this->load->view('template/backend/footer');
        } else {
            $data = [
				'kd_barang' => $this->input->post('kd_barang'),
				'warna' => $this->input->post('warna'),
				'qty' => $this->input->post('qty'),
				'harga_beli' => $this->input->post('harga_beli'),
				'harga_jual' => $this->input->post('harga_jual')
			];

			$this->db->where('id_ukuran', $this->input->post('id_ukuran'));
        	$this->db->update('tb_ukuran', $data);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('barang');
        }
	
	}


	private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('kd_barang', 'kd_barang', 'required',[
        	'required'=>'nama_kategori belum diisi !'
        ]);
	}
}