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
<form action="<?= site_url('karyawan/ubahProfile');?>" class="user" method="post">
  <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title pr-2" id="profileModalLabel">Profile Saya</h5>
          <h6 class="p-1 text-white rounded bg-pink"><?= getUserRole(); ?></h6>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <?php 
          $getKaryawan = getById('tb_karyawan','WHERE id_user="'.$this->session->userdata('id_user').'"');
          $getPerusahaan = $this->db->get_where('tb_perusahaan', array('id_perusahaan'=>$getKaryawan->id_perusahaan))->row();
           ?>
           <div class="container">
            <div class="row">
              <img src="<?= base_url('assets\img\karyawan_avatar.png') ?>"  alt="Image Profile" style="width: 100px; border-radius: 50%;margin: 0px 20px 20px 0px;" class="float-left">
              <div class="information">
                <table class="table table-borderless">
                  <tr>
                    <th>Dibuat : </th>
                    <th><?= date("d, M Y H:i:s", strtotime($getKaryawan->created_at)) ?></th>
                  </tr>
                  <tr>
                    <th>Diubah : </th>
                    <th><?= date("d, M Y H:i:s", strtotime($getKaryawan->updated_at)) ?></th>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <input type="hidden" name="id_karyawan">
          <div class="form-group row">
          <div class="col-md-6">
            <label for="nama_perusahaan">Perusahaan</label> 
            <input type="text" name="nama_perusahaan" class="form-control form-control-user" id="nama_perusahaan" value="<?= $getPerusahaan->nama_perusahaan ?>" disabled required>
            <?= form_error('nama_perusahaan', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
          <div class="col-md-6">
            <label for="jabatan_karyawan">Jabatan</label> 
            <input type="text" name="jabatan_karyawan" class="form-control form-control-user" id="jabatan_karyawan" value="<?= $getKaryawan->jabatan_karyawan ?>" disabled required>
            <?= form_error('jabatan_karyawan', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="kode_karyawan">Kode Karyawan</label>
              <input type="text" name="kode_karyawan" class="form-control form-control-user" id="kode_karyawan" value="<?= $getKaryawan->kode_karyawan ?>" required disabled>
              <?= form_error('kode_karyawan', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="col-md-8">
              <label for="nama_karyawan">Nama</label>
              <input type="text" name="nama_karyawan" class="form-control form-control-user" id="nama_karyawan" value="<?= $getKaryawan->nama_karyawan ?>" required>
              <?= form_error('nama_karyawan', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
          </div>
          <div class="form-group">
              <label for="email_karyawan">Email</label>
              <input type="text" name="email_karyawan" class="form-control form-control-user" id="email_karyawan" value="<?= $getKaryawan->email_karyawan ?>" required>
              <?= form_error('email_karyawan', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group row">
              <div class="form-group col-md-5">
                <?php $checkedP = $getKaryawan->jk_karyawan == "P" ? "checked":"" ?>
                 <?php $checkedL = $getKaryawan->jk_karyawan == "L" ? "checked":"" ?>
                <label for="inputJKelamin">Jenis Kelamin</label><br>
                <div class="custom-control custom-radio custom-control-inline mt-2">
                  <input type="radio" id="radioL" required="required" name="radio" class="custom-control-input" value="L" <?= $checkedL ?>>
                  <label class="custom-control-label" for="radioL">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="radioP" required="required" name="radio" class="custom-control-input" value="P" <?= $checkedP ?>>
                  <label class="custom-control-label" for="radioP">Perempuan</label>
                </div>
              </div>
              <?php $getJenisIdentitas = $this->db->get('tb_jenis_identitas')->result(); ?>
              <div class="form-group col-md-7">
                <label for="inputRole">Jenis Identitas</label>
                <select class="custom-select" style="border-radius: 10rem;" required="required" name="jenis_identitas">
                  <option disabled selected value readonly>Pilih Identitas</option>
                  <?php foreach($getJenisIdentitas as $ji): ?>
                  <?php $sel = $getKaryawan->identitas_karyawan == $ji->jenis_identitas ? 'selected':''; ?>
                    <option value="<?= $ji->jenis_identitas ?>" class="text-uppercase" <?= $sel ?>><?= $ji->jenis_identitas ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="no_identitas">No Identitas</label>
              <input type="text" name="no_identitas" class="form-control form-control-user" id="no_identitas" placeholder="No Identitas" value="<?= $getKaryawan->no_identitas_karyawan ?>">
              <?= form_error('no_identitas', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
          <div class="form-group">
            <label for="alamat_karyawan">Alamat</label>
            <textarea name="alamat_karyawan" id="alamat_karyawan" class="form-control form-control-user" required><?= $getKaryawan->alamat_karyawan ?></textarea>
            <?= form_error('alamat_karyawan', '<small class="text-danger pl-3">', '</small>') ?>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="<?= $this->session->userdata('id_user'); ?>" required>
          <button type="submit" class="btn btn-primary" name="btn">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</form>