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
                    <h1 class="h4 text-gray-900 mb-4">Lupa Password !</h1>
                    <small>Berlaku untuk akun perusahaan</small>
                  </div>
                  <?= $this->session->flashdata('message'); ?>
                  <form class="user mt-2" method="post" action="<?= site_url('auth/forgot_password');?>">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="Password" aria-describedby="emailHelp" placeholder="Masukan Email ..." value="<?= set_value('email');?>" autofocus>
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-dark" href="<?= site_url('auth/login') ?>">Kembali ke Halaman Login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

