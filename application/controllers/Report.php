<?php

class Report extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Barang_model','barang');
		$this->load->model('Kategori_model','kategori');
		$this->load->model('Supplier_model','supplier');
		$this->load->model('Pembelian_model','pembelian');
		$this->load->model('Penjualan_model','Penjualan');
		$this->load->model('Report_model','report');
	}

	function index() {
		$data['title'] = 'Laporan';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['jual_bln']=$this->report->get_bulan_jual();
		$data['jual_thn']=$this->report->get_tahun_jual();

		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/report/list_report');
		$this->load->view('template/backend/footer');
	}

	function lap_data_barang(){
		$x['data']=$this->report->get_data_barang();
		$this->load->view('backend/report/v_lap_barang', $x);
	}

	function lap_stok_barang(){
		$x['data']=$this->report->get_stok_barang();
		$this->load->view('backend/report/v_lap_stok_barang', $x);
	}

	function lap_data_penjualan(){
		$x['data']=$this->report->get_data_penjualan();
		$x['jml']=$this->report->get_total_penjualan();
		$this->load->view('backend/report/v_lap_penjualan', $x);
	}

	function lap_penjualan_pertanggal(){
		$tanggal=$this->input->post('tgl');
		$x['jml']=$this->report->get_data__total_jual_pertanggal($tanggal);
		$x['data']=$this->report->get_data_jual_pertanggal($tanggal);
		$this->load->view('backend/report/v_lap_jual_pertanggal',$x);
	}

	function lap_penjualan_perbulan(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->report->get_total_jual_perbulan($bulan);
		$x['data']=$this->report->get_jual_perbulan($bulan);
		$this->load->view('backend/report/v_lap_jual_perbulan',$x);
	}

	function lap_penjualan_pertahun(){
		$tahun=$this->input->post('thn');
		$x['jml']=$this->report->get_total_jual_pertahun($tahun);
		$x['data']=$this->report->get_jual_pertahun($tahun);
		$this->load->view('backend/report/v_lap_jual_pertahun',$x);
	}

	function lap_laba_rugi(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->report->get_total_lap_laba_rugi($bulan);
		$x['data']=$this->report->get_lap_laba_rugi($bulan);
		$this->load->view('backend/report/v_lap_laba_rugi',$x);
	}

}