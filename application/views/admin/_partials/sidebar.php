<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-receipt"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Admin </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item" id="sidebar_menu_dashboard">
        <a class="nav-link" href="<?= site_url('admin') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Charts -->
      <li class="nav-item" id="sidebar_menu_newRegist">
        <a class="nav-link" href="<?= site_url('admin/new_regist') ?>">
          <i class="fas fa-newspaper"></i>
          <span>New Regist</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item" id="sidebar_menu_perusahaan">
        <a class="nav-link" href="<?= site_url('admin/perusahaan') ?>">
          <i class="fas fa-building"></i>
          <span>Perusahaan</span></a>
      </li>

      <li class="nav-item" id="sidebar_menu_dataMaster">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_menu" aria-expanded="true" aria-controls="collapse_menu">
          <i class="fas fa-server"></i>
          <span>Master Data</span>
        </a>
        <div id="collapse_menu" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" id="menu_ji" href="<?= site_url('admin/jenis_identitas') ?>">Jenis Identitas</a>
            <a class="collapse-item" id="menu_jn" href="<?= site_url('admin/jenis_nota') ?>">Jenis Nota</a>
            <a class="collapse-item" id="menu_jb" href="<?= site_url('admin/jenis_bank') ?>">Jenis Bank</a>
          </div>
        </div>
      </li>

      <li class="nav-item" id="sidebar_menu_setting">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_menu_setting" aria-expanded="true" aria-controls="collapse_menu_setting">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Pengaturan</span>
        </a>
        <div id="collapse_menu_setting" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" id="menu_g" href="<?= site_url('admin/pengaturan/general') ?>">General</a>
            <a class="collapse-item" id="menu_ek" href="<?= site_url('admin/pengaturan/email_kontak') ?>">Email Kontak</a>
          </div>
        </div>
      </li>
      
      <hr class="sidebar-divider my-0 mt-3">
       <li class="nav-item bg-danger" id="sidebar_menu_trash">
        <a class="nav-link" href="<?= site_url('admin/trash') ?>">
          <i class="fas fa-trash"></i>
          <span>Trash</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->