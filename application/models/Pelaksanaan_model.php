<?php
/**
* 
*/
class Pelaksanaan_model extends CI_Model
{	
	function get_all($tahun,$status)
	{
		if ($status=="0") {
			$this->db->order_by('tgl_mulai', 'DESC');
			$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
			$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
			$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
			$this->db->join('tb_pelaksanaan_pembangunan', 'tb_rencana_pembangunan.kd_rencana = tb_pelaksanaan_pembangunan.kd_rencana', 'inner');
			return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'tb_pelaksanaan_pembangunan.status_pengajuan'=>'2'])->get('tb_rencana_pembangunan')->result_array();
		}else{	
			$this->db->order_by('tgl_mulai', 'DESC');
			$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
			$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
			$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
			$this->db->join('tb_pelaksanaan_pembangunan', 'tb_rencana_pembangunan.kd_rencana = tb_pelaksanaan_pembangunan.kd_rencana', 'inner');
			return $this->db->where(['tb_rencana_pembangunan.tahun'=>$tahun,'tb_pelaksanaan_pembangunan.status_pengajuan'=>'2','tb_pelaksanaan_pembangunan.status_pelaksanaan'=>$status])->get('tb_rencana_pembangunan')->result_array();
		}
	}
	function get_all_bulan($tahun,$bulan,$status)
	{
		if ($status=="0") {
			$where="tb_rencana_pembangunan.tahun='".$tahun."' AND tb_pelaksanaan_pembangunan.status_pengajuan='2' AND MONTH(tgl_mulai)='".$bulan."' OR MONTH(tgl_akhir)='".$bulan."'";
			$this->db->order_by('tgl_mulai', 'DESC');
			$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
			$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
			$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
			$this->db->join('tb_pelaksanaan_pembangunan', 'tb_rencana_pembangunan.kd_rencana = tb_pelaksanaan_pembangunan.kd_rencana', 'inner');
			return $this->db->where($where)->get('tb_rencana_pembangunan')->result_array();
		}else{
			$where="tb_rencana_pembangunan.tahun='".$tahun."' AND tb_pelaksanaan_pembangunan.status_pengajuan='2' AND tb_pelaksanaan_pembangunan.status_pelaksanaan='".$status."' AND MONTH(tgl_mulai)='".$bulan."' OR MONTH(tgl_akhir)='".$bulan."'";
			$this->db->order_by('tgl_mulai', 'DESC');
			$this->db->join('tb_kegiatan', 'tb_rencana_pembangunan.kd_kegiatan = tb_kegiatan.kd_kegiatan', 'inner');
			$this->db->join('tb_bidang', 'tb_rencana_pembangunan.kd_bidang = tb_bidang.kd_bidang', 'inner');
			$this->db->join('tb_dusun','tb_dusun.kd_dusun=tb_rencana_pembangunan.kd_dusun');
			$this->db->join('tb_pelaksanaan_pembangunan', 'tb_rencana_pembangunan.kd_rencana = tb_pelaksanaan_pembangunan.kd_rencana', 'inner');
			return $this->db->where($where)->get('tb_rencana_pembangunan')->result_array();
		}
		
	}
}