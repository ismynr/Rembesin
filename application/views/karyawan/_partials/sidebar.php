<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-receipt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Karyawan</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item" id="sidebar_menu_dashboard">
        <a class="nav-link" href="<?= site_url('karyawan') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="sidebar-heading">Kelola Kegiatan</div>
      <li class="nav-item" id="sidebar_menu_ajukanKegiatan">
        <a class="nav-link" href="<?= site_url('karyawan/kegiatan/ajukan') ?>">
          <i class="fas fa-plus-circle"></i>
          <span>Ajukan Kegiatan</span></a>
      </li>
      <li class="nav-item" id="sidebar_menu_dataKegiatan">
        <a class="nav-link" href="<?= site_url('karyawan/kegiatan') ?>">
          <i class="fas fa-clipboard"></i>
          <span>Data Kegiatan</span></a>
      </li>

<!--       <hr class="sidebar-divider">
      <div class="sidebar-heading">Data Rembes</div>
      
      <li class="nav-item" id="sidebar_menu_notaRembes">
        <a class="nav-link" href="<?= site_url('karyawan/rembes') ?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Nota Rembes</span></a>
      </li>
 -->

      <hr class="sidebar-divider">
      <div class="sidebar-heading">Pengajuan</div>
    
      <li class="nav-item" id="sidebar_menu_dataRembesin">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_menu" aria-expanded="true" aria-controls="collapse_menu">
          <i class="fas fa-server"></i>
          <span>Data Rembes</span>
        </a>
        <div id="collapse_menu" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" id="menu_unclaimed" href="<?= site_url('karyawan/lap_dataRembes/unclaimed') ?>">Unclaimed</a>
            <a class="collapse-item" id="menu_claimed" href="<?= site_url('karyawan/lap_dataRembes/claimed') ?>">Claimed</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->