<?php

class Supplier_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function supplier_json() {
		$this->datatables->select('id_supplier,nama,alamat,tlp');
		$this->datatables->from('tb_supplier');
		$this->datatables->add_column('view','<button type="button" onclick="edit_type($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button><button onclick="hapus_type($1)" type="button" class="btn btn-danger btn-sm" style="text-align: center;"><i class="fa fa-trash"></i></button>','id_supplier,nama,alamat,tlp');
		return $this->datatables->generate();
	}

	function get_by_id($id) {
		$this->db->from('tb_supplier');
		$this->db->where('id_supplier', $id);

		$query = $this->db->get();
		return $query->row();
	}

	function tampil_suplier(){
		$hsl=$this->db->query("select * from tb_supplier");
		return $hsl;
	}
	

}