<?php

class Report_model extends CI_Model {
	
	function get_data_barang(){
		$hsl=$this->db->query("SELECT tb_barang.kd_barang,id_kategori,nama_kategori,nama_satuan,qty,harga_jual FROM tb_barang JOIN tb_kategori ON tb_barang.kategori=kode_kategori JOIN  tb_satuan ON tb_barang.satuan=kode_satuan JOIN  tb_ukuran ON tb_barang.kd_barang=tb_ukuran.kd_barang GROUP BY kode_kategori,nama_satuan ORDER BY nama_kategori,tb_barang.kd_barang ASC");
		return $hsl;
	}

	function get_stok_barang(){
		$hsl=$this->db->query("SELECT tb_barang.kd_barang,id_kategori,nama_kategori,nama_satuan,qty FROM tb_barang JOIN tb_kategori ON tb_barang.kategori=kode_kategori JOIN  tb_satuan ON tb_barang.satuan=kode_satuan JOIN  tb_ukuran ON tb_barang.kd_barang=tb_ukuran.kd_barang GROUP BY kode_kategori,nama_satuan");
		return $hsl;
	}

	function get_data_penjualan(){
		$hsl=$this->db->query("SELECT invoice,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,tb_order.total,kd_barang,ukuran,warna,harjul,qty,tb_detail_order.total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order ORDER BY invoice DESC");
		return $hsl;
	}
	function get_total_penjualan(){
		$hsl=$this->db->query("SELECT sum(tb_detail_order.total) as total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order ORDER BY invoice DESC");
		return $hsl;
	}
	function get_data_jual_pertanggal($tanggal){
		$hsl=$this->db->query("SELECT invoice,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,kd_barang,nabar,kategori,ukuran,warna,harjul,qty,tb_detail_order.total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE DATE(tanggal)='$tanggal' ORDER BY invoice DESC");
		return $hsl;
	}
	function get_data__total_jual_pertanggal($tanggal){
		$hsl=$this->db->query("SELECT DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,SUM(tb_detail_order.total) as total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE DATE(tanggal)='$tanggal' ORDER BY invoice DESC");
		return $hsl;
	}
	function get_bulan_jual(){
		$hsl=$this->db->query("SELECT DISTINCT DATE_FORMAT(tanggal,'%M %Y') AS bulan FROM tb_order");
		return $hsl;
	}
	function get_tahun_jual(){
		$hsl=$this->db->query("SELECT DISTINCT YEAR(tanggal) AS tahun FROM tb_order");
		return $hsl;
	}
	function get_jual_perbulan($bulan){
		$hsl=$this->db->query("SELECT invoice,DATE_FORMAT(tanggal,'%M %Y') AS bulan,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,kd_barang,nabar,kategori,ukuran,warna,harjul,qty,tb_detail_order.total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE DATE_FORMAT(tanggal,'%M %Y')='$bulan' ORDER BY invoice DESC");
		return $hsl;
	}
	function get_total_jual_perbulan($bulan){
		$hsl=$this->db->query("SELECT DATE_FORMAT(tanggal,'%M %Y') AS bulan,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,SUM(tb_detail_order.total) as total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE DATE_FORMAT(tanggal,'%M %Y')='$bulan' ORDER BY invoice DESC");
		return $hsl;
	}
	function get_jual_pertahun($tahun){
		$hsl=$this->db->query("SELECT invoice,YEAR(tanggal) AS tahun,DATE_FORMAT(tanggal,'%M %Y') AS bulan,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,kd_barang,nabar,kategori,ukuran,warna,harjul,qty,tb_detail_order.total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE YEAR(tanggal)='$tahun' ORDER BY invoice DESC");
		return $hsl;
	}
	function get_total_jual_pertahun($tahun){
		$hsl=$this->db->query("SELECT YEAR(tanggal) AS tahun,DATE_FORMAT(tanggal,'%M %Y') AS bulan,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,SUM(tb_detail_order.total) as total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE YEAR(tanggal)='$tahun' ORDER BY invoice DESC");
		return $hsl;
	}

	
	//=========Laporan Laba rugi============
	function get_lap_laba_rugi($bulan){
		$hsl=$this->db->query("SELECT DATE_FORMAT(tanggal,'%d %M %Y %H:%i:%s') as tanggal,kd_barang,nabar,kategori,ukuran,warna,harpok,harjul,(harjul-harpok) AS keunt,qty,((harjul-harpok)*qty) AS untung_bersih FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE DATE_FORMAT(tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
	function get_total_lap_laba_rugi($bulan){
		$hsl=$this->db->query("SELECT DATE_FORMAT(tanggal,'%M %Y') AS bulan,kd_barang,nabar,kategori,ukuran,warna,harpok,harjul,(harjul-harpok) AS keunt,qty,SUM(((harjul-harpok)*qty)) AS total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE DATE_FORMAT(tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
}