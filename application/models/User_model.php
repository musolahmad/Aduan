<?php
/**
* 
*/
class User_model extends CI_Model
{	
	function get_all()
	{	
		return $this->db->get('tb_user')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_user', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_user')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_user',$data);
	}
	function hapus($kd_user)
	{
		# code...
		$this->db->delete('tb_user',['kd_user'=>$kd_user]);
	}
	function cari($kd_user)
	{	
		return $this->db->where(['kd_user'=>$kd_user])->get('tb_user')->result_array();
	}
	function cekemail($email)
	{	
		return $this->db->where(['email'=>$email])->get('tb_user')->result_array();
	}
	function cektanggal($tgl)
	{	
		return $this->db->where(['tgl_buat'=>$tgl])->get('tb_user')->result_array();
	}
	function verifikasi($kd_user,$email)
	{	
		return $this->db->where(['kd_user'=>$kd_user,'email'=>$email])->get('tb_user')->result_array();
	}
	function login($kd_user,$pass)
	{	
		return $this->db->where(['kd_user'=>$kd_user,'pass'=>$pass])->get('tb_user')->result_array();
	}
	function ubah($kd_user,$data)
	{	
		return $this->db->where(['kd_user'=>$kd_user])->update('tb_user',$data);
	}
}