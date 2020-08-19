<?php

class Pembelian extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Pembelian_model','pembelian');
		$this->load->model('Barang_model','barang');
		$this->load->model('Supplier_model','supplier');
	}

	function bahan_json() {
		header('Content-type: application/json');
		echo $this->pembelian->bahan_json();
	}

	function index() {
		$data['title'] = 'Pembelian Barang';

		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['sup'] = $this->supplier->tampil_suplier();
		$data['kd_bahan'] = $this->pembelian->kode_bahan();
		$this->load->view('template/backend/header', $data);
		$this->load->view('template/backend/sidebar', $data);
		$this->load->view('backend/pembelian/add_pembelian');
		$this->load->view('template/backend/footer');
	}

	function get_bahan() {
		$kobar  = $this->input->post('kode_brg');

		$data['bahan'] = $this->barang->get_bahan($kobar);
		$this->load->view('backend/pembelian/detail_pembelian', $data);
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

		$query = $this->db->query("SELECT harga_jual,harga_beli FROM tb_ukuran WHERE kd_barang = '$kobar' AND ukuran = '$ukuran' AND warna = '$warna'")->row_array();
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
            'price'    => $this->input->post('harpok'),
            'harga'    => $this->input->post('harjul'),
            'qty'      => $this->input->post('jumlah')
            
		);
		$this->cart->insert($data);
		redirect('pembelian');			 
		
	}

	function remove(){
		$row_id=$this->uri->segment(3);
		$this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
		redirect('pembelian');
	
    }

    function save() {
    	
		$tgl = $this->session->userdata('tgl');
		$supplier = $this->session->userdata('supplier');
		$username = $this->session->userdata('username');
		if(!empty($tgl) && !empty($supplier)){
			$kode_beli = $this->pembelian->kode_bahan();
			$this->db->query("INSERT INTO tb_beli (invoice,tgl_beli,supplier,username) VALUES ('$kode_beli','$tgl','$supplier','$username')");
			foreach ($this->cart->contents() as $item) {
			$ukuran = $item['options']['ukuran'];   
			$warna = $item['options']['warna'];    
					$data = array(
						'invoice' 	=>	$kode_beli,
						'kd_barang'	=>	$item['id'],
						'nabar'	=>	$item['name'],
						'kategori'	=>	$item['satuan'],
						'harga'		=>	$item['price'],
						'jumlah'	=>	$item['qty'],
						'total'		=>	$item['subtotal'],
						'ukuran' => $item['options']['ukuran'],
						'warna' => $item['options']['warna']
					);
					
					$this->db->insert('tb_detail_beli',$data);
					$this->db->query("update tb_ukuran set qty=qty+'$item[qty]' where kd_barang = '$item[id]' and ukuran = '$ukuran' and warna = '$warna'");
	
			}
			$this->cart->destroy();
			$this->session->unset_userdata('tgl');
			$this->session->unset_userdata('supplier');
			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('pembelian');
		} else{
			//redirect('pembelian');
		}

		
    }
}