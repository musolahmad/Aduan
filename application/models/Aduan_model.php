<?php
/**
* 
*/
class Aduan_model extends CI_Model
{	
	function jml()
	{	
		return $this->db->get('tb_aduan')->num_rows();
	}
	function get_all_web()
	{	
		return $this->db->get('tb_website')->result_array();
	}
	function get_all($limit,$start)
	{	
		$this->db->order_by('tgl_aduan', 'DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_aduan.kd_dusun');		
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		return $this->db->get('tb_aduan',$limit,$start)->result_array();
	}
	function jmlanda($kd_user)
	{	
		$this->db->where(['tb_aduan.kd_user'=>$kd_user]);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function get_all_anda($limit,$start,$kd_user)
	{	
		$this->db->order_by('tgl_aduan', 'DESC');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_aduan.kd_dusun');		
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		$this->db->where(['tb_aduan.kd_user'=>$kd_user]);
		return $this->db->get('tb_aduan',$limit,$start)->result_array();
	}
	function nomor($tgl)
	{	
		$this->db->order_by('kd_aduan', 'DESC');
		$this->db->limit(1);		
		return $this->db->where(['date_format(tgl_aduan,"%Y-%m")'=>$tgl])->get('tb_aduan')->result_array();
	}
	
	function simpan($data)
	{
		# code...
		$this->db->insert('tb_aduan',$data);
	}
	function hapus($kd_aduan)
	{
		# code...
		$this->db->delete('tb_aduan',['kd_aduan'=>$kd_aduan]);
	}
	function cari($kd_aduan)
	{	
		$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_aduan.kd_dusun');		
		$this->db->join('tb_topik_aduan','tb_topik_aduan.kd_topik=tb_aduan.kd_topik');
		$this->db->join('tb_user','tb_user.kd_user=tb_aduan.kd_user');
		return $this->db->where(['kd_aduan'=>$kd_aduan])->get('tb_aduan')->result_array();
	}
	function login($kd_aduan,$pass)
	{	
		return $this->db->where(['kd_aduan'=>$kd_aduan,'pass'=>$pass])->get('tb_aduan')->result_array();
	}
	function ubah($kd_aduan,$data)
	{	
		return $this->db->where(['kd_aduan'=>$kd_aduan])->update('tb_aduan',$data);
	}
	function jmlditerima($kd_user)
	{	
		$where = "status_aduan ='Diterima' AND kd_user='".$kd_user."' ";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmldiajukan($kd_user)
	{	
		$where = "status_aduan ='Diajukan' AND kd_user='".$kd_user."' ";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmlditolak($kd_user)
	{	
		$where = "kd_user='".$kd_user."' AND status_aduan ='Ditolak'";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmlmasuk($kd_user)
	{	
		$where = "kd_user='".$kd_user."' AND status_aduan ='Masuk'";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function jmltotal($kd_user)
	{	
		$where = "kd_user='".$kd_user."'";
		$this->db->where($where);
		return $this->db->get('tb_aduan')->num_rows();
	}
	function notifikasi($kd_user)
	{
		# code...
		$this->db->select('count(*) as jml');
		$where = "kd_user='".$kd_user."' AND tb_komentar.dibaca ='T'";
		$this->db->where($where);
		$this->db->join('tb_aduan','tb_aduan.kd_aduan=tb_komentar.kd_aduan');
		return $this->db->get('tb_komentar')->result_array();
	}
	function lihat($kd_user)
	{
		# code...
		$where = "kd_user='".$kd_user."' AND tb_komentar.dibaca ='T'";
		$this->db->where($where);
		$this->db->join('tb_aduan','tb_aduan.kd_aduan=tb_komentar.kd_aduan');
		$this->db->join('tb_admin','tb_komentar.kd_admin=tb_admin.kd_admin');
		return $this->db->get('tb_komentar')->result_array();
	}
	function topik()
	{	
		return $this->db->get('tb_topik_aduan')->result_array();
	}
	function dusun()
	{	
		return $this->db->get('tb_dusun')->result_array();
	}
	function rt()
	{	
		$this->db->order_by('jml_rt', 'DESC');
		$this->db->limit(1);
		return $this->db->get('tb_dusun')->result_array();
	}
	function caridusun($kd_dusun)
	{	
		return $this->db->where(['kd_dusun'=>$kd_dusun])->get('tb_dusun')->result_array();
	}
}