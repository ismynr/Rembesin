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
                    <h1 class="h4 text-gray-900 mb-4">Silahkan Masuk !</h1>
                  </div>
                  <?= $this->session->flashdata('message'); ?>
                  <form class="user" method="post" action="<?= site_url('auth/login');?>">

                    <div class="form-group">
                      <input type="username" name="username" class="form-control form-control-user" id="username" aria-describedby="usernameHelp" placeholder="Masukan Username ..." value="<?= set_value('username');?>" autofocus>
                      <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>

                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="Password" placeholder="Password">
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block"> Masuk </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-dark" href="<?= site_url('auth/forgot_password') ?>">Lupa Password ?</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-dark" href="<?= site_url('auth/registrasi') ?>">Belum punya akun ? Buat Akun Baru !</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
