  <div class="container" style="margin-top: 6rem !important">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Registrasi Perusahaan !</h1>
              </div>
              <?= $this->session->flashdata('message'); ?>
              <form class="user" method="post" action="<?= site_url('auth/registrasi') ?>">
                <div class="form-group">
                  <input type="text" name="perusahaan" class="form-control form-control-user" id="perusahaan" placeholder="Masukan Nama Perusahaan ..." value="<?= set_value('perusahaan'); ?>" autofocus>
                  <?= form_error('perusahaan', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="text" name="no_hp" class="form-control form-control-user" id="no_hp" placeholder="No Telepon" value="<?= set_value('no_hp'); ?>">
                  <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="username" name="username" class="form-control form-control-user" id="username" placeholder="Username" value="<?= set_value('username'); ?>">
                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Tulis Password Lagi">
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="alamat" class="form-control form-control-user" id='alamat' placeholder="Alamat Perusahaan"><?= set_value('alamat'); ?></textarea>
                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small text-dark" href="<?= site_url('auth/login') ?>">Sudah Punya Akun ? Silahkan Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
