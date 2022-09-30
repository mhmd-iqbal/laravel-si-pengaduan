@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header d-flex justify-content-between">
        <h1>Pengaduan</h1>
        @if (auth()->user()->level == 'user')
          <a href="/pengaduan/create" class="btn btn-success rounded-pill has-icon"><i class="fas fa-plus-circle mr-1"></i>
            Buat
            Pengaduan</a>
        @endif
      </div>

      @if (session()->has('message'))
        <div class="row">
          <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              {{ session('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
      @endif

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Aduan</h4>
              <div class="card-header-action">
                <a href="/pengaduan" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table table-striped" id="table-pengaduan">
                  <thead>
                    <tr class="text-center">
                      <th>No. Pengaduan</th>
                      <th>Judul</th>
                      <th>Nama Pengirim</th>
                      <th>Kategori</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      @if (auth()->user()->level == 'teknisi' || auth()->user()->level == 'user')
                        <th>Aksi</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @if ($pengaduan->count() > 0)
                      @foreach ($pengaduan as $p)
                        <tr>
                          <td>{{ $p->no_pengaduan }}</td>
                          <td class="font-weight-600"><a
                              href="/pengaduan/{{ $p->no_pengaduan }}">{{ $p->judul }}</a>
                          </td>
                          <td class="font-weight-600">{{ $p->user->name ?? '-' }}</td>
                          <td class="font-weight-600">{{ $p->kategori->nama_kategori }}</td>

                          <td>
                            <div
                              class="badge @if ($p->status == 'Menunggu konfirmasi') badge-warning @elseif ($p->status == 'Diproses') badge-info @elseif ($p->status == 'Selesai') badge-success @else badge-danger @endif">
                              {{ $p->status }}</div>
                          </td>
                          <td>{{ $p->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                          @if (auth()->user()->level == 'teknisi' || auth()->user()->level == 'user')
                            <td class="text-center d-flex">
                              @if ($p->status != 'Selesai' && $p->user_id == auth()->user()->id)
                                <form action="/pengaduan/{{ $p->no_pengaduan }}/selesai" method="post">
                                  @method('put')
                                  @csrf
                                  <button type="submit" class="btn btn-success m-1" title="Ubah status menjadi 'Selesai'"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah status dari data pengaduan ini?')"><i
                                      class="fas fa-check"></i></button>
                                </form>
                              @endif
                              @if (auth()->user()->level == 'teknisi')
                                <a href="/pengaduan/{{ $p->no_pengaduan }}/edit" class="btn btn-dark m-1"><i
                                    class="fas fa-magnifying-glass"></i></a>
                              @endif
                              @if ((auth()->user()->level == 'user' && $p->user_id == auth()->user()->id) || auth()->user()->level == 'teknisi')
                                <form action="/pengaduan/{{ $p->no_pengaduan }}" method="post">
                                  @method('delete')
                                  @csrf
                                  <button type="submit" class="btn btn-danger m-1"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                      class="fas fa-trash-alt"></i></button>
                                </form>
                              @endif
                            </td>
                          @endif
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td class="text-center font-weight-bold" colspan="7">Anda belum membuat aduan</td>
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
      $('#table-pengaduan').dataTable({
        "ordering": false
      });
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
