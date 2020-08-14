<?php
foreach ($web as $w) {
  # code...
  $web_admin=$w['web_admin'];
}
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('menu/head')?>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav fixed" onload="focus();">
<div class="wrapper">

  <?php $this->load->view('menu/header');?>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-9">
          <!-- /.nav-tabs-custom -->
          <?php foreach ($data as $d) {?>
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="<?=base_url()?>asset/foto_profil/<?=$d['foto_profil']?>" alt="User Image">
                <span class="username"><a href="<?=base_url()?>Aduan/Profil/<?=$d['kd_user']?>"><?=$d['nm_user']?></a>
                  <span class="pull-right description">
                    <?php if ($d['status_aduan']=="Masuk") {echo "Menunggu Verifikasi";}else{echo $d['status_aduan'];}?>
                  </span>
                </span>
                <span class="description">Diajukan Tanggal <?=date('d-M-Y H:i:s',strtotime($d['tgl_aduan']));?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<p><b><?=$d['nm_topik']?> Lokasi RT <?=$d['rt']." RW ".$d['rw']?></b></p>
              <p><?=$d['deskripsi']?></p>
              <img class="img-responsive pad" src="<?=base_url()?>asset/foto_aduan/<?=$d['foto']?>" alt="Photo">              
               <?php $komen=$this->Komentar_model->get_all($d['kd_aduan'])?>
              <span class="pull-right text-muted"><?=count($komen)?> Komentar</span>
            </div>
            <!-- /.box-body -->
            <div class="box-footer box-comments">
               <?php $getkomen=$this->Komentar_model->referensi($d['kd_aduan']);
              foreach ($getkomen as $gk) { $kd_admin=$gk['kd_admin'];                 
              ?>

              <div class="box-comment">
                <!-- User image -->
                <?php $admin=$this->Komentar_model->admin($kd_admin);
                  if (empty($admin)) {
                    # code...
                    $user=$this->Komentar_model->user($kd_admin);
                    foreach ($user as $u) {?>
                      <img class="img-circle img-sm" src="<?=base_ur()?>asset/foto_profil/<?=$u['foto_profil']?>" alt="User Image">
                  <?php  }
                  }else{
                    foreach ($admin as $a){?>
                     <img class="img-circle img-sm" src="<?=$web_admin?>asset/foto_profil/<?=$a['foto_profil']?>" alt="User Image">
                  <?php }}?>
                <div class="comment-text">
                      <span class="username">
                        <?php $admin=$this->Komentar_model->admin($kd_admin);
                        if (empty($admin)) {
                          # code...
                          $user=$this->Komentar_model->user($kd_admin);
                          foreach ($user as $u) {?>
                            <?=$u['nm_user']?>
                        <?php  }
                        }else{
                           foreach ($admin as $a) {
                             # code...
                            echo $a['nm_pegawai']." <span class='text-muted'>".$a['nm_jabatan']."</span>";
                           }

                       }?>
                        <p><span class="text-muted">
                          <?=date('d-M-Y H:i:s',strtotime($gk['tgl_komentar']));?>
                        </span></p> 
                      </span><!-- /.username -->
                  <?=$gk['isi_komentar']?> <a href="<?=base_url()?>Pembangunan/Lihat/<?=$gk['kd_aduan']?>">[ Lihat Referensi Rencana Pembangunan ]</a>
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <?php }?>
              <?php $getkomen=$this->Komentar_model->getkomen($d['kd_aduan']);
                    $kd_aduan=$d['kd_aduan'];
              foreach ($getkomen as $gk) { $kd_admin=$gk['kd_admin'];                 
              ?>

              <div class="box-comment">
                <!-- User image -->
                <?php $admin=$this->Komentar_model->admin($kd_admin);
                  if (empty($admin)) {
                    # code...
                    $user=$this->Komentar_model->user($kd_admin);
                    foreach ($user as $u) {?>
                      <img class="img-circle img-sm" src="<?=base_url()?>asset/foto_profil/<?=$u['foto_profil']?>" alt="User Image">
                  <?php  }}else{
                    foreach ($admin as $a) {?>
                      <img class="img-circle img-sm" src="<?=$web_admin?>asset/foto_profil/<?=$a['foto_profil']?>" alt="User Image">
                  <?php }}?>
                <div class="comment-text">
                      <span class="username">
                        <?php $admin=$this->Komentar_model->admin($kd_admin);
                        if (empty($admin)) {
                          # code...
                          $user=$this->Komentar_model->user($kd_admin);
                          foreach ($user as $u) {?>
                            <a href="<?=base_url()?>Aduan/Profil/<?=$u['kd_user']?>"><?=$u['nm_user']?></a>
                        <?php  }
                        }else{
                           foreach ($admin as $a) {
                             # code...
                            echo $a['nm_pegawai'].'<span class="text-muted"> '.$a['nm_jabatan'].'</span>';
                           }

                       }?>
                        <p><span class="text-muted">
                          <?=date('d-M-Y H:i:s',strtotime($gk['tgl_komentar']));?>
                        </span></p>  
                      </span><!-- /.username -->
                  <?=$gk['isi_komentar']?>
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <?php }?>
            </div>            
           
          </div>
          <?php }?>
          <!-- /.nav-tabs-custom -->

        </div>
        <!-- /.col -->
        <?php $this->load->view('menu/sidebar')?>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('menu/footer')?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('menu/script')?>
<script>
  function edit(kd_aduan,kd_komentar,isi_komentar) {
    // body...
    document.getElementById('kd_aduan_edit').value=kd_aduan;
    document.getElementById('kd_komentar').value=kd_komentar;
    document.getElementById('isi_komentar_edit').value=isi_komentar;
  }
</script>
</body>
</html>