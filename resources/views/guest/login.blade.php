@extends('layouts.guest')
<main>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <a href="/" style="letter-spacing: 2px;" class="h4">{{ env('APP_NAME') }}</a>
            </div>
            @if (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('failed') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            <div class="card card-primary">
              <div class="card-header">
                <h4>{{ $title }}</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="/auth/login">
                  @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus value="{{ old('username') }}" autocomplete="off">
                    @error('username')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-check form-check-inline my-2">
                      <input type="checkbox" class="form-check-input" id="togglePassword">
                      <label for="togglePassword" class="form-check-label">Show Password</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block rounded-pill" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="/auth/register">Create One</a>
            </div> -->
            <div class="simple-footer">
              Copyright &copy; QHOMEMART {{ date('Y') }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

@section('scripts')
<script>
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

  togglePassword.addEventListener("change", function() {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
  });
</script>

@if (session()->has('message'))
<script>
  $(document).ready(function() {
    toastr.options = {
      "closeButton": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    };

    toastr["success"]("Logout successfully");
  });
</script>
@endif
@endsection