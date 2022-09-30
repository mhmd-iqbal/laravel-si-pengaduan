@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header d-flex justify-content-between">
        <h1>Permohonan</h1>
        @if (auth()->user()->level == 'teknisi')
          <a href="/permohonan/create" class="btn btn-success rounded-pill has-icon"><i class="fas fa-plus-circle mr-1"></i>
            Buat
            Permohonan</a>
        @endif

      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Detail Data Permohonan ID : {{ $data->no_permohonan }}</h4>
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
                      <td>No. Permohonan : <br /><strong>{{ $data->no_permohonan }}</strong>
                      </td>
                      <td class="text-right">Dibuat pada : {{ $data->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                    </tr>
                    <tr>
                      <td>Nama Teknisi</td>
                      <td>{{ $data->user->name }}</td>
                    </tr>
                    <tr>
                      <td>Judul</td>
                      <td>{{ $data->judul }}</td>
                    </tr>
                    <tr>
                      <td>Kategori</td>
                      <td>{{ $data->pengaduan->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                      <td>Isi</td>
                      <td>{!! $data->isi !!}</td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>
                        <div
                          class="badge @if ($data->status == 'Menunggu tanggapan') badge-warning @elseif ($data->status == 'Barang ada') badge-success @elseif ($data->status == 'Barang tidak ada') badge-danger @endif">
                          {{ $data->status }}
                        </div>
                      </td>
                    </tr>
                    @if ($data->status != 'Menunggu tanggapan')
                      <tr>
                        <td>{{ $data->status == 'Barang tidak ada' ? 'Alasan' : 'Tanggapan' }}</td>
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
@endsection
