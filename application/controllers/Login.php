<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        if ($this->session->userdata('user_login')=="Masuk") {
        	# code...
        	redirect('Aduan');
        }
    }
	public function index()
	{
		$data_session = array('user_menu' => 'Login');
		$this->session->set_userdata($data_session);
		$this->load->view('login');
	}
	public function sesionlogin()
	{
		# code...
		$data_session = array('email' => '');
		$this->session->set_userdata($data_session);
		redirect('Login');
	}
	public function registrasi()
	{
		$data_session = array('user_menu' => 'Registrasi');
		$this->session->set_userdata($data_session);
		$this->load->view('registrasi');
	}
	public function masuk($kd_user)
	{
		$cari = $this->User_model->cari($kd_user);
		foreach ($cari as $c) {
			# code...
			$kd_user = $c['kd_user'];
			$nm_user = $c['nm_user'];
			$foto_profil = $c['foto_profil'];
			$password=$c['password'];
		}
		$data_session = array('kd_user' => $kd_user,'nm_user'=>$nm_user,'foto_profil'=>$foto_profil,'password'=>$password,'user_login'=>'Masuk');
		$this->session->set_userdata($data_session);
		$this->session->set_flashdata('berhasil', $nm_user);
		redirect('Aduan');
	}
	public function LupaPassword()
	{
		$data_session = array('user_menu' => 'Lupa Password');
		$this->session->set_userdata($data_session);
		$this->load->view('lupa_password');
	}
	public function aktifasiAkun()
	{
		$data_session = array('user_menu' => 'Aktifasi Akun');
		$this->session->set_userdata($data_session);
		$this->load->view('verifikasi_akun');
	}
	public function vefikasipassword()
	{
		$email=$this->input->post('email');
		$cekemail = $this->User_model->cekemail($email);
		if (empty($cekemail)) {
			# code...
			$this->session->set_flashdata('error', 'Email yang Anda masukan Tidak Terdaftar! silahkan masukkan Email yang benar!');
            echo '<script>window.history.back();</script>';
		}else{
			foreach ($cekemail as $c) {
				# code...
				$password = $c['password'];
				$nm_user = $c['nm_user'];
				$status_user = $c['status_user'];
			}
			if ($status_user=="1") {
				# code...
				$this->session->set_flashdata('error', 'Akun anda belum diaktifasi, Silahkan aktifasi akun anda terlebih dahulu');
           		 echo '<script>window.history.back();</script>';
			}else if($status_user=="3") {
				# code...
				$this->session->set_flashdata('error', 'Akun anda belum sudah dinonaktifkan oleh Admin');
           		 echo '<script>window.history.back();</script>';
			}else{
						$from_email = "jeruksaridesa@gmail.com"; 
				 $to_email = $email; 

				 $config = Array(
							'protocol' => 'smtp',
							'smtp_host' => 'ssl://smtp.googlemail.com',
							'smtp_port' => 465,
							'smtp_user' => $from_email,
							'smtp_pass' => 'tirtopekalongan',
							'mailtype'  => 'html', 
							'charset'   => 'utf-8'
					);

				 $this->load->library('email', $config);
				 $this->email->set_newline("\r\n");   

				 $this->email->from($from_email, 'Desa Jeruksari'); 
				 $this->email->to($to_email);
				 $this->email->subject('[Sistem Prioritas Pembangunan Desa] Lupa Password'); 
				 $this->email->message('
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="border-collapse: collapse;">
                            <tr>
                                <td align="center" bgcolor="#F5FFFA">
                                    <h1>Sistem Prioritas Pembangunan Desa Jeruksari</h1>
                                    <p>Jalan Raya Jeruksari no 381 Desa Jeruksari, Kecamatan Tirto, Kabupaten Pekalongan</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 30px 10px 30px;">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td >
                                                <p>Yth. Bpk/Ibu/Sdr/i '.$nm_user.',</p>

                                                <p>Terima Kasih telah menggunakan Sistem Prioritas Pembangunan Desa Jeruksari<br>
                                                Berikut ini  password anda di Sistem Prioritas Pembangunan Desa Jeruksari:</p>
                                                <table align="center" cellpadding="0" cellspacing="0" width="50%">
                                                    <td align="center" bgcolor="#6495ED">
                                                        <p><b><font size="5" color="white">Password Anda : '.$password.'</font></b></p>
                                                    </td>
                                                </table>                                
                                                <p>Kami perlu memastikan bahwa email Anda benar dan tidak disalahgunakan oleh pihak yang tidak berkepentingan.</p>

                                                Salam hormat kami,<br>
                                                Admin Sistem Prioritas Pembangunan Desa Jeruksari
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#98FB98" style="padding: 10px 10px 10px 30px;">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td>
                                                Surel ini dikirimkan secara otomatis dan tidak untuk dibalas. Terima kasih.
                                            </td>
                                        </tr>
                                    </table>
                                </td>   
                            </tr>
                        </table>
                        ');
                        //Send mail 
						 if($this->email->send()){
								$this->session->set_flashdata('flash','Dikirim Silahkan Cek E-mail Anda Untuk Melihat Password');
								$data_session = array('email' => $email);
								$this->session->set_userdata($data_session);
								redirect('Login');
						 }else {
							  show_error($this->email->print_debugger());
							  return false;
						 }	
                    }
		}
	}
	public function login()
	{
		$email=$this->input->post('email');
		$pass=$this->input->post('pass');
		$cekemail = $this->User_model->cekemail($email);
		if (empty($cekemail)) {
			# code...
			$this->session->set_flashdata('error', 'Email yang Anda masukan Salah! silahkan masukkan Email yang benar!');
            echo '<script>window.history.back();</script>';
		}else{
			foreach ($cekemail as $c) {
				# code...
				$kd_user = $c['kd_user'];
				$password = $c['password'];
				$status_user = $c['status_user'];
			}
			if ($password!=$pass) {
				# code...
				$this->session->set_flashdata('error', 'Password yang Anda masukan Salah! silahkan masukkan Password yang benar!');
            	echo '<script>window.history.back();</script>';
			}elseif ($status_user=='1') {
				# code...
				$this->session->set_flashdata('error', 'Akun belum di aktifasi, Silahkan aktifasi akun terlebih dahulu');
            	echo '<script>window.history.back();</script>';
			}else if($status_user=="3") {
				# code...
				$this->session->set_flashdata('error', 'Akun anda belum sudah dinonaktifkan oleh Admin');
           		 echo '<script>window.history.back();</script>';
			}else{
				redirect('Login/Masuk/'.$kd_user);
			}
		}
	}
	public function tambahuser()
	{
		$data=array(
			'kd_kegiatan'=>$this->input->post('kd_kegiatan'),
			'nm_kegiatan'=>$this->input->post('nm_kegiatan')
		);
		$this->Kegiatan_model->simpan($data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Ditambahkan');
		}else{
			$this->session->set_flashdata('error','Data Gagal Ditambahkan');
		}
		redirect('Kegiatan');
	}
	public function editkegiatan()
	{
		$data=array(
			'kd_kegiatan'=>$this->input->post('kd_kegiatan_edit'),
			'nm_kegiatan'=>$this->input->post('nm_kegiatan_edit')
		);
		$this->Kegiatan_model->ubah($this->input->post('kd_kegiatan_edit'),$data);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Diubah');
		}else{
			$this->session->set_flashdata('error','Data Gagal Diubah');
		}
		redirect('Kegiatan');
	}
	public function hapus($kd_kegiatan)
	{
		$this->Kegiatan_model->hapus($kd_kegiatan);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('flash','Dihapus');
		}else{
			$this->session->set_flashdata('error','Data Gagal Dihapus');
		}
		redirect('Kegiatan');
	}
	
}
