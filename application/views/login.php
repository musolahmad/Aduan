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
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Login</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" <?php echo form_open_multipart('Login/Login');?>
              <div class="box-body">
                <div class="form-group">
                  <label for="email">E-Mail</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?=$this->session->userdata('email')?>" required>
                </div>
                <div class="form-group">
                  <label for="pass">Password</label>
                  <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                </div>
              <!-- /.box-body -->
              </div>
              <div class="box-footer">
                  <button type="submit" class="btn btn-primary form-control">Masuk</button>                
              </div>
              <div class="box-body">
                <center><a href="<?=base_url()?>Login/LupaPassword">Lupa password?</a> | <a href="<?=base_url()?>Login/Registrasi">Registrasi</a></center>
                <center><a href="<?=base_url()?>Login/AktifasiAkun">Aktifasi Akun</a></center>
              </div>
            </form>
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
     oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
    };
  };
</script>
</body>
</html>