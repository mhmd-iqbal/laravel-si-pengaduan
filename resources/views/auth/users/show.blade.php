@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header d-flex justify-content-between">
        <h1>User Management</h1>
        @if (auth()->user()->level == 'user')
          <a href="/users/create" class="btn btn-success rounded-pill has-icon"><i class="fas fa-plus-circle mr-1"></i>
            Tambah User</a>
        @endif
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Detail User w/ ID : {{ $data->id }}</h4>
              <div class="card-header-action">
                <a href="/users" class="btn btn-danger"><i class="fas fa-chevron-left mr-1"></i>Kembali</a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped mb-0">
                  <tbody>
                    <tr>
                      <td width="150">ID User : <strong>{{ $data->id }}</strong></td>
                      <td class="text-right">Dibuat pada :
                        {{ $data->created_at->isoFormat('dddd, D MMMM Y - hh:mm:ss') }}</td>
                    </tr>
                    <tr>
                      <td>Nama User</td>
                      <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                      <td>Username</td>
                      <td>{{ $data->username }}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                      <td>Level</td>
                      <td>{{ $data->level }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
