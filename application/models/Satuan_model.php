<?php

class Satuan_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function satuan_json() {
		$this->datatables->select('id_satuan,kode_satuan,nama_satuan');
		$this->datatables->from('tb_satuan');
		$this->datatables->add_column('view','<button type="button" onclick="edit_type($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button><button onclick="hapus_type($1)" type="button" class="btn btn-danger btn-sm" style="text-align: center;"><i class="fa fa-trash"></i></button>','id_satuan,kode_satuan,nama_satuan');
		return $this->datatables->generate();
	}

	function get_by_id($id) {
		$this->db->from('tb_satuan');
		$this->db->where('id_satuan', $id);

		$query = $this->db->get();
		return $query->row();
	}

	

}