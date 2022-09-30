<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">{{ env('APP_NAME') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">SP</a>
    </div>
    <ul class="sidebar-menu">
      <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a href="/dashboard" class="nav-link"><i class="fas fa-fire mx-2"></i><span>Dashboard</span></a>
      </li>
      <li class="nav-item dropdown {{ Request::is('pengaduan*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-bell mx-2"></i> <span>Pengaduan</span></a>
        <ul class="dropdown-menu">
          <li class="{{ Request::is('pengaduan') ? 'active' : '' }}"><a class="nav-link" href="/pengaduan"><i
                class="fas fa-list mx-2"></i> Daftar Pengaduan</a></li>
          @if (auth()->user()->level == 'user')
            <li class="{{ Request::is('pengaduan/create') ? 'active' : '' }}"><a class="nav-link"
                href="/pengaduan/create"><i class="fas fa-plus-circle mx-2"></i> Buat Pengaduan</a></li>
          @endif
        </ul>
      </li>
      @if (auth()->user()->level == 'admin')
        <li class="menu-header">Admin</li>
        <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
          <a href="/users" class="nav-link"><i class="fas fa-users mx-2"></i><span>User</span></a>
        </li>
        <li class="nav-item {{ Request::is('kategori*') ? 'active' : '' }}">
          <a href="/kategori" class="nav-link"><i class="fas fa-object-group mx-2"></i><span>Kategori</span></a>
        </li>
      @endif

      @if (auth()->user()->level == 'teknisi')
        <li class="menu-header">Teknisi</li>
        <li class="nav-item dropdown {{ Request::is('permohonan*') ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-hands-holding mx-2"></i>
            <span>Permohonan</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::is('permohonan-saya') ? 'active' : '' }}"><a class="nav-link"
                href="/permohonan-saya"><i class="fas fa-list mx-2"></i> Permohonan Saya</a></li>
            <li class="{{ Request::is('permohonan/create') ? 'active' : '' }}"><a class="nav-link"
                href="/permohonan/create"><i class="fas fa-plus-circle mx-2"></i> Buat Permohonan</a></li>
          </ul>
        </li>
      @endif

      @if (auth()->user()->level == 'aset')
        <li class="menu-header">Petugas Aset</li>
        <li class="nav-item {{ Request::is('permohonan') ? 'active' : '' }}">
          <a href="/permohonan" class="nav-link"><i class="fas fa-list mx-2"></i><span>Daftar
              Permohonan</span></a>
        </li>
      @endif

    </ul>

    {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="https://wa.me/62895323755721" class="btn btn-success btn-lg btn-block btn-icon-split rounded-pill"
        target="_blank">
        <i class="fab fa-whatsapp mr-1"></i> WhatsApp
      </a>
    </div> --}}
  </aside>
</div>
