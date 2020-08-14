<?php  
if (empty($jml_rt)) {
  # code...
  $jml_rt=0;
}else{
foreach ($jml_rt as $r) {
  # code...
  $jml_rt=$r['jml_rt'];
}
}?>
<!DOCTYPE html>
<html>
<?php $this->load->view('menu/head')?>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav fixed">
<div class="wrapper">

  <?php $this->load->view('menu/header');?>
  <!-- Full Width Column -->
  <div class="flash-confirm" data-flashconfirm="<?=$this->session->flashdata('error');?>"></div>
      <?php if($this->session->flashdata('error')):?>
      <?php endif;?>
      
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
    <!-- Main content -->
     <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-3">
        </div>
        <div class="col-md-6">
         <!-- SELECT2 EXAMPLE -->
         <?php echo form_open_multipart('Aduan/KirimAduan');?>  
          <div class="box box-default">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="<?=base_url()?>asset/foto_profil/<?=$this->session->userdata('foto_profil')?>" alt="User Image">
                <span class="username"><a href="#"><?=$this->session->userdata('nm_user')?></a></span>
                <span class="description">Silahakan Masukan Aduan Anda</span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Topik Aduan</label>
                    <select class="form-control select2" style="width: 100%;" id="kd_topik" name="kd_topik">
                      <?php foreach ($topik as $t) {?> 
                        <option value="<?=$t['kd_topik']?>"><?=$t['nm_topik']?></option>                      
                      <?php }?>
                    </select>
                  </div>
                  <label>Lokasi</label>
                </div>                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>RT</label>
                    <select class="form-control select2" style="width: 100%;" id="rt" name="rt">
                      <?php $n=1; for ($i=0; $i <$jml_rt ; $i++) {
                          if ($n<10) {
                            # code...
                            $n='0'.$n;
                          }
                        ?> 
                        <option value="<?=$n?>"><?=$n?></option>                      
                      <?php $n++;}?>
                    </select>
                  </div>
                  <!-- /.form-group -->
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>RW</label>
                    <select class="form-control select2" style="width: 100%;" id="kd_dusun" name="kd_dusun">
                      <?php foreach ($dusun as $t) {?> 
                        <option value="<?=$t['kd_dusun']?>"><?php if($t['rw']<10){echo "0".$t['rw'];}else{echo $t['rw'];}?></option>                      
                      <?php }?>
                    </select>
                  <!-- /.input group -->
                  </div>
                  <!-- /.form-group -->
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Tuliskan Aduan Anda</label>
                    <textarea class="form-control" rows="10" name="deskripsi" id="deskripsi" placeholder="Tuliskan Aduan Anda" required></textarea>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">                    
                    <label for="foto">Upload Foto</label>
                    <input type="file" id="foto" name="foto" onchange="previewImage();" required>
                    <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                  </div>
                  <div class="form-group"> 
                     <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/img/no_pic.png" alt="Attachment Image" id="image-preview">
                     </div>
                  </div>  
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-md-12">
                  <a type="button" href="<?=base_url('index.php')?>/Aduan/Batal" class="btn btn-default">Batal</a>
                  <button type="submit" class="btn btn-primary pull-right">Kirim Aduan</button>
                  <!-- /.form-group -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.box -->
         </div> 
        </div>
        <!-- /.col -->
        <div class="col-md-3">
        </div>
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
  function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
</script>
</body>
</html>