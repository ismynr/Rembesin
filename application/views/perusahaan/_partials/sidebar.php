<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-receipt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Perusahaan</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item" id="sidebar_menu_dashboard">
        <a class="nav-link" href="<?= site_url ('perusahaan') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


       <!-- Nav Item - tambah kayawn -->
      <li class="nav-item" id="sidebar_menu_formTambahKaryawan">
        <a class="nav-link" href="<?= site_url ('perusahaan/form_tambah_karyawan' )?>">
          <i class="fas fa-plus-circle"></i>
          <span>Tambah Karyawan</span></a>
      </li>

      <!-- Nav Item - data karyawan -->
      <li class="nav-item" id="sidebar_menu_dataKaryawan">
        <a class="nav-link" href="<?= site_url ('perusahaan/data_karyawan' )?>">
          <i class="fas fa-user-tie"></i>
          <span>Data Karyawan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider mt-3">
      <div class="sidebar-heading">Unclaimed</div>
      <!-- Nav Item - klaim rembes -->
      <li class="nav-item" id="sidebar_menu_klaimRembes">
        <a class="nav-link" href="<?= site_url ('perusahaan/klaim_rembes' )?>">
          <i class="fas fa-clipboard"></i>
          <span>Klaim Rembes</span></a>
      </li>

       <!-- Nav Item - data reebes -->
      <li class="nav-item bg-warning font-weight-bold" id="sidebar_menu_urgent">
        <a class="nav-link" href="<?= site_url ('perusahaan/urgent' )?>">
          <i class="fas fa-exclamation-triangle"></i>
          <span>Urgent Klaim</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider mt-3">
      <div class="sidebar-heading">Claimed</div>
       <!-- Nav Item - data reebes -->
      <li class="nav-item" id="sidebar_menu_dataRembes">
        <a class="nav-link" href="<?= site_url ('perusahaan/data_rembes' )?>">
          <i class="fas fa-clipboard-check"></i>
          <span>Data Rembes</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->