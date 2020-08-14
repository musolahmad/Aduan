<div class="col-md-3">
          <!-- general form elements -->
          <?php if ($this->session->userdata('user_login')!="Masuk") {?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Login</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" <?php echo form_open_multipart('Login/Login');?>
              <div class="box-body">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
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
          <?php }else{?>
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue-active">
              <h3 class="widget-user-username"><?=$this->session->userdata('nm_user')?></h3>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?=base_url()?>asset/foto_profil/<?=$this->session->userdata('foto_profil')?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Total Aduan <span class="pull-right badge bg-blue"><?=$this->Aduan_model->jmltotal($this->session->userdata('kd_user'))?></span></a></li>
                <li><a href="#">Belum di Proses <span class="pull-right badge bg-aqua"><?=$this->Aduan_model->jmlmasuk($this->session->userdata('kd_user'))+$this->Aduan_model->jmldiajukan($this->session->userdata('kd_user'))?></span></a></li>
                <li><a href="#">Aduan Diterima<span class="pull-right badge bg-green"><?=$this->Aduan_model->jmlditerima($this->session->userdata('kd_user'))?></span></a></li>
                <li><a href="#">Aduan Ditolak<span class="pull-right badge bg-red"><?=$this->Aduan_model->jmlditolak($this->session->userdata('kd_user'))?></span></a></li>
              </ul>
            </div>
            </div>
          </div>
          <!-- /.widget-user -->
          <?php }?>
        </div>
        