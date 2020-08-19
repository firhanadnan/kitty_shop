<?php

class Pembelian_model extends CI_model {
	function bahan_json() {
		$this->datatables->select('id_barang,tb_barang.kd_barang,nama_satuan,nama_kategori,ukuran,warna,SUM(qty) AS qty,harga_beli');
		$this->datatables->from('tb_barang');
		$this->datatables->join('tb_satuan', 'satuan = kode_satuan');
		$this->datatables->join('tb_kategori', 'kategori = kode_kategori');
		$this->datatables->join('tb_ukuran', 'tb_barang.kd_barang = tb_ukuran.kd_barang');
		$this->datatables->group_by('tb_barang.kd_barang');
		$this->datatables->add_column('view','<button type="button" onclick="edit_type($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>','id_barang,nama_barang,nama_satuan,harga_beli,stok,nama_kategori');
		return $this->datatables->generate();
	}

	function update_cart($rowid,$qty) {
		$data = array(
	            'rowid' => $rowid,
	            'qty' => $qty
	    );

		$this->cart->update($data);
	}

	function kode_bahan() {
		$query = $this->db->query("SELECT MAX(RIGHT(invoice,6)) AS kd_max FROM tb_beli WHERE DATE(tgl_beli)=CURDATE()");
		$kd = "";
		if($query->num_rows() > 0) {
			foreach($query->result() as $k) {
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		return "BL".date('dmy').$kd;
	}

	
}