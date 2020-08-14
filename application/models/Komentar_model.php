<?php
/**
* 
*/
class Komentar_model extends CI_Model
{	
	function get_all($kd_aduan)
	{	
		$this->db->order_by('kd_komentar', 'DESC');
		return $this->db->where(['kd_aduan'=>$kd_aduan])->get('tb_komentar')->result_array();
	}
	function getkomen($kd_aduan)
	{	
		$this->db->order_by('kd_komentar', 'DESC');
		$where="kd_aduan='".$kd_aduan."' AND isi_komentar != 'Aduan Sudah Diajukan Untuk Rencana Pembangunan Oleh Admin'";
		$this->db->where($where);
		return $this->db->get('tb_komentar')->result_array();
	}
	function referensi($kd_aduan)
	{	
		$where="kd_aduan='".$kd_aduan."' AND isi_komentar = 'Aduan Sudah Diajukan Untuk Rencana Pembangunan Oleh Admin'";
		$this->db->where($where);
		return $this->db->get('tb_komentar')->result_array();
	}
	function admin($kd_admin)
	{	
		return $this->db->where(['kd_admin'=>$kd_admin])->get('tb_admin')->result_array();
	}
	function user($kd_user)
	{	
		return $this->db->where(['kd_user'=>$kd_user])->get('tb_user')->result_array();
	}
	function nomor()
	{	
		$this->db->order_by('kd_komentar', 'DESC');
		$this->db->limit(1);		
		return $this->db->get('tb_komentar')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_komentar',$data);
	}
	function hapus($kd_komentar)
	{
		# code...
		$this->db->delete('tb_komentar',['kd_komentar'=>$kd_komentar]);
	}
	function cari($kd_komentar)
	{	
		return $this->db->where(['kd_komentar'=>$kd_komentar])->get('tb_komentar')->result_array();
	}
	function cek($kd_aduan,$isi_komentar)
	{	
		return $this->db->where(['kd_aduan'=>$kd_aduan,'isi_komentar'=>$isi_komentar])->get('tb_komentar')->result_array();
	}
	function ubah($kd_komentar,$data)
	{	
		return $this->db->where(['kd_komentar'=>$kd_komentar])->update('tb_komentar',$data);
	}
}