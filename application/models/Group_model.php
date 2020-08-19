<?php

class Group_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function group_json() {
		$this->datatables->select('group_id,group_name');
		$this->datatables->from('menu_group');
		$this->datatables->add_column('view','<button type="button" onclick="edit_group($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button><button onclick="hapus_group($1)" type="button" class="btn btn-danger btn-sm" style="text-align: center;"><i class="fa fa-trash"></i></button>','group_id,group_name');

		return $this->datatables->generate();
	}

	function get_id_group($id) {
		$this->db->from('menu_group');
		$this->db->where('group_id', $id);

		$query = $this->db->get();
		return $query->row();
	}
}