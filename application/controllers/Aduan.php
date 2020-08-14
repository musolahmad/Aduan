<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduan extends CI_Controller {

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
        $this->load->model('Komentar_model');
        $this->load->library('pagination');
    }
	public function index()
	{
		$data_session = array('user_menu' => 'Aduan Masyarakat');
		$this->session->set_userdata($data_session);
		//pagintioan 
		$jml=$this->Aduan_model->jml();
		$config['base_url'] = base_url().'/Aduan/Index';
		$config['total_rows']=$jml;
		$config['per_page'] = 12;
		$start = $this->uri->segment(3);

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
		$data=$this->Aduan_model->get_all($config['per_page'],$start);
		$this->load->view('aduan',['data'=>$data]);
	}
	public function detail($kd_aduan)
	{
		$data_session = array('user_menu' => 'Aduan Masyarakat');
		$this->session->set_userdata($data_session);
		$data=$this->Aduan_model->cari($kd_aduan);
		$this->load->view('aduan_detail',['data'=>$data,'web' => $this->Aduan_model->get_all_web()]);
	}
	public function anda()
	{
		if ($this->session->userdata('user_login')!="Masuk") {
        	# code...
        	redirect('Aduan');
        }else{
        	$data_session = array('user_menu' => 'Aduan Anda');
			$this->session->set_userdata($data_session);
			$jml=$this->Aduan_model->jmlanda($this->session->userdata('kd_user'));
			$config['base_url'] = base_url().'/Aduan/Anda';
			$config['total_rows']=$jml;
			$config['per_page'] = 12;
			$start = $this->uri->segment(3);

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
			$data=$this->Aduan_model->get_all_anda($config['per_page'],$start,$this->session->userdata('kd_user'));
			$this->load->view('aduan_anda',['data'=>$data]);
        }
		
	}
	public function profil($kd_user)
	{
			$jmltotal=$this->Aduan_model->jmltotal($kd_user);
        	$jmlditerima=$this->Aduan_model->jmlditerima($kd_user)+$this->Aduan_model->jmldiajukan($kd_user);
        	$jmlditolak=$this->Aduan_model->jmlditolak($kd_user);
        	$jmlmasuk=$this->Aduan_model->jmlmasuk($kd_user);
        	$user=$this->User_model->cari($kd_user);
        	$data_session = array('user_menu' => 'Profil');

        	$jml=$this->Aduan_model->jmlanda($kd_user);
			$config['base_url'] = base_url().'/Aduan/Profil';
			$config['total_rows']=$jml;
			$config['per_page'] = 12;
			$start = $this->uri->segment(4);

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
			$data=$this->Aduan_model->get_all_anda($config['per_page'],$start,$kd_user);

			$this->session->set_userdata($data_session);
			$this->load->view('aduan_profil',['jmltotal'=>$jmltotal,'jmlditerima'=>$jmlditerima,'jmlditolak'=>$jmlditolak,'jmlmasuk'=>$jmlmasuk,'user'=>$user,'data'=>$data]);
		
	}
	public function formulir()
	{
		if ($this->session->userdata('user_login')!="Masuk") {
        	# code...
        	redirect('Aduan');
        }else{
        	$topik=$this->Aduan_model->topik();
        	$dusun=$this->Aduan_model->dusun();
        	$jml_rt=$this->Aduan_model->rt();
        	$data = array('topik' => $topik,'dusun'=>$dusun,'jml_rt'=>$jml_rt);
        	$this->load->view('form_aduan',$data);
        }
	}
	public function batal()
	{
		# code...
		if ($this->session->userdata('user_login')!="Masuk") {
        	# code...
        	redirect('Aduan');
        }else{
        	if ($this->session->userdata('user_menu')=="Aduan Masyarakat") {
			# code...
			redirect('Aduan');

			}else{
				redirect('Aduan/Anda');
			}
        }
		
	}
	public function logout()
	{
		# code...
		$this->session->sess_destroy();
		redirect(base_url());
	}
	public function kirimaduan()
	{
		
			$cekrt=$this->Aduan_model->caridusun($this->input->post('kd_dusun'));
			foreach ($cekrt as $c) {
				# code...
				$rt=$c['jml_rt'];
			}
			if ($this->input->post('rt')>$rt) {
				# code...
				$this->session->set_flashdata('error','RT Salah, RT Terakhir dari RW tersebut adalah RT '.$rt);
                echo '<script>window.history.back();</script>';
			}else{

			$nilai="";
			$nomor=$this->Aduan_model->nomor(date('Y-m'));
			if (empty($nomor)) {
				# code...
				$kd_aduan=date('ym')."001";
			}else{
				foreach ($nomor as $n) {
				# code...
					$kd_aduan=$n['kd_aduan']+1;
				}
			}
				$foto = "";
                $nmfile=date('ymdhis');
                $config['upload_path']          = './asset/foto_aduan/';
                $config['allowed_types']        = 'jpeg|gif|jpg|png';
                $config['max_size'] = '3072'; //maksimum besar file 3M
                $config['file_name'] = $nmfile;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto')){
                       $this->session->set_flashdata('error', 'Foto tidak sesuai format');
                       echo '<script>window.history.back();</script>';
                }else{
                	$gbr = $this->upload->data();
                    $foto = $gbr['file_name'];
					$data=array(
		                'kd_aduan'=>$kd_aduan,
		                'kd_user'=>$this->session->userdata('kd_user'),
		                'kd_topik'=>$this->input->post('kd_topik'),
		                'rt'=>$this->input->post('rt'),
		                'kd_dusun'=>$this->input->post('kd_dusun'),
		                'deskripsi'=>$this->input->post('deskripsi'),
		                'foto'=>$foto,
		                'status_aduan'=>'Masuk',
		                'dibaca'=>'T'
		             );
		             $this->Aduan_model->simpan($data);
		             if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('flash','Dikirim'); 
                        if ($this->session->userdata('user_menu')=="Aduan Masyarakat") {
				# code...
							redirect('Aduan');
						}elseif ($this->session->userdata('user_menu')=="Aduan Anda") {
							# code...
							redirect('Aduan/Anda');
						}
                     }else{
                     	$this->session->set_flashdata('error','Aduan gagal Dikirim');
                        echo '<script>window.history.back();</script>';
                     }   
				}
			}
	}
	public function Baca($kd_komentar,$kd_aduan)
	{
		# code...
		$data=array('dibaca'=>'Y');
		$this->Komentar_model->ubah($kd_komentar,$data);
		redirect('Aduan/Detail/'.$kd_aduan);

	}
	public function hapusfotoaduan($foto)
	{
		if (is_file('./asset/foto_aduan/'.$foto)) {
				    unlink('./asset/foto_aduan/'.$foto);
		}
		$web = $this->Aduan_model->get_all_web();
			foreach ($web as $w) {
			  # code...
			  $web_admin=$w['web_admin'];
			}
		echo '<script>window.location="'.$web_admin.'Aduan/aduankembali";</script>';
	}
}
