<?php

class Barang_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function barang_json() {
		$this->datatables->select('id_barang,tb_barang.kd_barang,nama_satuan,nama_kategori,ukuran,warna,qty,harga_beli');
		$this->datatables->from('tb_barang');
		$this->datatables->join('tb_satuan', 'satuan = kode_satuan');
		$this->datatables->join('tb_kategori', 'kategori = kode_kategori');
		$this->datatables->join('tb_ukuran', 'tb_barang.kd_barang = tb_ukuran.kd_barang');
		$this->datatables->group_by('tb_barang.kd_barang');
		$this->datatables->add_column('view','<a href="barang/detail/$1" class="edit_record btn btn-warning btn-sm mr-1" data-kode="$1"><i class="fa fa-eye" aria-hidden="true"></i></a><button type="button" onclick="edit_type($2)" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></button><button onclick="hapus_type($2)" type="button" class="btn btn-danger btn-sm " style="text-align: center;"><i class="fa fa-trash"></i></button>' , 'kd_barang,id_barang');
		return $this->datatables->generate();
	}

	function get_by_id($id) {
		$this->db->from('tb_barang');
		$this->db->where('id_barang', $id);

		$query = $this->db->get();
		return $query->row();
	}

	public function getUkuranId($id)
    {
        return $this->db->get_where('tb_ukuran', ['id_ukuran' => $id])->row_array();
    }

    function get_bahan($kobar) {
		$this->db->select('id_barang,tb_barang.kd_barang,nama_satuan,nama_kategori,tb_ukuran.ukuran,warna,qty,harga_beli,harga_jual');
		$this->db->from('tb_barang');
		$this->db->join('tb_satuan','satuan = kode_satuan');
		$this->db->join('tb_kategori','kategori = kode_kategori');
		$this->datatables->join('tb_ukuran', 'tb_barang.kd_barang = tb_ukuran.kd_barang');
		$this->db->where('tb_barang.kd_barang', $kobar);
		$query = $this->db->get();
		return $query;
	}

}

			