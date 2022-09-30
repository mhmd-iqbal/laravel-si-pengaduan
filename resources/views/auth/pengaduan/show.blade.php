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

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Detail Data Aduan ID : {{ $data->no_pengaduan }}</h4>
              <div class="card-header-action">
                <button onclick="history.back()" class="btn btn-danger"><i
                    class="fas fa-chevron-left mr-1"></i>Kembali</button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped mb-0">
                  <tbody>
                    <tr>
                      <td>No. Pengaduan : <strong>{{ $data->no_pengaduan }}</strong></td>
                      <td class="text-right">Dibuat pada : {{ $data->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                    </tr>
                    <tr>
                      <td>Nama Pengirim</td>
                      <td>{{ $data->user->name }}</td>
                    </tr>
                    <tr>
                      <td>Judul</td>
                      <td>{{ $data->judul }}</td>
                    </tr>
                    <tr>
                      <td>Kategori</td>
                      <td>{{ $data->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                      <td>Isi</td>
                      <td>{!! $data->isi !!}</td>
                    </tr>
                    <tr>
                      <td>Gambar</td>
                      @isset($data->gambar)
                        <td class="py-2"><img src="{{ asset('storage/' . $data->gambar) }}" class="img-fluid rounded"
                            style="cursor: pointer;" alt="" width="200" data-toggle="modal"
                            data-target="#imageModal"></td>
                      @else
                        <td class="text-danger">Tidak ada gambar</td>
                      @endisset
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>
                        <div
                          class="badge @if ($data->status == 'Menunggu konfirmasi') badge-warning @elseif ($data->status == 'Diproses') badge-info @elseif ($data->status == 'Selesai') badge-success @else badge-danger @endif">
                          {{ $data->status }}
                        </div>
                      </td>
                    </tr>
                    @if ($data->status != 'Menunggu konfirmasi')
                      <tr>
                        <td>{{ $data->status == 'Ditolak' ? 'Alasan' : 'Tanggapan Admin' }}</td>
                        <td><strong>{!! $data->tanggapan !!}</strong></td>
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

  @isset($data->gambar)
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel">Detail Gambar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img src="{{ asset('storage/' . $data->gambar) }}" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  @endisset
@endsection
