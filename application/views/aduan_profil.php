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
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <?php foreach ($user as $u) {?>
            <div class="widget-user-header bg-aqua-active">             
              <h5 class="widget-user-username"><?=$u['nm_user']?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?=base_url()?>asset/foto_profil/<?=$u['foto_profil']?>" alt="User Avatar">
            </div>
            <?php }?>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?=$jmltotal?></h5>
                    <span class="description-text">Total Aduan</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?=$jmlmasuk?></h5>
                    <span class="description-text">Belum di Proses</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                 <!-- /.col -->
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?=$jmlditerima?></h5>
                    <span class="description-text">Aduan Diterima</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header"><?=$jmlditolak?></h5>
                    <span class="description-text">Aduan Ditolak</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
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
              <a href="<?=base_url('index.php')?>/Aduan/Detail/<?=$d['kd_aduan']?>" type="button" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Lihat Selengkapnya</a>
              <?php $komen=$this->Komentar_model->get_all($d['kd_aduan'])?>
              <span class="pull-right text-muted"><?=count($komen)?> Komentar</span>
            </div>
            <?php 
              if ($this->session->userdata('user_login')=="Masuk") {?>
                <!-- /.box-footer -->
            <div class="box-footer">
              <form action="#" method="post">
                <img class="img-responsive img-circle img-sm" src="<?=base_url()?>asset/foto_profil/<?=$this->session->userdata('foto_profil')?>" alt="Alt Text">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <a href="<?=base_url('index.php')?>/Aduan/Detail/<?=$d['kd_aduan']?>">
                    <input type="text" class="form-control input-sm" placeholder="Komentar">
                  </a>
                </div>
              </form>
            </div>
            <!-- /.box-footer -->
            <?php  }
            ?>
           
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