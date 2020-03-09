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
        <?= $this->session->flashdata('success'); ?>
        
          <div class="card shadow mb-4">
            <div class="card-header bg-primary pt-3">
              <h5 class="m-0 font-weight-bold text-white float-left">Rembes Sudah Diklaim</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="data_table" width="100%" cellspacing="0" role="tabpanel" aria-labelledby="home-tab">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Kategori</th>
                      <th>Kegiatan</th>
                      <th>Uang Lumpsum</th>
                      <th>Total Rembes</th>
                      <th width="12%">Tgl Kegiatan</th>
                      <th width="12%">Tgl Selesai</th>
                      <th width="12%">Tgl Klaim</th>
                      <th width="12%">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <?php $this->load->view("karyawan/_partials/footer.php") ?>      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  
  <?php $this->load->view("karyawan/_partials/modal.php") ?>

<?php $this->load->view("karyawan/_partials/js_footer.php") ?>

<script type="text/javascript">
  $(document).ready(function(){
    $("#sidebar_menu_dataRembesin").addClass("active");
    $("#collapse_menu").addClass("show");
    $("#menu_claimed").addClass("active");
    
    $('[name="tanggal"]').datepicker({
      autoclose: true,
      todayHighlight: true,
      orientation: "top auto",
      format: 'yyyy-mm-dd'
    });

    $('#data_table').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
          url:"<?= base_url('karyawan/lap_dataRembes/claimed/fetch') ?>",
          type:"POST"
        },
        "columDefs":[
          {
            "target":[0],
            "orderable":false
          }
        ]
      });
});

//GET DELETE
  $(document).on('click','.submitModalButton', function(){
      var id = $(this).data('id');
      $('[name="submit_id"]').val(id);
      $("#submit_text").text( $(this).data('nama'));
      $('#submitModal').modal('show');
  });
  $(document).on('click','.cancelSubmitModalButton', function(){
      var id = $(this).data('id');
      $('[name="submit_id"]').val(id);
      $("#submit_text").text( $(this).data('nama'));
      $('#cancelSubmitModal').modal('show');
  });













































// $(document).ready(function(){
//   $(document).on('click','.rembesModalButton', function(){
    
//     if(! $.fn.DataTable.isDataTable( '#dataTable' )){
//       console.log('if');
//       var id = $(this).data('id');
//       var nama = $(this).data('nama');
//       var tanggal = $(this).data('tanggal');
//       const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
//       const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", 
//               "September", "Oktober", "November", "Desember"];
//       var date_input = new Date(tanggal);
//       var day = days[date_input.getDay()];
//       var date = date_input.getDate();
//       var month = months[date_input.getMonth()+1];
//       var year = date_input.getFullYear();
//       $('#text-tanggal_kegiatan').text(day+", "+date+" "+month+" "+year);
//       $('#text-nama_kegiatan').text(nama);
//       // $('#text-tanggal_kegiatan').text(tanggal);
//       $('#listModal').modal('show');
//       showTable(id);
//     }
//   });
// });
// function showTable(idnya){
//   var dataTable = $('#dataTable').DataTable({
//       "processing":true,
//       "serverSide":true,
//       "order":[],
//       "ajax":{
//         url:"<?= base_url('karyawan/lap_dataRembes/list_rembes/fetch') ?>",
//         type:"POST",
//         data:function(data){
//           data.id_master_rembes = idnya;
//         }
//       },
//       "columDefs":[
//         {
//           "target":[0],
//           "orderable":false
//         }
//       ]
//     });
  
// }
  //GET DATA UPDATE
  // $(document).on('click','.rembesModalButton', function(){
  //   datatable.ajax.reload();
  //   var datatables = $('#dataTable').DataTable({
  //     "processing":true,
  //     "serverSide":true,
  //     "order":[],
  //     "ajax":{
  //       url:"<?= base_url('karyawan/lap_dataRembes/list_rembes/fetch') ?>",
  //       type:"POST",
  //       data:function(data){
  //         data.id_master_rembes = $(this).data('id');
  //       }
  //     },
  //     "columDefs":[
  //       {
  //         "target":[0],
  //         "orderable":false
  //       }
  //     ]
  //   });



  //   var id = $(this).data('id');
  //   var nama = $(this).data('nama');
  //   var tanggal = $(this).data('tanggal');
  //   const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
  //   const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", 
  //           "September", "Oktober", "November", "Desember"];
  //   var date_input = new Date(tanggal);
  //   var day = days[date_input.getDay()];
  //   var date = date_input.getDate();
  //   var month = months[date_input.getMonth()+1];
  //   var year = date_input.getFullYear();
  //   $('#text-tanggal_kegiatan').text(day+", "+date+" "+month+" "+year);
  //   $('#text-nama_kegiatan').text(nama);
  //   // $('#text-tanggal_kegiatan').text(tanggal);
  //   $('#listModal').modal('show');
    
  // });

</script>

</body>
</html>
