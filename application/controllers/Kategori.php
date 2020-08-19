<?php

class Kategori extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Kategori_model','kategori');
		$this->load->library('Excel');
	}

	function index() {
		$data['title'] = 'Manage Jenis';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/kategori/list_kategori');
		$this->load->view('template/backend/footer');
	}

	function kategori_json() {
		header('Content-type: application/json');
		echo $this->kategori->kategori_json();
	}


	function edit($id){ //update record method
	  header('Content-Type: application/json');
	  echo json_encode($this->kategori->get_by_id($id));
	}

	function delete($id){ //delete record method
	  $this->db->where('id_kategori',$id);
	  $this->db->delete('tb_kategori');
	}

	public function importExcel(){
        $fileName = $_FILES['file']['name'];
          
        $config['upload_path'] = './uploads/import/merk/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 10000; // maksimal sizze
 
        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);
          
        if(! $this->upload->do_upload('file') ){
            echo $this->upload->display_errors();exit();
        }
              
        $inputFileName = './uploads/import/merk/'.$fileName;
 
        try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
 
            for ($row = 2; $row <= $highestRow; $row++){                  
            //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);   
 
                 // Sesuaikan key array dengan nama kolom di database                                                         
                 $data = array(
                    "kode_kategori"=> $rowData[0][1],
                    "nama_kategori"=> $rowData[0][2]
                );
 
                $insert = $this->db->insert("tb_kategori",$data);
                      
            }
            $this->session->set_flashdata('flash', 'Di Import');
            redirect('kategori');
    }


	function add(){ //insert record method
	  $this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE)
        {
            $errors = array(
                'kode_kategori' 	=> form_error('kode_kategori'),
                'nama_kategori' 	=> form_error('nama_kategori'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{
            $insert = array(
	            	'kode_kategori' 	=> $this->input->post('kode_kategori'),
	            	'nama_kategori' 	=> $this->input->post('nama_kategori'),
				);
			$this->db->insert('tb_kategori', $insert);
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
                'kode_kategori' 	=> form_error('kode_kategori'),
                'nama_kategori' 	=> form_error('nama_kategori'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(
					'kode_kategori' 	=> $this->input->post('kode_kategori'),
	            	'nama_kategori' 	=> $this->input->post('nama_kategori'),
				);
			$this->db->where('id_kategori', $this->input->post('id'));
			$this->db->update('tb_kategori', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}


	private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('kode_kategori', 'kode_kategori', 'required',[
        	'required'=>'kode_kategori belum diisi !'
        ]);
        $this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required',[
        	'required'=>'nama_kategori belum diisi !'
        ]);
	}
}