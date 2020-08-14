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
         <?php echo form_open_multipart('Aktifasi');?>  
          <div class="box box-default">
            <div class="box-header with-border">
              <h4>Daftar dan ikut serta dalam pembangunan Desa Jeruksari</h4>
              <small>Pastikan Data yang Anda masukan benar</small>
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
                    <label for="nm_user">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nm_user" name="nm_user" placeholder="Nama Lengkap" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="no_telp">No Telpon</label>
                    <input type="text" class="form-control no_hp" id="no_telp" minlength="10" name="no_telp" placeholder="No Telpon" required>
                  </div>
                </div>       
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password"  minlength="6" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="pass">Tanggal Lahir</label>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control select2" style="width: 100%;" id="tgl_lahir" name="tgl_lahir">
                      <option selected="selected" value="0">Tanggal</option>
                      <?php 
                        for ($i=1; $i <= 31; $i++) { //membuat looping tgl 1-31
                          if ($i == date("j")){ $selectdate ="selected";}//menentukan yang sesuai dg tanggal hari ini
                          else {$selectdate="";}
                          if ($i <=9 ) {$i2="0$i";}//jika tgl 1-9 menjadi 01-09, jika menggunakan type data DATE
                          else{$i2="$i";}//selain tgl 1-9 akan tetap
                          echo ("<option value=\"$i2\" $selectdate>$i2</option>"."\n");//untuk mengeluarkan pilihannya
                         } 
                      ?>
                    </select>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control select2" style="width: 100%;" id="bln_lahir" name="bln_lahir">
                      <option selected="selected">Bulan</option>
                      <?php 
                        $bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                        $jlh_bln=count($bulan);
                        for ($i=1; $i <= $jlh_bln; $i+=1) { //membuat looping tgl 1-31
                          if ($i == date("m")){ $selectdate ="selected";}//menentukan yang sesuai dg tanggal hari ini
                          else {$selectdate="";}
                          echo ("<option value=\"$i\" $selectdate>$bulan[$i]</option>"."\n");//untuk mengeluarkan pilihannya
                         } 
                      ?>
                    </select>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control select2" style="width: 100%;" id="thn_lahir" name="thn_lahir">
                      <option selected="selected">Tahun</option>
                      <?php
                       $thn_skr = date('Y');
                       for ($x=$thn_skr; $x >=1900; $x--) { 
                      ?> 
                       <option <?php if($x==$thn_skr) echo "selected='selected'"?> value="<?php echo $x;?>"><?php echo $x;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="jns_kelamin">Jenis Kelamin</label><br>
                    <input type="radio" name="jns_kelamin" value="L" required> Laki-laki <input type="radio" name="jns_kelamin" value="P" required> Perempuan<br>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.form-group -->
                <div class="col-md-12">
                  <div class="form-group">                    
                    <label for="foto_profil">Upload Foto Profil</label>
                    <input type="file" id="foto_profil" name="foto_profil" onchange="previewImage();" required>
                    <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                  </div>
                  <div class="form-group"> 
                     <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/img/images.png" alt="Attachment Image" id="image-preview">
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
                  <a type="button" href="<?=base_url('index.php')?>/Login/Registrasi" class="btn btn-default">Hapus Data</a>
                  <button type="submit" class="btn btn-success pull-right">Daftar</button>
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
    // Format nomor HP.
    $( '.no_hp' ).mask('000000000000');
    $('.select2').select2()
  })
  function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("foto_profil").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
</script>
</body>
</html>