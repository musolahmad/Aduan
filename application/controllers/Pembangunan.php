<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembangunan_model');
        $this->load->model('BobotKriteria_model');  
         $this->load->model('KriteriaKegiatan_model');      
          $this->load->model('Promethee_model');            
        $this->load->model('Aduan_model');
        $this->load->model('Komentar_model');
        $this->load->model('Pelaksanaan_model');
        $this->load->library('pagination');
        
    }
	public function index()
	{
		redirect('Pembangunan/Rencana/'.$this->input->post('tahun').'/'.$this->input->post('kd_bidang'));
	}
	public function cek()
	{
		redirect('Pembangunan/Prioritas/'.$this->input->post('tahun').'/'.$this->input->post('kd_bidang'));
	}
	public function cek1()
	{
		redirect('Pembangunan/PaguAnggaran/'.$this->input->post('tahun'));
	}
	public function rencana($tahun,$kd_bidang)
	{
		if ($kd_bidang=='1') {
			$data1=$this->Pembangunan_model->get_all1();
			foreach ($data1 as $d) {
				# code...
				$kd_bidang=$d['kd_bidang'];
			}
		}
		$data_session = array('user_menu' => 'Rencana Pembangunan');
		$this->session->set_userdata($data_session);

		$jml=$this->Pembangunan_model->jml($kd_bidang,$tahun);

		$config['base_url'] = base_url('index.php').'/Pembangunan/Rencana/'.$tahun.'/'.$kd_bidang;
		$config['total_rows']=$jml;
		$config['per_page'] = 12;
		$start = $this->uri->segment(5);

		// Style Pagination
		// Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
		$config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        
        $config['first_link']      = 'First'; 
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link']       = 'Last'; 
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        
        $config['next_link']       = '&raquo'; 
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        
        $config['prev_link']       = '&laquo'; 
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
         
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

		$this->pagination->initialize($config); // Set konfigurasi paginationnya

		$data=$this->Pembangunan_model->get_all();
		$detail=$this->Pembangunan_model->detail($kd_bidang,$tahun,$config['per_page'],$start);
		$get_all_bidang=$this->Pembangunan_model->get_all_bidang($kd_bidang);
		foreach ($get_all_bidang as $g) {
			# code...
			$nm_bidang=$g['nm_bidang'];
		}
		$data2= array(
			'tahun'=>$tahun,'data'=>$data,'detail'=>$detail,'kd_bidang'=>$kd_bidang,'nm_bidang'=>$nm_bidang,'web' => $this->Aduan_model->get_all_web()
		);
		$this->load->view('pembangunan',$data2);
	}
	public function prioritas($tahun,$kd_bidang)
	{
		if ($kd_bidang=='1') {
			$data1=$this->Pembangunan_model->get_all1();
			foreach ($data1 as $d) {
				# code...
				$kd_bidang=$d['kd_bidang'];
			}
		}
		$data=$this->Pembangunan_model->get_all();
		$data_session = array('user_menu' => 'Prioritas Pembangunan');
		$this->session->set_userdata($data_session);
		$detail=$this->Pembangunan_model->detail1($kd_bidang,$tahun);
		$get_all_bidang=$this->Pembangunan_model->get_all_bidang($kd_bidang);
		foreach ($get_all_bidang as $g) {
			# code...
			$nm_bidang=$g['nm_bidang'];
		}
		$data2=['tahun'=>$tahun,'data'=>$data,'kd_bidang'=>$kd_bidang,'detail'=>$detail,'nm_bidang'=>$nm_bidang,'web' => $this->Aduan_model->get_all_web()];
		$this->load->view('prioritas',$data2);
	}
	public function referensi($kd_rencana)
	{
		# code...
		$data_session = array('user_menu' => 'Referensi Aduan Masyarakat');
		$this->session->set_userdata($data_session);
		$detail=$this->Pembangunan_model->lihat1($kd_rencana);
		$this->load->view('referensi',['detail'=>$detail,'web' => $this->Aduan_model->get_all_web()]);
	}
	public function lihat($kd_aduan)
	{
		# code...
		$cari=$this->Pembangunan_model->cari($kd_aduan);
		foreach ($cari as $c) {
			# code...
			$kd_rencana=$c['kd_rencana'];
		}
		redirect('Pembangunan/Referensi/'.$kd_rencana);
	}
	public function Pelaksanaan($tahun,$bulan,$status)
	{
		#
		if ($bulan=='00') {
			# code...
			$pelaksanaan=$this->Pelaksanaan_model->get_all($tahun,$status);
		}else{
			$pelaksanaan=$this->Pelaksanaan_model->get_all_bulan($tahun,$bulan,$status);
		}
		$data_session = array('user_menu' => 'Pelaksanaan Pembangunan');
		$this->session->set_userdata($data_session);
		$data=[
			'tahun'=>$tahun,
			'bulan'=>$bulan,
			'pelaksanaan'=>$pelaksanaan,
			'status'=>$status,
			'web' => $this->Aduan_model->get_all_web()
		];
		$this->load->view('pelaksanaan',$data);
	}
	public function cekkegiatan()
	{
		redirect('Pembangunan/Pelaksanaan/'.$this->input->post('tahun').'/'.$this->input->post('bulan').'/'.$this->input->post('status_pelaksanaan'));
	}
	public function PaguAnggaran($tahun)
	{

		$data_session = array('user_menu' => 'Pagu Anggaran');
		$this->session->set_userdata($data_session);
		$pagu=$this->Pembangunan_model->pagu($tahun);
		$data2=['tahun'=>$tahun,'pagu'=>$pagu];
		$this->load->view('pagu',$data2);
	}
}
