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
              <?php echo form_open_multipart('Pembangunan/Cek1');?>
                  <div class="col-md-10">
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
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Lihat Data</label>
                      <button type="submit" class="btn btn-primary form-control">Lihat Data</button>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pagu Anggaran <?=$thn_filter?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <?php if (empty($pagu)) {?>
                  <div class="callout callout-warning" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-warning"></i> Perhatian:</h4>
                      Pagu Anggaran Tahun <?=$thn_filter?> Belum di Isi
                  </div>
                <?php }else{ foreach ($pagu as $p) {?>  
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-6">
                      <?php if($p['tipe_akun']==1){?><font <?php if($p['kd_induk']==0){echo 'style="color: red"';}?>><b><?php }?><?=$p['nm_bidang']?><?php if($p['tipe_akun']==1){?></b></font><?php }?>
                    </label>
                    <div class="col-sm-6">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?=number_format($p['pagu'],0,',','.')?>" readonly>
                    </div>
                  </div>
                <?php }}?>  
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
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
  $(function () {
    $('.select2').select2()
  })
</script>
</body>
</html>