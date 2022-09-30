@extends('layouts.guest')
<!-- ======= Hero Section ======= -->
<main id="hero">
  <div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6 mx-auto">
        <img src="{{ asset('assets/template/img/AppLandingPage.png') }}" class="d-block mx-lg-auto img-fluid"
          alt="Landing Page Image">
      </div>
      <div class="col-lg-6">
        <h1 class="display-6 fw-bold lh-1 mb-3">{{ env('APP_NAME') }}</h1>
        <p class="lead text-muted">Ajukan dan lacak status pengaduan barang dengan mudah dan cepat.
        </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a href="/auth/login" class="btn btn-sm btn-primary btn-lg px-3 py-3 me-md-2 rounded-pill fw-bold shadow"><i
              class="fas fa-magnifying-glass me-2"></i>
            Cek Status Pengaduan</a>
        </div>
      </div>
    </div>
  </div>
</main>
