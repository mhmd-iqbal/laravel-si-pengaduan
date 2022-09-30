@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header d-flex justify-content-between">
        <h1>Permohonan Saya</h1>
        @if (auth()->user()->level == 'teknisi')
          <a href="/permohonan/create" class="btn btn-success rounded-pill has-icon"><i class="fas fa-plus-circle mr-1"></i>
            Buat
            Permohonan</a>
        @endif
      </div>

      @if (session()->has('message'))
        <div class="row">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      @endif

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Permohonan</h4>
              @if (auth()->user()->level != 'aset')
                <div class="card-header-action">
                  <a href="/permohonan-saya" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
                </div>
              @else
                <div class="card-header-action">
                  <a href="/permohonan" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
                </div>
              @endif
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table table-striped" id="table-permohonan">
                  <thead>
                    <tr class="text-center">
                      <th>No. Permohonan</th>
                      <th>Kode Pengaduan</th>
                      <th>Judul</th>
                      <th>Nama Pemohon</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($permohonan->count() > 0)
                      @foreach ($permohonan as $p)
                        <tr>
                          <td>{{ $p->no_permohonan }}</td>
                          <td class="font-weight-600"><a
                              href="/pengaduan/{{ $p->kode_pengaduan }}">{{ $p->kode_pengaduan }}</a>
                          </td>
                          <td class="font-weight-600"><a
                              href="/permohonan/{{ $p->no_permohonan }}">{{ $p->judul }}</a>
                          </td>
                          <td class="font-weight-600">{{ $p->user->name ?? '-' }}</td>

                          <td>
                            <div
                              class="badge @if ($p->status == 'Menunggu tanggapan') badge-warning @elseif ($p->status == 'Barang ada') badge-success @elseif ($p->status == 'Barang tidak ada') badge-danger @endif">
                              {{ $p->status }}</div>
                          </td>
                          <td>{{ $p->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                          <td class="text-center">
                            @if (auth()->user()->level == 'aset')
                              <a href="/permohonan/{{ $p->no_permohonan }}/edit" class="btn btn-dark m-1"><i
                                  class="fas fa-magnifying-glass"></i></a>
                            @endif

                            @if ((auth()->user()->level == 'teknisi' && $p->user_id == auth()->user()->id) || auth()->user()->level == 'aset')
                              <form action="/permohonan/{{ $p->no_permohonan }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger m-1"
                                  onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                    class="fas fa-trash-alt"></i></button>
                              </form>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td class="text-center font-weight-bold" colspan="7">Anda belum membuat permohonan</td>
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
      $('#table-permohonan').dataTable({
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
  @elseif (session()->has('success'))
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

        toastr["success"]("Data berhasil disimpan!");
      });
    </script>
  @endif
@endsection
