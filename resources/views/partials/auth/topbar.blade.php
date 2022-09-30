<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
            </li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('assets/template/img/avatar/avatar-1.png') }}"
                class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              @if (auth()->user()->level == 'user')
                <a href="/pengaduan-saya" class="dropdown-item has-icon">
                  <i class="far fa-bell mr-1"></i> Aduan Saya
                </a>
                <div class="dropdown-divider"></div>
              @endif
              <form action="/auth/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item has-icon text-danger has-icon"
                  onclick="return confirm('Are you sure you want to logout?')">
                  <i class="fas fa-sign-out-alt mr-1"></i>
                  Logout
                </button>
              </form>
            </div>
          </li>
        </ul>
      </nav>
