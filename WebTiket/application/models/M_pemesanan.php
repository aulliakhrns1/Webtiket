<?php
class M_pemesanan extends CI_model{
	public function __construct() {
		parent::__construct();
		$this->load->database();
}

public function data_tiket(){
	// $query = $this->db->get('tiket');
	$this->db->select('stadium.id_stadium, stadium.nama_stadium AS nama_stadium, tiket.nama AS nama_tiket, tiket.tanggal, level.nama_level AS nama_level, level.harga, seat.seat AS nama_seat, tiket.kode_tiket AS kode, tiket.stock AS stock');
	$this->db->from('stadium');
	$this->db->join('tiket', 'stadium.id_stadium = tiket.stadium');
	$this->db->join('level', 'tiket.id_level = level.id_level');
	$this->db->join('seat', 'level.seat = seat.id_seat');
	$query = $this->db->get();
	return $query->result();
	}
	public function data_pesanan($nama) {
		$this->db->select('*');
		$this->db->from('pemesanan');
		$this->db->where('user', $nama); 
		$query = $this->db->get();
		return $query->result();
	}
	public function data_tiket_pesan($code) {
		$this->db->select('stadium.id_stadium, stadium.nama_stadium AS nama_stadium, tiket.nama AS nama_tiket, tiket.tanggal, level.nama_level AS nama_level, level.harga AS harga, seat.seat AS nama_seat, tiket.kode_tiket AS kode, tiket.stock AS stock');
		$this->db->from('stadium');
		$this->db->join('tiket', 'stadium.id_stadium = tiket.stadium');
		$this->db->join('level', 'tiket.id_level = level.id_level');
		$this->db->join('seat', 'level.seat = seat.id_seat');
		$this->db->where('tiket.kode_tiket', $code);
		// $this->db->limit(1); // Add the limit here
	
		$query = $this->db->get();
		return $query->result();
	}
	
public function tiket_stock($kodetiket){
		$this->db->select('stock');
		$this->db->where('kode_tiket', $kodetiket);
		$query = $this->db->get('tiket');
	
		if ($query->num_rows() == 1) {
				return $query->row();
		} else {
				return false;
		}
}
// In m_pemesanan model
public function kurangi_stok_tiket($kodetiket, $jumlah)
{
    $this->db->where('kode_tiket', $kodetiket);
    $this->db->set('stock', $jumlah);
    $this->db->update('tiket');
}

public function data_receipt($kode_pembayaran){
	$this->db->select('*');
	$this->db->from('pemesanan');
	$this->db->where('kode_pembayaran', $kode_pembayaran);
	$this->db->order_by('id_order', 'desc');
	$this->db->limit(1);
	$query = $this->db->get();
return $query->result();
}

	function get_user($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('user');
	
		if ($query->num_rows() == 1) {
				return $query->row();
		} else {
				return false;
		}
	}


}
?>
