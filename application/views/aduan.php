<!DOCTYPE html>
<html>
<?php $this->load->view('menu/head')?>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav fixed">
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
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?=base_url('index.php')?>/Aduan">Aduan Masyarakat</a></li>
               <?php if ($this->session->userdata('user_login')=="Masuk") {?>
              <li><a href="<?=base_url('index.php')?>/Aduan/Anda">Aduan Anda</a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php if ($this->session->userdata('user_login')=="Masuk") {?>
              <div class="user-block">
                <img class="img-responsive img-circle img-sm" src="<?=base_url()?>asset/foto_profil/<?=$this->session->userdata('foto_profil')?>" alt="User Image">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <a href="<?=base_url('')?>Aduan/Formulir"><input type="text" class="form-control" placeholder="Laporkan Aduan Anda Untuk Kemajuan Desa Jeruksari"></a>
                </div>
              </div>
              <?php }else{?>
                <div class="user-block">
                <img class="img-responsive img-circle img-sm" src="<?=base_url()?>asset/dist/img/images.png" alt="User Image">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <a href="<?=base_url()?>Login"><input type="text" class="form-control" placeholder="Laporkan Aduan Anda Untuk Kemajuan Desa Jeruksari"></a>
                </div>
              </div>
              <?php }?>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
          <?php foreach ($data as $d) {?>
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="<?=base_url()?>asset/foto_profil/<?=$d['foto_profil']?>" alt="User Image">
                <span class="username"><a href="<?=base_url()?>Aduan/Profil/<?=$d['kd_user']?>"><?=$d['nm_user']?></a> <span class="pull-right description"> <?php if ($d['status_aduan']=="Masuk") {echo "Menunggu Verifikasi";}else{echo $d['status_aduan'];}?></span></span>
                <span class="description">Diadukan Tanggal <?=date('d-M-Y H:i:s',strtotime($d['tgl_aduan']));?></span>                
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
              <a href="<?=base_url()?>Aduan/Detail/<?=$d['kd_aduan']?>" type="button" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Lihat Selengkapnya</a>
              <?php $komen=$this->Komentar_model->get_all($d['kd_aduan'])?>
              <span class="pull-right text-muted"><a href="<?=base_url()?>Aduan/Detail/<?=$d['kd_aduan']?>"><?=count($komen)?> Komentar</a></span>
            </div>           
          </div>
          <?php }?>
          <!-- /.nav-tabs-custom -->
          <center><?= $this->pagination->create_links();?></center>
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
</body>
</html>