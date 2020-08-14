<?php foreach ($profil as $p) {
  # code...
  $kd_user=$p['kd_user'];
  $nm_user=$p['nm_user'];
  $email=$p['email'];
  $foto_profil=$p['foto_profil'];
}?>
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
              <li <?php if($this->session->userdata('profil') == 'pass'){echo 'class="active"';}?>><a href="#password" data-toggle="tab">Ubah Password</a></li>
              <li <?php if($this->session->userdata('profil') == 'profil'){echo 'class="active"';}?>><a href="#profil" data-toggle="tab">Ubah Profil</a></li>
              <li <?php if($this->session->userdata('profil') == 'foto'){echo 'class="active"';}?>><a href="#foto" data-toggle="tab">Ubah Foto</a></li>
            </ul>
            <div class="tab-content">
              <div class="<?php if($this->session->userdata('profil') == 'pass'){echo 'active';}?> tab-pane" id="password">
                <form class="form-horizontal" <?php echo form_open_multipart('Profil/UbahPass');?>
                  <div class="form-group">
                    <label for="password_lama" class="col-sm-2 control-label">Password Lama</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password_baru" class="col-sm-2 control-label">Password Baru</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password Baru" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password_confirm" class="col-sm-2 control-label">Konfirmasi Password Baru</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Konfirmasi Password Baru" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Ubah Password</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="<?php if($this->session->userdata('profil') == 'profil'){echo 'active';}?> tab-pane" id="profil"> 
                 <form class="form-horizontal" <?php echo form_open_multipart('Profil/UbahProfil');?>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nm_user" name="nm_user" value="<?=$nm_user?>" placeholder="Nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" value="<?=$email?>" placeholder="Email" required>
                      <input type="hidden" class="form-control" id="email1" name="email1" value="<?=$email?>" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Ubah Profil</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->         
              <!-- /.tab-pane -->
              <div class="<?php if($this->session->userdata('profil') == 'foto'){echo 'active';}?> tab-pane" id="foto"> 
                 <form class="form-horizontal" <?php echo form_open_multipart('Profil/UbahFoto');?>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Upload Foto Profil</label>

                    <div class="col-sm-10">
                      <input type="file" id="foto_profil" name="foto_profil" onchange="previewImage();" required>
                      <input type="hidden" class="form-control" id="kd_user" name="kd_user" value="<?=$kd_user?>">
                      <input type="hidden" class="form-control" id="foto" name="foto" value="<?=$foto_profil?>">
                      <p class="help-block">Upload File berupa JPG, JPEG atau PNG</p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <div class="attachment-block clearfix">
                         <img class="attachment-img" src="<?=base_url()?>asset/foto_profil/<?=$foto_profil?>" alt="Attachment Image" id="image-preview">
                     </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Ubah Foto</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->         
            </div>
            <!-- /.tab-content -->
          </div>
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