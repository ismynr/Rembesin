  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
        </div>
        <div class="modal-body">Apakah Anda Yakin Ingin Keluar ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= site_url('auth/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Profile Modal-->
<form action="<?= site_url('admin/ubahProfile');?>" method="post" class="user">
  <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title float-left pr-2" id="profileModalLabel">Profile Saya</h5>
          <h6 class="p-1 bg-danger text-white rounded"><?= getUserRole(); ?></h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <?php 
          $getAdmin = getById('tb_admin','WHERE id_user="'.$this->session->userdata('id_user').'"');
           ?>
          <div class="container">
            <div class="row">
              <img src="<?= base_url('assets\img\img_avatar.png') ?>"  alt="Image Profile" style="width: 100px; border-radius: 50%;margin: 0px 20px 20px 0px;">
              <div class="information">
                <table class="table table-borderless">
                  <tr>
                    <th>Dibuat : </th>
                    <th><?= date("d, M Y H:i:s", strtotime($getAdmin->created_at)) ?></th>
                  </tr>
                  <tr>
                    <th>Diubah : </th>
                    <th><?= date("d, M Y H:i:s", strtotime($getAdmin->updated_at)) ?></th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control form-control-user" id="nama" value="<?= $getAdmin->nama_admin ?>">
            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control form-control-user" id="email" value="<?= $getAdmin->email ?>">
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_admin" value="<?= $getAdmin->id_admin ?>">
          <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</form>