  <div class="container mt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Ubah Password untuk</h1>
                    <h5><?= $this->session->userdata('reset_email') ?></h5>
                  </div>
                  <?= $this->session->flashdata('message'); ?>
                  <form class="user mt-2" method="post" action="<?= site_url('auth/resetPassword/change');?>">
                    <div class="form-group">
                      <label for="username">Usename</label>
                      <input type="username" name="username" class="form-control form-control-user" id="Password" aria-describedby="usernameHelp" value="<?= $this->session->userdata('username') ?>" readonly>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Masukan password baru" autofocus>
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="col-sm-6">
                        <label for="password2">Konfirmasi password</label>
                        <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Tulis Password Lagi">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

