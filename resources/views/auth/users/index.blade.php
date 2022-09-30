@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header d-flex justify-content-between">
        <h1>User Management</h1>
        <a href="/users/create" class="btn btn-success rounded-pill has-icon"><i class="fas fa-plus-circle mr-1"></i>
          Tambah User</a>
      </div>

      <div class="row">
        @if (session()->has('message'))
          <div class="col-3">
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
              {{ session('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        @endif
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar User</h4>
              <div class="card-header-action">
                <a href="/users" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table table-striped" id="table-user">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Username</th>
                      <th>Nama User</th>
                      <th>Tanggal Daftar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($users->count() > 0)
                      @foreach ($users as $user)
                        <tr class="text-center">
                          <td>{{ $user->id }}</td>
                          <td class="font-weight-600"><a href="/users/{{ $user->username }}">{{ $user->username }}</a>
                          </td>
                          <td class="font-weight-600">{{ $user->name ?? '-' }}</td>
                          <td>{{ $user->created_at->isoFormat('dddd, D MMMM Y - hh:mm:s') }}</td>
                          <td class="text-center">
                            <form action="/users/{{ $user->username }}" method="POST">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger m-1"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                  class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td class="text-center font-weight-bold" colspan="7">Tidak ada data user</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Admin</h4>
              <div class="card-header-action">
                <a href="/users" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table table-striped" id="table-admin">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Username</th>
                      <th>Nama Admin</th>
                      <th>Tanggal Daftar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($admins->count() > 0)
                      @foreach ($admins as $admin)
                        <tr class="text-center">
                          <td>{{ $admin->id }}</td>
                          <td class="font-weight-600"><a
                              href="/users/{{ $admin->username }}">{{ $admin->username }}</a>
                          </td>
                          <td class="font-weight-600">{{ $admin->name ?? '-' }}</td>
                          <td>{{ $admin->created_at->isoFormat('dddd, D MMMM Y - hh:mm:s') }}</td>
                          <td class="text-center">
                            <form action="/users/{{ $admin->username }}" method="POST">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger m-1"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                  class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td class="text-center font-weight-bold" colspan="7">Tidak ada data petugas admin</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Petugas Teknisi</h4>
              <div class="card-header-action">
                <a href="/users" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table table-striped" id="table-teknisi">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Username</th>
                      <th>Nama Teknisi</th>
                      <th>Tanggal Daftar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($teknisis->count() > 0)
                      @foreach ($teknisis as $teknisi)
                        <tr class="text-center">
                          <td>{{ $teknisi->id }}</td>
                          <td class="font-weight-600"><a
                              href="/users/{{ $teknisi->username }}">{{ $teknisi->username }}</a>
                          </td>
                          <td class="font-weight-600">{{ $teknisi->name ?? '-' }}</td>
                          <td>{{ $teknisi->created_at->isoFormat('dddd, D MMMM Y - hh:mm:s') }}</td>
                          <td class="text-center">
                            <form action="/users/{{ $teknisi->username }}" method="POST">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger m-1"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                  class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td class="text-center font-weight-bold" colspan="7">Tidak ada data petugas teknisi</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Petugas Aset</h4>
              <div class="card-header-action">
                <a href="/users" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table table-striped" id="table-aset">
                  <thead>
                    <tr class="text-center">
                      <th>ID</th>
                      <th>Username</th>
                      <th>Nama Petugas</th>
                      <th>Tanggal Daftar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($asets->count() > 0)
                      @foreach ($asets as $aset)
                        <tr class="text-center">
                          <td>{{ $aset->id }}</td>
                          <td class="font-weight-600"><a
                              href="/users/{{ $aset->username }}">{{ $aset->username }}</a>
                          </td>
                          <td class="font-weight-600">{{ $aset->name ?? '-' }}</td>
                          <td>{{ $aset->created_at->isoFormat('dddd, D MMMM Y - hh:mm:s') }}</td>
                          <td class="text-center">
                            <form action="/users/{{ $aset->username }}" method="POST">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger m-1"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                  class="fas fa-trash-alt"></i></button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td class="text-center font-weight-bold" colspan="7">Tidak ada data petugas aset</td>
                      </tr>
                    @endif
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

@section('scripts')
  <script>
    $(document).ready(function() {
      $('#table-user').dataTable();
      $('#table-admin').dataTable();
      $('#table-teknisi').dataTable();
      $('#table-aset').dataTable();
    })
  </script>
  @if (session()->has('delete'))
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

        toastr["success"]("Data berhasil dihapus!");
      });
    </script>
  @endif
@endsection
