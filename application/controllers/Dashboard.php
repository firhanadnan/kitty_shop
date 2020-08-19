<?php

class Dashboard extends CI_Controller {
	 function __construct() {
	 	parent::__construct();
	 	is_logged_in();
	 }

	 function index() {
	 	$data['title'] = 'Dashboard';

	 	$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

	 	$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/welcome');
		$this->load->view('template/backend/footer');
	 }
}