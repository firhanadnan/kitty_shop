<?php

class Menu_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function menu_json() {
		$this->datatables->select('menu_id,menu.group_id,menu_group.group_name,menu_title,menu_link,menu_icon,menu_type');
		$this->datatables->from('menu');
		$this->datatables->join('menu_group','menu.group_id = menu_group.group_id');
		$this->datatables->add_column('view','<button type="button" onclick="edit_type($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button><button onclick="hapus_type($1)" type="button" class="btn btn-danger btn-sm" style="text-align: center;"><i class="fa fa-trash"></i></button>','menu_id,menu.group_id,menu_group.group_name,menu_title,menu_link,menu_icon,menu_type');

		return $this->datatables->generate();
	}

	function get_by_id($id) {
		$this->db->from('menu');
		$this->db->where('menu_id', $id);

		$query = $this->db->get();
		return $query->row();
	}
}