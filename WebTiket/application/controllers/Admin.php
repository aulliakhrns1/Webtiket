<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('string');
    }	
	public function index()
	{
		$admin = $this->session->userdata('is_admin');
		if($admin == FALSE){
			redirect('index.php/admin/login');
		}else{
	$this->load->view('admin/index.php');
		}
	}
	public function login(){
		$nama = $this->session->userdata('nama');

		if (!empty($nama)) {
			// 'nama' exists in the session data
			echo '<script>alert("Anda sudah login");</script>';
			echo '<script>window.location.href="'.base_url('index.php/admin').'";</script>';
		} else {
			// 'nama' does not exist in the session
			$this->load->view('auth/admin/login.php');
		}
	}
	public function checklogin()
		{
			$user_login = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'status' => $this->input->post('status'),
			);
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', array('required', 'min_length[8]'));
		
			if ($this->form_validation->run() != false) {
				$data = $this->m_admin->login_admin($user_login['username'], $user_login['password']);
		
				if ($data) {
					$newdata = array(
						'id'       => $data['id'],
						'namaAdm'     => $data['username'],
						'logged_in' => TRUE,
						'is_admin' => TRUE,
					);
		
					$this->session->set_userdata($newdata);
					redirect('index.php/admin', $data);
				} else {
					echo '<script>alert("Incorrect username or password.");</script>';
					echo '<script>window.location.href="'.base_url('index.php/admin/login').'";</script>';
				}
			} else {
				echo '<script>alert("Password harus lebih dari 8 digit");</script>';
				echo '<script>window.location.href="'.base_url('index.php/admin/login').'";</script>';
			}
		}
		public function PesananManage(){
			$admin = $this->session->userdata('is_admin');
			if($admin == TRUE){
				$data['data_pesanan'] = $this->m_admin->data_pesanan();
				$this->load->view('admin/manage_pesanan.php', $data);
			} else {
				// 'nama' does not exist in the session
				echo '<script>alert("Harap login admin dahulu");</script>';
				redirect('index.php/admin/login');
			}
		}

		function action()
		{
			$data = array(

				'id_order'=>$this->input->post('id_order'),
				'status'=>$this->input->post('status'),
			);
			$num = $this->input->post('id_order');
			$this->db->where('id_order', $num);
			$this->db->update('pemesanan',$data);
			redirect('index.php/admin/PesananManage');
		}
		public function actionbatal()
		{
			$data_pemesanan = array(
				'status' => $this->input->post('status'),
			);

			$num_pemesanan = $this->input->post('id_order');
			$this->db->where('id_order', $num_pemesanan);
			$this->db->update('pemesanan', $data_pemesanan);

			$data_tiket = array(
				'stock' => $this->input->post('stock'),
			);

			$num_tiket = $this->input->post('kode_tiket');
			$this->db->where('kode_tiket', $num_tiket);
			$this->db->update('tiket', $data_tiket);

			redirect('index.php/admin/PesananManage');
		}

		

		function hapus()
		{
			$id_order = $this->input->post('id_order');
			$this->m_admin->hapus_data_pesanan($id_order);
			redirect('index.php/admin/PesananManage');
		}

		public function tiketManage(){
			$admin = $this->session->userdata('is_admin');
			if($admin == TRUE){
				$data['data_tiket'] = $this->m_admin->data_tiket();
				$data['data_stadium'] = $this->m_admin->data_stadium();
				$data['data_level'] = $this->m_admin->data_level();
				$this->load->view('admin/manage_tiket.php', $data);
			} else {
				// 'nama' does not exist in the session
				echo '<script>alert("Harap login admin dahulu");</script>';
				redirect('index.php/admin/login');
			}
		}
		
		function stock()
		{
			$data = array(

				'id_tiket'=>$this->input->post('id_tiket'),
				'stock'=>$this->input->post('stock'),
			);
			$num = $this->input->post('id_tiket');
			$this->db->where('id_tiket', $num);
			$this->db->update('tiket',$data);
			redirect('index.php/admin/tiketManage');
		}

		function hapustiket()
		{
			$id_tiket = $this->input->post('id_tiket');
			$this->m_admin->hapus_data_tiket($id_tiket);
			redirect('index.php/admin/tiketManage');
		}

		function hapuscontact()
		{
			$id_contact = $this->input->post('id_contact');
			$this->m_admin->hapus_data_contact($id_contact);
			redirect('index.php/admin/contactManage');
		}
		function TambahTiket() 
		{
			$random = random_string('alnum', 10);
			$data = array(
				'id_tiket'=>$this->input->post('id_tiket'), //Menginput hasil dari form dengan mengambil data sesuai nama kolom di table
				'id_level'=>$this->input->post('id_level'),
				'nama'=>$this->input->post('nama'),
				'stadium' => $this->input->post('stadium'),
				'tanggal'=>$this->input->post('tanggal'),
				'kode_tiket' => $random,
				'stock' => $this->input->post('stock'),
			);
			$this->db->insert('tiket',$data); //Inputan masuk ke database (Mirip query)
				redirect('index.php/admin/tiketManage');
		}
		public function contactManage(){
			$admin = $this->session->userdata('is_admin');
			if($admin == TRUE){
				$data['data_contact'] = $this->m_admin->data_contact();
				$this->load->view('admin/list_feedback.php', $data);
			} else {
				// 'nama' does not exist in the session
				echo '<script>alert("Harap login admin dahulu");</script>';
				redirect('index.php/admin/login');
			}
		}
}
