<!DOCTYPE html>
<html lang="en">

<?php $this->load->view("perusahaan/_partials/header.php") ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php $this->load->view("perusahaan/_partials/sidebar.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view("perusahaan/_partials/topbar.php") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- /.container-fluid -->
        <div class="container">
          <div class="card bg-company mb-4 row">
              <div class="card-body p-3">
                <h5 class="m-0 font-weight-bold text-white">Tambah Karyawan</h5>
              </div>
            </div>
          <div class="card shadow row pb-4 pt-4 pl-2 pr-2 mb-5">
            <div class="card-body row">
            <div class ="col-lg-8">
              <?= $this->session->flashdata('success'); ?>
              <form class="user ml-3 mr-3" method="post" action="<?= site_url('perusahaan/form_tambah_karyawan/add') ?>">
                <div class="form-group">
                  <input type="text" name="nama_karyawan" class="form-control form-control-user" id="nama_karyawan" placeholder="Nama Karyawan" value="<?= set_value('username'); ?>" required>
                  <?= form_error('nama_karyawan', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <?php 
                    $query = $this->db->query("SELECT MAX(kode_karyawan) AS kode_karyawan FROM tb_karyawan")->row();
                    $num =  "KRY" . sprintf("%05s", (substr($query->kode_karyawan, 4, 5)+1));
                     ?>
                    <input type="text" name="kode_karyawan" class="form-control form-control-user" id="kode_karyawan" placeholder="Kode Karyawan" value="<?= $num ?>" readonly required>
                    <?= form_error('kode_karyawan', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="jabatan" class="form-control form-control-user" id="jabatan" placeholder="Jabatan" value="<?= set_value('jabatan'); ?>" required>
                    <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="example@domain.com" value="<?= set_value('email'); ?>" required>
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group row">
                  <div class="form-group col-md-5">
                    <label for="inputJKelamin">Jenis Kelamin</label><br>
                    <div class="custom-control custom-radio custom-control-inline mt-2">
                      <input type="radio" id="radioL" required="required" name="radio" class="custom-control-input" value="L">
                      <label class="custom-control-label" for="radioL">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="radioP" required="required" name="radio" class="custom-control-input" value="P">
                      <label class="custom-control-label" for="radioP">Perempuan</label>
                    </div>
                  </div>
                  <?php $getJenisIdentitas = $this->db->get('tb_jenis_identitas')->result(); ?>
                  <div class="form-group col-md-7">
                    <label for="inputRole">Jenis Identitas</label>
                    <select class="custom-select" required="required" name="jenis_identitas" style="border-radius: 10rem;" required>
                      <option selected disabled="disabled">Pilih Identitas</option>
                      <?php foreach($getJenisIdentitas as $ji): ?>
                        <option value="<?= $ji->jenis_identitas ?>" class="text-uppercase"><?= $ji->jenis_identitas ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" name="no_identitas" class="form-control form-control-user" id="no_identitas" placeholder="No Identitas" value="<?= set_value('no_identitas'); ?>" required>
                  <?= form_error('no_identitas', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                 <div class="form-group">
                  <textarea name="alamat" id="alamat" class="form-control form-control-user" placeholder="Alamat.." required><?= set_value('alamat'); ?></textarea>
                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                  <input type="username" name="username" class="form-control form-control-user" id="username" placeholder="Username" value="<?= set_value('username'); ?>" required>
                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required>
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="password2" class="form-control form-control-user" id="password2" placeholder="Tulis Password Lagi" required>
                  </div>
                </div>
                <div class = "col-lg-3 mx-auto">
                <button type="submit" class="btn btn-primary btn-user btn-block mb-1 mt-1">Simpan</button>
                </div>
              </form>
            </div>
            <div class = "col-lg-4">
              <div class="alert alert-info  ">Harap masukan data dengan benar!</div>
            </div> 
          </div>
        </div>
        </div>

      </div>
      <!-- End of container fluid -->
      </div>
      <!-- End of Main Content -->

    <?php $this->load->view("perusahaan/_partials/modal.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <?php $this->load->view("perusahaan/_partials/modal.php") ?>

<?php $this->load->view("perusahaan/_partials/js_footer.php") ?>
<script>
  $(document).ready(function(){
    $("#sidebar_menu_formTambahKaryawan").addClass("active");
  });
</script>
</body>
</html>
