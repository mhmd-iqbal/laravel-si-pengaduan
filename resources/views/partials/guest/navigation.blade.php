<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#" style="letter-spacing: 2px;"><img src="{{ asset('assets/images/logo.jpg') }}" alt="logo qhome" height="40"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto mb-2 mb-md-0 text-center">
          <li class="nav-item me-2">
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
          </li>
          <!-- <li class="nav-item me-2">
            <a class="nav-link" href="#">Tentang Kami</a>
          </li> -->
          <li class="nav-item me-2">
            @auth
            @if (auth()->user()->level == 'admin')
            <a class="btn btn-outline-primary px-4 rounded-pill" href="/admin/dashboard">Dashboard</a>
            @else
            <a class="btn btn-outline-primary px-4 rounded-pill" href="/admin/dashboard">Dashboard</a>
            @endif
            @else
            <a class="btn btn-outline-primary px-4 rounded-pill" href="/auth/login">Login</a>
            @endauth
          </li>
          </li>
        </ul>
      </div>
    </div>
  </nav>