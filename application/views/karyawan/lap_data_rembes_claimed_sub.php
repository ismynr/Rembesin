<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("karyawan/_partials/header.php") ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php $this->load->view("karyawan/_partials/sidebar.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php $this->load->view("karyawan/_partials/topbar.php") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <div class="card bg-primary mb-4 row ml-1 mr-1">
            <div class="card-body p-3">
              <h5 class="m-0 font-weight-bold text-white"><a href="<?= site_url('karyawan/lap_dataRembes/claimed') ?>" class="text-white"><i class="fas fa-arrow-alt-circle-left mr-3" style="font-size: 20px;" data-toggle="tooltip" data-placement="bottom" title="Kembali"></i></a>Detail Rembes <?= $total_rembes < $uang_lumpsum ? '<p class="kat-purple ml-3">Nota</p>':'<p class="kat-orange ml-3">Pengajuan</p>' ?></h5>
            </div>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless table-sm" width="100%" cellspacing="0">
                  <thead>
                    <?php $total_rembes = $total_rembes == '' ? '0':$total_rembes ?>
                     <tr>
                      <th width="15%">Kegiatan </th>
                      <th width="2%">:</th>
                      <td width="50%"><?= $nama_kegiatan ?></td>
                      <th width="15%">Tanggal Kegiatan</th>
                      <th width="2%">:</th>
                      <td><?= date("d M Y", strtotime($tanggal_kegiatan)) ?></td>
                    </tr>
                    <tr>
                      <th width="15%">Uang Dinas</th>
                      <th width="2%">:</th>
                      <td width="50%">Rp. <?= number_format($uang_lumpsum,0,',','.') ?></td>
                      <th width="15%">Tanggal Selesai</th>
                      <th width="2%">:</th>
                      <?php if($tanggal_selesai != '0000-00-00'): ?>
                        <td><?= date("d M Y", strtotime($tanggal_selesai)) ?></td>
                      <?php else: ?>
                        <td class="text-danger"><?= "Belum submit" ?></td>
                      <?php endif ?>
                    </tr>
                    <tr>
                      <th width="15%">Total Rembes</th>
                      <th width="2%">:</th>
                      <td width="50%">Rp. <?= number_format($total_rembes,0,',','.') ?></td>
                      <th width="15%">Tanggal Submit</th>
                      <th width="2%">:</th>
                      <?php if($tanggal_submit != '0000-00-00'): ?>
                        <td><?= date("d M Y", strtotime($tanggal_submit)) ?></td>
                      <?php else: ?>
                        <td class="text-danger"><?= "Belum submit" ?></td>
                      <?php endif ?>
                    </tr>
                    <tr>
                      <th width="15%">Keterangan Sisa</th>
                      <th width="2%">:</th>
                      <td>Rp. <?= number_format($uang_lumpsum - $total_rembes,0,',','.') ?></td>
                      <th width="15%">Tanggal Klaim</th>
                      <th width="2%">:</th>
                      <?php if($tanggal_klaim != '0000-00-00'): ?>
                        <td><?= date("d M Y", strtotime($tanggal_klaim)) ?></td>
                      <?php else: ?>
                        <td class="text-danger"><?= "Belum submit" ?></td>
                      <?php endif ?>
                    </tr>
                    <tr>
                      <?php if($tanggal_submit != "0000-00-00" && $tanggal_selesai != "0000-00-00" && $tanggal_klaim != "0000-00-00"): ?>
                        <?php if($uang_lumpsum < $total_rembes): ?>
                          <?php if($norek != null): ?>
                            <tr>
                              <th width="15%">Nama Rekening</th>
                              <th width="2%">:</th>
                              <td width="50%"><?= $nama_rekening ?></td>
                              <th width="15%">No Rekening</th>
                              <th width="2%">:</th>
                              <td><?= $no_rekening.' ('.$jenis_bank.')' ?></td>
                            </tr>
                            <tr>
                              <th width="15%">Pembayaran</th>
                              <th width="2%">:</th>
                              <td width="50%">TRANSFER</td>
                            </tr>
                          <?php else: ?>
                            <tr>
                              <th width="15%">Pembayaran</th>
                              <th width="2%">:</th>
                              <td width="50%">CASH</td>
                            </tr>
                          <?php endif ?>
                        <?php endif ?>
                      <?php endif ?>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4 mt-4">
            <div class="card-header bg-primary py-3">
              <h5 class="m-0 font-weight-bold text-white float-left">List Nota Rembes</h5> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                      <th width="5%">No</th>
                      <th>Rembes </th>
                      <th>Jenis Nota</th>
                      <th>Tanggal</th>
                      <th>Total</th>
                      <th>Foto Nota</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        </div>
      </div>
      <!-- End of Main Content -->

    <?php $this->load->view("karyawan/_partials/modal.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php $this->load->view("karyawan/_partials/modal.php") ?>
<?php $this->load->view("karyawan/_partials/js_footer.php") ?>

<script type="text/javascript">
  $(document ).ready(function(){
    $("#sidebar_menu_dataRembesin").addClass("active");
    $("#collapse_menu").addClass("show");
    $("#menu_claimed").addClass("active");

    $('#dataTable').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"<?= site_url('karyawan/lap_dataRembes/claimed/list_rembes/fetch') ?>",
        type:"POST",
        data:function(data){
          data.id_master_rembes = <?= $this->input->post('id',true) ?>;
        }
      },
      "columDefs":[
        {
          "target":[0],
          "orderable":false
        }
      ]
    });
});
</script>   
</body>
</html>
