<?php

class Penjualan extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Penjualan_model','penjualan');
		$this->load->model('Barang_model','barang');
	}

	function index() {
		$data['title'] = 'Penjualan Barang';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kd_bahan'] = $this->penjualan->kode_bahan();

		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/penjualan/add_penjualan');
		$this->load->view('template/backend/footer');
	}

	function get_bahan() {
		$kobar  = $this->input->post('kode_brg');

		$data['bahan'] = $this->barang->get_bahan($kobar);
		$this->load->view('backend/penjualan/detail_penjualan', $data);
	}

	function get_warna() {
		$kobar = $this->input->post('kode_brg');
		$ukuran = $this->input->post('ukuran');

		$warna = $this->db->query("SELECT warna FROM tb_ukuran WHERE kd_barang = '$kobar' AND ukuran = '$ukuran' ORDER BY ukuran DESC")->result();

		$lists = "<option value=''>Pilih</option>";
		
		foreach($warna as $data){
			$lists .= "<option value='".$data->warna."'>".$data->warna."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_warna'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}

	function get_qty() {
		$kobar = $this->input->post('kode_brg');
		$ukuran = $this->input->post('ukuran');
		$warna = $this->input->post('warna');

		$query = $this->db->query("SELECT harga_jual,qty FROM tb_ukuran WHERE kd_barang = '$kobar' AND ukuran = '$ukuran' AND warna = '$warna'")->row_array();
		echo json_encode($query); 
		
	}

	function add_to_cart() {
	
		$tgl = $this->input->post('tgl');
		$supplier = $this->input->post('supplier');

		$this->session->set_userdata('tgl',$tgl);
		$this->session->set_userdata('supplier',$supplier);

		$data = array(
			'id' => $this->input->post('kode_brg'),
			'name' => $this->input->post('nabar'),
			'satuan' => $this->input->post('kategori'),		
        	'options'=> array(
        					'ukuran' => $this->input->post('ukuran'),
        					'warna'    => $this->input->post('warna')
        				),            
            'harga'    => $this->input->post('harpok'),
            'price'    => $this->input->post('harjul'),
            'qty'      => $this->input->post('jumlah')
            
		);
		$this->cart->insert($data);
		redirect('penjualan');			 
		
	}

	function save() {
		
		$total=$this->input->post('total');
		$jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
		$kembalian=$jml_uang-$total;
		if(!empty($total) && !empty($jml_uang)){
			if($jml_uang < $total){
				echo $this->session->set_flashdata('msg','<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
				redirect('penjualan');
			}else{
				$kode_jual = $this->penjualan->kode_bahan();
				$order_proses=$this->penjualan->simpan_penjualan($kode_jual,$total,$jml_uang,$kembalian);
				if($order_proses){
					$this->cart->destroy();
					redirect('penjualan');	
				}else{
					redirect('penjualan');
				}
			}
			
		}else{
			echo $this->session->set_flashdata('msg','<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('penjualan');
		}
	}

	function remove(){
		$row_id=$this->uri->segment(3);
		$this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
		redirect('penjualan');
	
    }

    function cetak_faktur(){
		//$x['data']=$this->penjualan->cetak_faktur();
		$this->load->view('laporan/v_faktur');
		//$this->session->unset_userdata('nofak');
	}


}