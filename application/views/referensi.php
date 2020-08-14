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
          <?php foreach ($detail as $d) {?>
          <div class="row">       
          
          <div class="col-md-12">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><?=$d['nm_kegiatan']?> Lokasi RT <?=$d['rt']?> / RW <?=$d['rw']?></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">  
          
                  <div class="col-md-6">
                   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">                      
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <?php $fotoaduan=$this->Pembangunan_model->cari2($d['kd_rencana']);
                        $no=1;
                        foreach ($fotoaduan as $f) {?>
                      <li data-target="#carousel-example-generic" data-slide-to="<?=$no?>" class="<?php if($no==0){echo 'active';}?>"></li>
                      <?php $no++;}?>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="<?=$web_admin?>asset/foto_pembangunan/<?=$d['foto_lokasi']?>" alt="Foto Lokasi Sebelum Perbaikan">
                        <div class="carousel-caption">
                          Foto Lokasi Sebelum Perbaikan
                        </div>
                      </div>
                      <?php 
                        $no=1;
                        foreach ($fotoaduan as $f) {?>
                      <div class="item <?php if($no==0){echo 'active';}?>">
                        <img src="<?=base_url()?>asset/foto_aduan/<?=$f['foto']?>" alt="<?=$f['nm_topik']?>">
                        <div class="carousel-caption">
                          <?=$f['nm_topik']?>
                        </div>
                      </div>
                      <?php $no++;}?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box">
                <!-- /.box-header -->
                <div class="table-responsive mailbox-messages">
                   <table class="table table-hover table-striped">
                    <tr>
                      <td style="width: 150px">Pagu Anggaran</td>
                      <td colspan="2">Rp <?=number_format($d['biaya'],0,',','.')?> <a data-toggle="modal" data-target="#modal-rab" onclick="cek_rab('<?=$web_admin?>asset/file_rab/<?=$d["file_rab"]?>');">[Cek Detail Anggaran]</a></td>
                    </tr>
                    <tr>
                       <td><b>Kriteria Penilaian</b></td>
                       <td><b>Nilai</b></td>
                       <td><b>Detail Kriteria</b></td>
                    </tr>
                    <?php 
                      $kriteria = $this->Pembangunan_model->lihat($d['kd_rencana']);
                      foreach ($kriteria as $k) {?>
                    <tr>
                      <td ><?=$k['nm_kriteria']?></td>
                      <td><?=$k['nilai_dtl_kriteria']?></td>
                      <td><?=$k['nm_dtl_kriteria']?></td>
                    </tr>
                    <?php }?>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              </div>
                </div>

              </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <?php }?>
          <?php foreach ($detail as $d) {?>
             <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Referensi Aduan Masyarakat</b></h3>
                </div>
                <?php $cari1=$this->Pembangunan_model->cari1($d['kd_rencana']);
                  if (empty($cari1)) {?>
                    <div class="box-footer clearfix">
                 
                    <center><b>Tidak Ada Referensi Aduan!!</b></center>
                 
                </div>
                  <?php }?>
                  <?php foreach ($cari1 as $c) {
                  $look=$this->Aduan_model->cari($c['kd_aduan']);
                    foreach ($look as $l) {?>
                   <div class="box box-widget">
                      <div class="box-header with-border">
                        <div class="user-block">
                          <img class="img-circle" src="<?=base_url()?>asset/foto_profil/<?=$l['foto_profil']?>" alt="User Image">
                          <span class="username"><a href="<?=base_url('index.php')?>/Aduan/Profil/<?=$l['kd_user']?>"><?=$l['nm_user']?></a></span>
                          <span class="description">Tanggal Aduan - <?=date('d-M-Y H:i:s',strtotime($l['tgl_aduan']));?></span>
                        </div>
                        <!-- /.user-block -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <!-- Attachment -->
                        <div class="attachment-block clearfix">
                          <img class="attachment-img" src="<?=base_url()?>asset/foto_aduan/<?=$l['foto']?>" alt="Attachment Image">

                          <div class="attachment-pushed">
                            <h4 class="attachment-heading"><a href="<?=base_url('index.php')?>/Aduan/Detail/<?=$c['kd_aduan']?>"><?=$l['nm_topik']?> Lokasi RT <?=$l['rt']." RW ".$l['rw']?></a></h4>

                            <div class="attachment-text">
                              <?=substr($l['deskripsi'],0,100)?>.... <a href="<?=base_url('index.php')?>/Aduan/Detail/<?=$c['kd_aduan']?>">Selengkapnya</a>
                            </div>
                            <!-- /.attachment-text -->
                          </div>
                          <!-- /.attachment-pushed -->
                        </div>
                        <!-- /.attachment-block -->

                        <!-- Social sharing buttons -->
                        <?php $komen=$this->Komentar_model->get_all($c['kd_aduan'])?>
                        <span class="pull-right text-muted"><a href="<?=base_url('index.php')?>/Aduan/Detail/<?=$c['kd_aduan']?>"><?=count($komen)?> Komentar</a></span>
                      </div>
                      <!-- /.box-body -->
                    </div>
                <?php }}?>            
            </div>
          <?php }?>
        </div> 
        <!-- /.col -->        
        <?php $this->load->view('menu/sidebar')?>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->
<!-- /.modal cek rab -->
    <div class="modal fade" id="modal-rab">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Rencana Anggaran Biaya</h4>
              </div>              
				<div id="detail_rab">
				</div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    
					  <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Kembali</button>
                  </div>
                  <!-- /.box-footer -->                
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
  $(function () {
    $('.select2').select2()
  })
	function cek_rab(rab_pdf){
		document.getElementById("detail_rab").innerHTML ='<iframe src="'+rab_pdf+'" frameborder="0" height="500px" width="100%"></iframe>';
	}	
</script>
</body>
</html>