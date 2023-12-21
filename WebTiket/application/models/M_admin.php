<?php
class M_admin extends CI_model{
	public function __construct() {
		parent::__construct();
		$this->load->database();
}


	function get_admin($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('admin');
	
		if ($query->num_rows() == 1) {
				return $query->row();
		} else {
				return false;
		}
	}

	function login_admin($kode,$password){
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('nama',$kode);
		$this->db->where('password',$password);
		if($query=$this->db->get())
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	public function data_pesanan() {
		$this->db->select('*');
		$this->db->from('pemesanan');
		$query = $this->db->get();
		return $query->result();
	}
	public function data_stadium() {
		$this->db->select('*');
		$this->db->from('stadium');
		$query = $this->db->get();
		return $query->result();
	}
	public function data_level() {
		$this->db->select('*');
		$this->db->from('level');
		$query = $this->db->get();
		return $query->result();
	}
	public function data_tiket() {
		$this->db->select('tiket.id_tiket AS id_tiket, tiket.nama AS nama_tiket, tiket.tanggal AS tanggal, tiket.kode_tiket AS kode, tiket.stock AS stock, stadium.nama_stadium AS nama_stadium, level.nama_level AS nama_level');
		$this->db->from('tiket');
		$this->db->join('stadium', 'stadium.id_stadium = tiket.stadium', 'left');
		$this->db->join('level', 'level.id_level = tiket.id_level', 'left');
		$query = $this->db->get();
		$result = $query->result();
		
		return $result; // Add this line to return the result
	}
	public function hapus_data_pesanan($id)
	{
	$this->db->delete('pemesanan',array('id_order' => $id));
	}
	public function hapus_data_tiket($id)
	{
	$this->db->delete('tiket',array('id_tiket' => $id));
	}
	public function hapus_data_contact($id)
	{
	$this->db->delete('contact',array('id_contact' => $id));
	}
	public function data_contact() {
		$this->db->select('*');
		$this->db->from('contact');
		$query = $this->db->get();
		return $query->result();
	}

}
?>
