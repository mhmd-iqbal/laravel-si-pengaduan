@extends('layouts.guest')
<main>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <a href="/" style="letter-spacing: 2px;" class="h4">{{ env('APP_NAME') }}</a>
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>{{ $title }}</h4>
              </div>

              <div class="card-body">
                <form method="POST">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="name">Fullname</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        autofocus>
                      @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="username">User Name</label>
                      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                        name="username">
                      @error('username')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email">
                      @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="password">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password">
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      <div class="form-check form-check-inline my-2">
                        <input type="checkbox" class="form-check-input" id="togglePassword">
                        <label for="togglePassword" class="form-check-label">Show Password</label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>

                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill" style="width: 200px;">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Already have an account? <a href="/auth/login">Login Now</a>
            </div>
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
@endsection
