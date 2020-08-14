<?php
$web=$this->Aduan_model->get_all_web();
foreach ($web as $w) {
  # code...
  $web_admin=$w['web_admin'];
}
?>
<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?=base_url()?>" class="navbar-brand"><b>Desa Jeruksari</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if($this->session->userdata('user_menu')=='Aduan Masyarakat'){echo 'active';}elseif ($this->session->userdata('user_menu')=='Aduan Anda') {echo 'active';}?>"><a href="<?=base_url()?>">Aduan</a></li>
            <li class="<?php if($this->session->userdata('user_menu')=='Pagu Anggaran'){echo 'active';}elseif ($this->session->userdata('user_menu')=='Pagu Anggaran') {echo 'active';}?>"><a href="<?=base_url()?>Pembangunan/PaguAnggaran/<?=date("Y")+1?>">Pagu Anggaran</a></li>
            <li class="<?php if($this->session->userdata('user_menu')=='Rencana Pembangunan'){echo 'active';}?>"><a href="<?=base_url()?>Pembangunan/Rencana/<?=date("Y")+1?>/1">Rencana Pembangunan</a></li>          
            <li class="<?php if($this->session->userdata('user_menu')=='Prioritas Pembangunan'){echo 'active';}?>"><a href="<?=base_url()?>Pembangunan/Prioritas/<?=date("Y")+1?>/1">Prioritas Pembangunan</a></li>  
             <li class="<?php if($this->session->userdata('user_menu')=='Pelaksanaan Pembangunan'){echo 'active';}?>"><a href="<?=base_url()?>Pembangunan/Pelaksanaan/<?=date("Y")?>/00/0">Pelaksanaan Pembangunan</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <!-- /.messages-menu --> 
            <!-- User Account: style can be found in dropdown.less -->
            <?php if ($this->session->userdata('user_login')!="Masuk") {?>
            <li class="dropdown messages-menu user-menu">
               <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?=base_url()?>asset/img/images.png" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Akun Saya</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Pilih Menu</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="<?=base_url();?>Login/sesionlogin">
                        <div class="pull-left">
                          <img src="<?php echo base_url()?>asset/img/login.png" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Masuk
                        </h4>
                        <p>Akun Anda</p>
                      </a>
                    </li>
                    <!-- end message -->
                     <li><!-- start message -->
                      <a href="<?=base_url();?>Login/Registrasi">
                        <div class="pull-left">
                          <img src="<?php echo base_url()?>asset/img/register.png" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Registrasi
                        </h4>
                        <p>Akun</p>
                      </a>
                    </li>
                    <!-- end message -->
                    <li><!-- start message -->
                      <a href="<?=base_url();?>Login/LupaPassword">
                        <div class="pull-left">
                          <img src="<?php echo base_url()?>asset/img/lupa_password.png" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lupa
                        </h4>
                        <p>Password?</p>
                      </a>
                    </li>
                    <!-- end message -->
                    <li><!-- start message -->
                      <a href="<?=base_url();?>Login/AktifasiAkun">
                        <div class="pull-left">
                          <img src="<?php echo base_url()?>asset/img/verifikasi.png" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Aktifasi
                        </h4>
                        <p>Akun</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                </li>
                <li class="footer"><a href="#">-- --</a></li>
              </ul>
            </li>
            <?php }else{
              $jml=$this->Aduan_model->notifikasi($this->session->userdata('kd_user'));
              if (!empty($jml)) {?>

             <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <?php 
                      $list=$this->Aduan_model->lihat($this->session->userdata('kd_user'));
                  if (empty($jml)) {
                    # code...
                    $total=0;
                  }else{
                    foreach ($jml as $j) {
                      # code...
                      $total=$j['jml'];
                    }
                  }
                ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?=$total?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Kamu Memiliki <?=$total?> Komentar Yang Belum Dibaca</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <?php foreach ($list as $l) {?>
                      <li><!-- start message -->
                        <a href="<?=base_url()?>Aduan/Baca/<?=$l['kd_komentar']?>/<?=$l['kd_aduan']?>">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="<?=$web_admin?>asset/foto_profil/<?=$l['foto_profil']?>" class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            <?=$l['nm_pegawai']?>
                            <small><i class="fa fa-clock-o"></i> <?=date('d-M-Y H:i:s',strtotime($l['tgl_komentar']));?></small>
                          </h4>
                          <!-- The message -->
                          <p><?=substr($l['isi_komentar'], 0, 20) . '...'?></p>
                        </a>
                      </li>
                      <!-- end message -->
                      <?php }?>
                    </ul>
                    <!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#"></a></li>
                </ul>
             </li>
             <?php }?>
             <li class="dropdown messages-menu user-menu">
               <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?=base_url()?>asset/foto_profil/<?=$this->session->userdata('foto_profil')?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?=$this->session->userdata('nm_user')?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Pilih Menu</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="<?=base_url();?>Profil/Menu">
                        <div class="pull-left">
                          <img src="<?php echo base_url()?>asset/dist/img/admin.png" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Kelola
                        </h4>
                        <p>Profil Anda</p>
                      </a>
                    </li>
                    <!-- end message -->
                     <li><!-- start message -->
                      <a href="<?=base_url();?>Aduan/logout" class="tombol-confirm">
                        <div class="pull-left">
                          <img src="<?php echo base_url()?>asset/dist/img/logout.png" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Keluar
                        </h4>
                        <p>Akun</p>
                      </a>
                    </li>
                    <!-- end message -->
                  </ul>
                </li>
                <li class="footer"><a href="#">-- --</a></li>
              </ul>
            </li>
            <?php }?>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <div class="flash-confirm" data-flashconfirm="<?=$this->session->flashdata('error');?>"></div>
      <?php if($this->session->flashdata('error')):echo $this->session->flashdata('error');?>
      <?php endif;?>
  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('flash');?>"></div>
      <?php if($this->session->flashdata('flash')):?>
      <?php endif;?>
  <div class="flash-berhasil" data-flashberhasil="<?=$this->session->flashdata('berhasil');?>"></div>
      <?php if($this->session->flashdata('berhasil')):?>
      <?php endif;?>