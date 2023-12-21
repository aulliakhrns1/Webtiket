<?php
class M_auth extends CI_model{
	public function __construct() {
		parent::__construct();
		$this->load->database();
}
public function data_auth(){
$query = $this->db->get('user');
return $query->result();
}

function Getid($id = '')
{
  return $this->db->get_where('user', array('id' => $id))->row();
}
function hapususer($id)
{
	$this->db->delete('user',array('id_user' => $id));
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

function login_user($kode,$password){
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('username',$kode);
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
}
?>
