<?php

class Material_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function material_json() {
		$this->datatables->select('id_barang,kd_barang,nama_satuan,nama_kategori');
		$this->datatables->from('tb_bahan_baku');
		$this->datatables->join('tb_kategori', 'kategori = id_kategori');
		$this->datatables->join('tb_satuan', 'satuan = id_satuan');
		// $this->datatables->join('tb_ukuran', 'kd_ukuran = ukuran');
		$this->datatables->add_column('view','<button type="button" onclick="edit_type($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button><button onclick="hapus_type($1)" type="button" class="btn btn-danger btn-sm" style="text-align: center;"><i class="fa fa-trash"></i></button>','id_barang,kd_barang,nama_satuan,nama_kategori,tb_ukuran.ukuran,warna,qty,harga_beli,harga_jual');
		return $this->datatables->generate();
	}

	function get_by_id($id) {
		$this->db->from('tb_bahan_baku');
		$this->db->where('id_barang', $id);

		$query = $this->db->get();
		return $query->row();
	}

	function get_bahan($kobar) {
		$this->db->select('id_barang,kd_barang,nama_satuan,nama_kategori,tb_ukuran.ukuran,warna,qty,harga_beli,harga_jual');
		$this->db->from('tb_bahan_baku');
		$this->db->join('tb_satuan','satuan = id_satuan');
		$this->db->join('tb_kategori','kategori = id_kategori');
		$this->db->join('tb_ukuran', 'tb_bahan_baku.ukuran = tb_ukuran.ukuran');
		$this->db->where('id_barang', $kobar);
		$query = $this->db->get();
		return $query;
	}

	

}