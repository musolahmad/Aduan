<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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
        $this->load->model('User_model');        
        $this->load->model('Aduan_model');
    }
	public function index()
	{
		$data_session = array('user_menu' => 'Profil');
		$this->session->set_userdata($data_session);
		$profil=$this->User_model->cari($this->session->userdata('kd_user'));
		$data=array('profil' =>$profil );
		$this->load->view('profil',$data);
	}
	public function menu(){
		$data_session = array('profil'=>'pass');
		$this->session->set_userdata($data_session);
		redirect('Profil');
	}
	public function ubahpass()
	{
		# code...
		if ($this->session->userdata('password')!=$this->input->post('password_lama')) {
			# code...
			$this->session->set_flashdata('error', 'Password Lama Salah');
            echo '<script>window.history.back();</script>';
		}elseif ($this->input->post('password_baru')!=$this->input->post('password_confirm')){
			$this->session->set_flashdata('error', 'Konfirmasi Password Baru Salah');
            echo '<script>window.history.back();</script>';
		}else{
			$data=array('password' => $this->input->post('password_baru'));
			$this->User_model->ubah($this->session->userdata('kd_user'),$data);
			if ($this->db->affected_rows() > 0) {
				$data_session = array('password'=>$this->input->post('password_baru'),'profil'=>'pass');
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('flash','Diubah');
				redirect('Profil');
			}else{
				$this->session->set_flashdata('error','Data Gagal Diubah');	
				$data_session = array('profil'=>'pass');
				$this->session->set_userdata($data_session);		
				echo '<script>window.history.back();</script>';
			}
		}
	}
	public function ubahprofil()
	{
		if ($this->input->post('email')==$this->input->post('email1')) {
			# code...
			$data=array(
						'email'=>$this->input->post('email'),
						'nm_user'=>$this->input->post('nm_user')
					);
					$this->User_model->ubah($this->session->userdata('kd_user'),$data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('flash','Diubah');			
					    $data_session = array('profil'=>'profil','nm_user'=>$this->input->post('nm_user'));
						$this->session->set_userdata($data_session);
						redirect('Profil');
					}else{
						$this->session->set_flashdata('error','Data Gagal Diubah');
						echo '<script>window.history.back();</script>';
					}
		}else{
			$cekemail = $this->User_model->cekemail($this->input->post('email'));
        	if (empty($cekemail)) {
        		# code...
        		$cekemailuser= $this->User_model->cekemailuser($this->input->post('email'));
        		if (empty($cekemailuser)) {
        			# code...
        			$data=array(
						'email'=>$this->input->post('email'),
						'nm_pegawai'=>$this->input->post('nm_pegawai')
					);
					$this->User_model->ubah($this->session->userdata('kode_admin'),$data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('flash','Diubah');			
					    $data_session = array('profil'=>'profil');
						$this->session->set_userdata($data_session);
						redirect('Profil');
					}else{
						$this->session->set_flashdata('error','Data Gagal Diubah');
						echo '<script>window.history.back();</script>';
					}
        		}else{
        			$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            		echo '<script>window.history.back();</script>';
        		}
        	}else{
        		$this->session->set_flashdata('error', 'Email sudah terdaftar!');
            	echo '<script>window.history.back();</script>';
        	}		
		}
	}
	public function ubahfoto()
	{
		$nmfile=date('ymdhis');
		$config['upload_path']          = './asset/foto_profil/';
		$config['allowed_types']        = 'jpeg|gif|jpg|png';
		$config['max_size'] = '3072'; //maksimum besar file 3M
		$config['file_name'] = $nmfile;
		$this->load->library('upload', $config);
		    if ( ! $this->upload->do_upload('foto_profil')){
		            $this->session->set_flashdata('error', 'Foto tidak sesuai format');
		            echo '<script>window.history.back();</script>';
		    }else{
		        	if (is_file('./asset/foto_profil/'.$this->input->post('foto'))) {
					    unlink('./asset/foto_profil/'.$this->input->post('foto'));
					}
		            $gbr = $this->upload->data();
		            $foto_profil = $gbr['file_name'];
					$data=array(
						'foto_profil'=>$foto_profil
					);
					$this->User_model->ubah($this->input->post('kd_user'),$data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('flash','Diubah');
						$data_session = array('profil'=>'foto','foto_profil'=>$foto_profil);
						$this->session->set_userdata($data_session);
						redirect('Profil');
					}else{
						$this->session->set_flashdata('error','Data Gagal Diubah');
						echo '<script>window.history.back();</script>';
					}
				}
	}
}
