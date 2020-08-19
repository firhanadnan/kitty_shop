<?php

class Role extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Role_model');
        is_logged_in();
	}

	public function index(){
		$data['title'] = 'Manage Role';
		//session username sidebar
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		//get data menu
		$data['role'] = $this->Role_model->get_all();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar');
        $this->load->view('backend/role/list_role');
        $this->load->view('template/backend/footer');
	}

	public function detail(){
		$data['title'] = 'Manage Role Access';
		//session username sidebar
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		
        $data['role'] = $this->db->get_where('role', ['role_id' => $this->uri->segment(3)])->row_array();

		//$this->db->where('group_id !=', 1);
        $data['group'] = $this->db->get('menu_group')->result();

        $this->load->view('template/backend/header', $data);
        $this->load->view('template/backend/sidebar');
        $this->load->view('backend/role/detail_role', $data);
        $this->load->view('template/backend/footer');
		
	}

    public function add() 
    {
        
        $data = [
            'role_name' => $this->input->post('role_name',TRUE)
        ];
        $this->db->insert('role',$data);
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('role');
    }

    public function update()
    {
        $data['role'] = $this->db->get('role')->result_array();

        $data = [
            'role_name' => $this->input->post('role_name',TRUE)
        ];

        $this->db->where('role_id', $this->input->post('id'));
        $this->db->update('role', $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('role');
    }

    public function delete($id)
    {
        $this->Role_model->delete($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('role');
    }

	// public function changeAccess()
 //    {
 //        $menu_id = $this->input->post('menu_id');
 //        $role_id = $this->input->post('role_id');

 //        $data = [
 //            'role_id' => $role_id,
 //            'menu_id' => $menu_id
 //        ];

 //        $result = $this->db->get_where('menu_access', $data);

 //        if ($result->num_rows() < 1) {
 //            $this->db->insert('menu_access', $data);
 //        } else {
 //            $this->db->delete('menu_access', $data);
 //        }

 //        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
 //    }

    function kasi_akses_ajax(){
        $id_menu        = $_GET['id_menu'];
        $id_user_level  = $_GET['level'];
        // chek data
        $params = array('group_id'=>$id_menu,'role_id'=>$id_user_level);
        $akses = $this->db->get_where('menu_access',$params);
        if($akses->num_rows()<1){
            // insert data baru
            $this->db->insert('menu_access',$params);
        }else{
            $this->db->where('group_id',$id_menu);
            $this->db->where('role_id',$id_user_level);
            $this->db->delete('menu_access');
        }
    }
}

?>