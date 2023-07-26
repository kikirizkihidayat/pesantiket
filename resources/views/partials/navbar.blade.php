<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
      <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-ticket-alt"></i>
      </div>
      <div class="sidebar-brand-text mx-3">psnTiket</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
  </li>

  <li class="nav-item {{ Request::is('tikets') ? 'active' : '' }}">
      <a class="nav-link" href="/tikets">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Daftar Tiket</span></a>
  </li>

  <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
      <a class="nav-link" href="/users">
          <i class="fas fa-fw fa-users"></i>
          <span>Daftar Pengguna</span></a>
  </li>
  
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>


</ul>