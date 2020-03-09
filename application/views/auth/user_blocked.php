<div id="content">
  <div class="container-fluid">
     <!-- 404 Error Text -->
          <div class="text-center">
            <div class="error mx-auto mt-5" data-text="403">403</div>
            <p class="lead text-gray-800 mb-5">Your Access Has Blocked</p>
            <?php if($this->session->userdata('id_role') == 1){
              $role = "admin";
            }elseif($this->session->userdata('id_role') == 2){
              $role = "perusahaan";
            }elseif ($this->session->userdata('id_role') == 3) {
              $role = "karyawan";
            }
             ?>
            <a href="<?= site_url($role) ?>">&larr; Back to Dashboard</a>
          </div>
        <!-- /.container-fluid -->
  </div>
</div>

