<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
		$this->load->library('form_validation');
		$this->load->library('session');
    }

		public function index()
		{
			$admin = $this->session->userdata('is_admin');
			if($admin == FALSE){
			if ($this->session->has_userdata('username')) {
				redirect('index.php/Pemesanan/dashboard');
			}else{
		$this->load->view('home/index.php');
			}}else{
				redirect('index.php/admin/');
			}
		}
		public function login(){
			$nama = $this->session->userdata('nama');
			$admin = $this->session->userdata('is_admin');
			if($admin == FALSE){
			if (!empty($nama)) {
				// 'nama' exists in the session data
				echo '<script>alert("Anda sudah login");</script>';
				echo '<script>window.location.href="'.base_url('index.php/Pemesanan/dashboard').'";</script>';
			} else {
				// 'nama' does not exist in the session
				$this->load->view('auth/login.php');
			}}else{
				redirect('index.php/admin/');
			}
		}

		public function register(){
			$nama = $this->session->userdata('nama');
			$admin = $this->session->userdata('is_admin');
			if($admin == FALSE){
			if (!empty($nama)) {
				// 'nama' exists in the session data
				echo '<script>alert("Anda sudah login");</script>';
				echo '<script>window.location.href="'.base_url('index.php/Pemesanan/dashboard').'";</script>';
			} else {
				// 'nama' does not exist in the session
				$this->load->view('auth/register.php');
			}}else{
				redirect('index.php/admin/');
			}
		}

		function register_user() //fungsi input data, nanti ditaruh di Action form
		{
			$data = array(
				'id_user'=>$this->input->post('id_user'), //Menginput hasil dari form dengan mengambil data sesuai nama kolom di table
				'email'=>$this->input->post('email'),
				'username'=>$this->input->post('username'),
				'password' => $this->input->post('password'),
			);
			$this->db->insert('user',$data); //Inputan masuk ke database (Mirip query)
				redirect('index.php/auth/login');
		}
		
		public function checklogin()
		{
			$user_login = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
			);
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', array('required', 'min_length[8]'));
		
			if ($this->form_validation->run() != false) {
				$data = $this->m_auth->login_user($user_login['username'], $user_login['password']);
		
				if ($data) {
					$newdata = array(
						'id'       => $data['id'],
						'nama'     => $data['username'],
						'logged_in' => TRUE
					);
		
					$this->session->set_userdata($newdata);
					redirect('index.php/Pemesanan/dashboard', $data);
				} else {
					echo '<script>alert("Incorrect username or password.");</script>';
					echo '<script>window.location.href="'.base_url('index.php/auth/login').'";</script>';
				}
			} else {
				echo '<script>alert("Password harus lebih dari 8 digit");</script>';
				echo '<script>window.location.href="'.base_url('index.php/auth/login').'";</script>';
			}
		}
	public function logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('nama');
		$newdata = array(
			'logged_in' => FALSE,
			'is_admin' => FALSE
		);
		$this->session->set_userdata($newdata);
		redirect('index.php/pemesanan/');
	}
}
