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
          <div class="box">
            <div class="box-header">
              <?php echo form_open_multipart('Pembangunan/cekkegiatan');?>
                <div class="col-md-3">
                    <div class="form-group">
                      <label>Filter Tahun</label>
                      <select class="form-control select2" style="width: 100%;" id="tahun" name="tahun">
                       <?php
                       $thn_filter = $tahun;
                       $thn_skr = date('Y')+1;
                       for ($x=$thn_skr; $x >=2015; $x--) { 
                       ?> 
                       <option <?php if($x==$thn_filter) echo "selected='selected'"?> value="<?php echo $x;?>"><?php echo $x;?></option>
                       <?php } ?>
                      </select>
                    </div>
                  </div>     
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Filter Bulan</label>
                      <select class="form-control select2" style="width: 100%;" id="bulan" name="bulan">
                       <?php
                       $bln=array('Semua Bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                       $bln_filter = $bulan;
                       $bln_skr =12;
                       $y=0;
                       for ($x=0; $x<=$bln_skr ; $x++) {                          
                        if ($y<10) {
                          # code...
                          $y='0'.$y;
                        }
                       ?> 
                       <option <?php if($x==$bln_filter) echo "selected='selected'"?> value="<?=$y?>"><?=$bln[$x]?></option>
                       <?php 
                         $y=$y+1;} ?>
                      </select>
                    </div>
                  </div>  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Filter Status</label>
                      <select class="form-control select2" style="width: 100%;" id="status_pelaksanaan" name="status_pelaksanaan">
                        <option <?php if($status=="0") echo "selected='selected'"?> value="0">Semua Status</option>
                        <option <?php if($status=="1") echo "selected='selected'"?> value="1">Belum Dikerjakan</option>
                        <option <?php if($status=="2") echo "selected='selected'"?> value="2">Sedang Dikerjakan</option>
                        <option <?php if($status=="3") echo "selected='selected'"?> value="3">Selesai Dikerjakan</option>
                      </select>
                    </div>
                  </div>  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Lihat Data</label>
                      <button type="submit" class="btn btn-primary form-control">Lihat Data</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
          <!-- row -->
      <h3>
        Agenda Pelaksanaan Pembangunan <?php $bln_filter=$bln_filter+0; if($bln_filter!=0){echo "Bulan ".$bln[$bln_filter];}?> Tahun <?=$thn_filter?>
      </h3>
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <?php if (empty($pelaksanaan)) {?>
            <!-- timeline item -->
            <li>
              <i class="fa fa-close bg-red"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">
                  Belum Ada Kegiatan
                  <?php if($status=="2"){?>Yang Sedang Dikerjakan<?php }elseif($status=="3"){?>Yang Selesai Dikerjakan<?php }?>
                  dalam Pelaksanaan Pembangunan Pada <?php $bln_filter=$bln_filter+0; if($bln_filter!=0){echo "Bulan ".$bln[$bln_filter];}?> Tahun <?=$thn_filter?>
                </h3>  
              </div>
            </li>
            <!-- END timeline item -->
            <?php }else{foreach ($pelaksanaan as $p) {?>
            <li class="time-label">
                  <span class="bg-red">
                    <?=date('d M, Y',strtotime($p['tgl_mulai']));?>
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
			<div class="row">       
          
          <div class="col-md-12">
            <div class="box box-solid">
              <div class="box-header with-border">			   
                <h3 class="box-title"><b><?=$p['nm_kegiatan']?> Lokasi RT <?=$p['rt']?> / RW <?=$p['rw']?>
					<?php if($p['status_pelaksanaan']=="1"){?>( Belum Dilaksanakan )<?php }elseif($p['status_pelaksanaan']=="2"){?>( Sedang Dilaksanakan )<?php }elseif($p['status_pelaksanaan']=="3"){?>( Selesai Dilaksanakan )<?php }?></b></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">  
          
                  <div class="col-md-12">
					<h4>Foto Lokasi Sebelum Perbaikan</h4>
                   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">                      
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <?php $fotoaduan=$this->Pembangunan_model->cari2($p['kd_rencana']);
                        $no=1;
                        foreach ($fotoaduan as $f) {?>
                      <li data-target="#carousel-example-generic" data-slide-to="<?=$no?>" class="<?php if($no==0){echo 'active';}?>"></li>
                      <?php $no++;}?>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="<?=$web_admin?>asset/foto_pembangunan/<?=$p['foto_lokasi']?>" alt="Foto Lokasi Sebelum Perbaikan">
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
                <div class="col-md-12">
                  <div class="box">
                <!-- /.box-header -->
                <div class="table-responsive mailbox-messages">
                   <table class="table table-hover table-striped">
                    <tr>
                      <td style="width: 150px">Pagu Anggaran</td>
                      <td colspan="2">Rp <?=number_format($p['biaya'],0,',','.')?> <a data-toggle="modal" data-target="#modal-rab" onclick="cek_rab('<?=$web_admin?>asset/file_rab/<?=$p["file_rab"]?>');">[Cek Detail Anggaran]</a></td>
                    </tr>
                    <tr>
                       <td><b>Kriteria Penilaian</b></td>
                       <td><b>Nilai</b></td>
                       <td><b>Detail Kriteria</b></td>
                    </tr>
                    <?php 
                      $kriteria = $this->Pembangunan_model->lihat($p['kd_rencana']);
                      foreach ($kriteria as $k) {?>
                    <tr>
                      <td ><?=$k['nm_kriteria']?></td>
                      <td><?=$k['nilai_dtl_kriteria']?></td>
                      <td><?=$k['nm_dtl_kriteria']?></td>
                    </tr>                   
                    <?php }?>
                     <tr>
                      <td style="width: 150px"><b>Tanggal Mulai</b></td>
                      <td colspan="2"><b><?=date('d-m-Y',strtotime($p['tgl_mulai']));?></b></td>
                    </tr>
                    <tr>
                      <td style="width: 150px"><b>Tanggal Berakhir</b></td>
                      <td colspan="2"><b><?=date('d-m-Y',strtotime($p['tgl_akhir']));?></b></td>
                    </tr>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              </div>
				<?php if($p['status_pelaksanaan']=="3"){?>
					<div class="col-md-12">
					<h4>Foto Lokasi Sesudah Perbaikan</h4>
                   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="<?=$web_admin?>asset/foto_pembangunan/<?=$p['foto_lokasi_terbaru']?>" alt="Foto Lokasi Sebelum Perbaikan">
                        <div class="carousel-caption">
                          Foto Lokasi Sesudah Perbaikan
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
				<?php }?>
                </div>

              </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
            <!-- END timeline item -->
            <?php }}?>
            <!-- END timeline item -->
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        </div>
        <!-- /.col -->        
        <?php $this->load->view('menu/sidebar')?>
        <!-- /.col -->
        
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