<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pemesanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pemesanan');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('string');
    }	

	public function index()
		{

		$this->load->view('index.php');

		}

		public function login(){
			$this->load->view('auth/login.php');
			}

			public function dashboard(){
				$nama = $this->session->userdata('nama');
				$admin = $this->session->userdata('is_admin');
				if($admin == FALSE){
				if (!empty($nama)) {
					// 'nama' exists in the session data
					$this->load->view('main/dashboard.php');
				} else {
					// 'nama' does not exist in the session
					echo '<script>alert("Harap login dahulu");</script>';
					redirect('index.php/auth/login');
				}}else{
					redirect('index.php/admin/');
				}

			}
			public function pesan() {
				
				$nama = $this->session->userdata('nama');
				$admin = $this->session->userdata('is_admin');
				if($admin == FALSE){

				if (!empty($nama)) {
					// 'nama' exists in the session data
			
					// Retrieve the 'code' from the URL
					$code = $this->input->get('code');
			
					if (!empty($code)) {
						// If 'code' is present, proceed with data retrieval
						$data['data_tiket_pesan'] = $this->m_pemesanan->data_tiket_pesan($code);
						$this->load->view('main/pesan.php', $data);
					} else {
						// If 'code' is missing, redirect with alert
						echo '<script>alert("Harap pilih tiket terlebih dahulu");</script>';
						redirect('index.php/pemesanan/tiket');
					}
				} else {
					// 'nama' does not exist in the session
					echo '<script>alert("Harap login dahulu");</script>';
					redirect('index.php/auth/login');
				}}else{
					redirect('index.php/admin/');
				}
			}
			

		public function tiket(){
			$nama = $this->session->userdata('nama');
			$admin = $this->session->userdata('is_admin');
			if($admin == FALSE){
			if (!empty($nama)) {
				// 'nama' exists in the session data
				$data['data_tiket'] = $this->m_pemesanan->data_tiket();
				$this->load->view('main/tiket.php', $data); 
			} else {
				// 'nama' does not exist in the session
				echo '<script>alert("Harap login dahulu");</script>';
				redirect('index.php/auth/login');
			}}else{
				redirect('index.php/admin/');
			}
		}
		public function listPesanan(){
			$nama = $this->session->userdata('nama');
			$admin = $this->session->userdata('is_admin');
			if($admin == FALSE){
			if (!empty($nama)) {
				$data['data_pesanan'] = $this->m_pemesanan->data_pesanan($nama);
				$this->load->view('main/list_pesanan.php', $data);
			} else {
				// 'nama' does not exist in the session
				echo '<script>alert("Harap login dahulu");</script>';
				redirect('index.php/auth/login');
			}}else{
				redirect('index.php/admin/');
			}
		}
		public function about() {
			$data['judul'] = "About Us";
			$this->load->view('v_about', $data);
			}

		public function faq() {
			$data['judul'] = "Frequently Asked Question";
			$this->load->view('v_faq', $data);
			}
		public function contact() {
			$data['judul'] = "Contact Us";

			$this->load->view('v_contact', $data);
			}
		function sendFeedback() //fungsi input data, nanti ditaruh di Action form
		{
			$data = array(
				'id_contact'=>$this->input->post('id_contact'), //Menginput hasil dari form dengan mengambil data sesuai nama kolom di table
				'nama'=>$this->input->post('nama'),
				'email'=>$this->input->post('email'),
				'notelp' => $this->input->post('notelp'),
				'pesan' => $this->input->post('pesan'),
			);
			$this->db->insert('contact',$data); //Inputan masuk ke database (Mirip query)
				redirect('index.php/pemesanan/contact');
		}

			function pesanan()
			{
				$this->load->helper('date');
				$this->load->helper('string');
			
				$pembelian = $this->input->post('jumlah_tiket');
				$kodetiket = $this->input->post('kode_tiket');
				$stock_data_obj = $this->m_pemesanan->tiket_stock($kodetiket);
				$stock_data = $stock_data_obj->stock;
				$jumlah = $stock_data - $pembelian;
				$harga = $this->input->post('harga');

				$hargatotal = $harga * $pembelian;

				$random = random_string('alnum', 16);
				$date = date("Y-m-d");
			
				if ($pembelian > $stock_data) {
					echo '<script>alert("Maaf, stok tidak cukup untuk pembelian ini.");</script>';
					echo '<script>window.location.href="' . base_url('index.php/pemesanan/tiket') . '";</script>';
				} elseif ($stock_data > 0) {
					$data = array(
						'user' => $this->input->post('user'),
						'tiket' => $this->input->post('level_tiket'),
						'nama_tiket' => $this->input->post('nama_tiket'),
						'harga' => $hargatotal,
						'seat' => $this->input->post('nama_seat'),
						'jumlah' => $this->input->post('jumlah_tiket'),
						'kode_pembayaran' => $random,
						'tanggal_pembelian' => $date,
						'tanggal' => $this->input->post('tanggal'),
						'Jenis_pembayaran' => $this->input->post('vbtn-radio'),
						'kode_tiket' => $this->input->post('kode_tiket'),
						'stock_lama' => $this->input->post('stock')
					);
					$this->m_pemesanan->kurangi_stok_tiket($kodetiket, $jumlah);
					$this->db->insert('pemesanan', $data);
					redirect('index.php/pemesanan/listPesanan');
				} elseif ($stock_data = 0){
					echo '<script>alert("Stock sudah habis");</script>';
					echo '<script>window.location.href="' . base_url('index.php/pemesanan/tiket') . '";</script>';
				}
			}
			
			public function receipt(){
				$kode_pembayaran = $this->input->get('code');
				if (!$kode_pembayaran) {
					// Redirect or show an error, as per your application logic
					redirect('error_page');
					return;
				}
				$data['data_receipt'] = $this->m_pemesanan->data_receipt($kode_pembayaran);
				$this->load->view('main/receipt.php', $data); 
				}
}
