<?php

class Penjualan_model extends CI_model {
	function bahan_json() {
		$this->datatables->select('id_barang,tb_barang.kd_barang,nama_satuan,nama_kategori,ukuran,warna,qty,harga_beli');
		$this->datatables->from('tb_barang');
		$this->datatables->join('tb_satuan', 'satuan = kode_satuan');
		$this->datatables->join('tb_kategori', 'kategori = kode_kategori');
		$this->datatables->join('tb_ukuran', 'tb_barang.kd_barang = tb_ukuran.kd_barang');
		$this->datatables->add_column('view','<button type="button" onclick="edit_type($1)" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>','id_barang,nama_barang,nama_satuan,harga_beli,stok,nama_kategori,min_stok');
		return $this->datatables->generate();
	}

	function update_cart($rowid,$qty) {
		$data = array(
	            'rowid' => $rowid,
	            'qty' => $qty
	    );

		$this->cart->update($data);
	}

	function simpan_penjualan($kode_jual,$total,$jml_uang,$kembalian){
		$username = $this->session->userdata('username');
		$keterangan = $this->session->userdata('keterangan');
		$this->db->query("INSERT INTO tb_order (invoice,total,jml_uang,kembalian,username,keterangan) VALUES ('$kode_jual','$total','$jml_uang','$kembalian','$username','$keterangan')");
			foreach ($this->cart->contents() as $item) {
			$ukuran = $item['options']['ukuran'];   
			$warna = $item['options']['warna'];    
					$data = array(
						'invoice_order' 	=>	$kode_jual,
						'kd_barang'	=>	$item['id'],
						'nabar'	=>	$item['name'],
						'kategori'	=>	$item['satuan'],
						'harjul'		=>	$item['price'],
						'qty'	=>	$item['qty'],
						'total'		=>	$item['subtotal'],
						'ukuran' => $item['options']['ukuran'],
						'warna' => $item['options']['warna']
					);
					
					$this->db->insert('tb_detail_order',$data);
					$this->db->query("update tb_ukuran set qty=qty-'$item[qty]' where kd_barang = '$item[id]' and ukuran = '$ukuran' and warna = '$warna'");
			}
			return true;
	}

	function kode_bahan() {
		$query = $this->db->query("SELECT MAX(RIGHT(invoice,6)) AS kd_max FROM tb_order WHERE DATE(tanggal)=CURDATE()");
		$kd = "";
		if($query->num_rows() > 0) {
			foreach($query->result() as $k) {
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		return "PU".date('dmy').$kd;
	}

	
}