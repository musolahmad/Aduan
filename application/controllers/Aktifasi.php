<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
class Aktifasi extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Aduan_model');                        
        if ($this->session->userdata('user_login')=="Masuk") {
            # code...
            redirect('Aduan');
        }
    }
 
    function index(){
        // Load PHPMailer library
        $tgl_lahir=$this->input->post('tgl_lahir');
        $bln_lahir=$this->input->post('bln_lahir');
        $thn_lahir=$this->input->post('thn_lahir');
        $tgl = $thn_lahir.'-'.$bln_lahir.'-'.$tgl_lahir;
        $bts_umr = (date('Y')-17).'-'.date('m-d');
         if(!checkdate($bln_lahir, $tgl_lahir, $tgl_lahir)){
            $this->session->set_flashdata('error', 'Tanggal Lahir Tidak Valid!');
            echo '<script>window.history.back();</script>';
        }elseif(strtotime(date('Y-m-d'))<strtotime($tgl)){
             $this->session->set_flashdata('error', 'Tanggal Lahir Tidak Valid!');
            echo '<script>window.history.back();</script>';
        }elseif(strtotime($bts_umr)<strtotime($tgl)){
             $this->session->set_flashdata('error', 'Umur Anda belum 17 tahun!');
            echo '<script>window.history.back();</script>';
        }else{
            $nm_user = $this->input->post('nm_user');
            $email = $this->input->post('email');
            $cekemail = $this->User_model->cekemail($email);
            if (empty($cekemail)) {
                # code...
                $data_session = array('email' => $email);
                $this->session->set_userdata($data_session);

                $tgl_buat=$this->User_model->cektanggal(date('Y-m-d'));
                $kd_user="";

                if (empty($tgl_buat)) {
                    # code...
                    $kd_user=date('ymd')."0001";
                  }else{
                    foreach ($tgl_buat as $n) {
                    $kd_user = $n['kd_user']+1;
                    }
                  }
                $foto_profil = "";
                $nmfile = $kd_user;
                $config['upload_path']          = './asset/foto_profil/';
                $config['allowed_types']        = 'jpeg|gif|jpg|png';
                $config['max_size'] = '3072'; //maksimum besar file 3M
                $config['file_name'] = $nmfile;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto_profil')){
                       $this->session->set_flashdata('error', 'Foto tidak sesuai format');
                       echo '<script>window.history.back();</script>';
                }else{
                            
                    $gbr = $this->upload->data();
                    $foto_profil = $gbr['file_name'];
                    $data=array(
                    'kd_user'=>$kd_user,
                    'nm_user'=>$this->input->post('nm_user'),
                    'alamat'=>$this->input->post('alamat'),
                    'no_tlp'=>str_replace('-', '', $this->input->post('no_telp')),
                    'email'=>$this->input->post('email'),
                    'password'=>$this->input->post('pass'),
                    'tgl_lahir'=>$tgl,
                    'jns_kelamin'=>$this->input->post('jns_kelamin'),
                    'foto_profil'=>$foto_profil,
                    'tgl_buat'=>date('Y-m-d'),
                    'status_user'=>'1'
                    );
                    $this->User_model->simpan($data);
                    if ($this->db->affected_rows() > 0) {                               
                        
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
				 $this->email->subject('[Sistem Prioritas Pembangunan Desa] Aktifasi Akun'); 
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
                                                Aktifkan Akun untuk mengadu keadaan desa di Sistem Prioritas Pembangunan Desa Jeruksari dengan Kode di bawah ini:</p>
                                                <table align="center" cellpadding="0" cellspacing="0" width="50%">
                                                    <td align="center" bgcolor="#6495ED">
                                                        <p><b><font size="5" color="white">Kode Aktifasi : '.$kd_user.'</font></b></p>
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
								$this->session->set_flashdata('flash','Diregistrasikan, Kode Aktivasi berhasil terkirim. Silahakan Cek E-mail Anda'); 
								redirect('Aktifasi/Verifikasi');
						 }else {
							  show_error($this->email->print_debugger());
							  return false;
						 }
                    }else{
                        $this->session->set_flashdata('error','Data Gagal Ditambahkan');
                        echo '<script>window.history.back();</script>';
                    }
                }          
                
            }else{
                $this->session->set_flashdata('error', 'Email yang anda masukkan sudah terdaftar, Silahkan ganti Email lain');
                echo '<script>window.history.back();</script>';
            }
        }
        
    }
    public function Verifikasi()
    {
        # code...
        $data_session = array('user_menu' => 'Verifikasi');
        $this->session->set_userdata($data_session);
        $this->load->view('verifikasi');
    }
    public function KodeVerifikasi()
    {
        # code...
        $kd_user = $this->input->post('kd_user');
        $verifikasi = $this->User_model->verifikasi($kd_user,$this->session->userdata('email'));
        if (empty($verifikasi)) {
            # code...
            $this->session->set_flashdata('error', 'Kode Verifikasi yang anda masukkan Salah, Silahkan cek kembali email anda');
            echo '<script>window.history.back();</script>';
        }else{
            $data=array('kd_user'=>$kd_user,'status_user'=>'2');
            $this->User_model->ubah($kd_user,$data);
            if ($this->db->affected_rows() > 0) {
                 $data_session = array('user_menu' => 'Aduan Masyarakat');
                $this->session->set_userdata($data_session);
                redirect('Login/Masuk/'.$kd_user);
            }else{
                $this->session->set_flashdata('error','Gagal Verifikasi');
                echo '<script>window.history.back();</script>';
            }
           
        }
    }
    public function KirimVerifikasi()
    {
        # code...
        $email=$this->input->post('email');
        $cekemail = $this->User_model->cekemail($email);
        if (empty($cekemail)) {
            # code...
            $this->session->set_flashdata('error', 'Email yang Anda masukan Salah! silahkan masukkan Email yang benar!');
            echo '<script>window.history.back();</script>';
        }else{
            foreach ($cekemail as $c) {
                # code...
                $kd_user = $c['kd_user'];
                $status_user = $c['status_user'];
                $nm_user = $c['nm_user'];
            }
            if ($status_user=='2') {
                # code...
                $this->session->set_flashdata('error', 'Akun anda sudah terverifikasi');
                echo '<script>window.history.back();</script>';
            }else if($status_user=="3") {
                # code...
                $this->session->set_flashdata('error', 'Akun anda belum sudah dinonaktifkan oleh Admin');
                 echo '<script>window.history.back();</script>';
            }else{
                $data_session = array('email' => $email);
                $this->session->set_userdata($data_session);
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

				 $this->email->from($from_email, 'Jeruksari'); 
				 $this->email->to($to_email);
				 $this->email->subject('[Sistem Prioritas Pembangunan Desa] Aktifasi Akun'); 
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
                                                Aktifkan Akun untuk mengadu keadaan desa di Sistem Prioritas Pembangunan Desa Jeruksari dengan Kode di bawah ini:</p>
                                                <table align="center" cellpadding="0" cellspacing="0" width="50%">
                                                    <td align="center" bgcolor="#6495ED">
                                                        <p><b><font size="5" color="white">Kode Aktifasi : '.$kd_user.'</font></b></p>
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
							$this->session->set_flashdata('flash','Diregistrasikan, Kode Aktivasi berhasil terkirim. Silahakan Cek E-mail Anda'); 	
							 redirect('Aktifasi/Verifikasi');
						 }else {
							  show_error($this->email->print_debugger());
							  return false;
						 }
            }
        }
    }
}
?>