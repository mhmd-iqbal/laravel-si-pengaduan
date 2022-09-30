@extends('layouts.auth')
<!-- Main Content -->
@section('content')
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row sortable-card">
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Total Aduan</h4>
          </div>
          <div class="card-body">
            <p class="h2">{{ $pengaduan->count() }}</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="card card-secondary">
          <div class="card-header">
            <h4>Menunggu Konfirmasi</h4>
          </div>
          <div class="card-body">
            <p class="h2">{{ $pengaduan->where('status', 'Menunggu konfirmasi')->count() }}</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="card card-success">
          <div class="card-header">
            <h4>Aduan Selesai</h4>
          </div>
          <div class="card-body">
            <p class="h2">{{ $pengaduan->where('status', 'Selesai')->count() }}</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="card card-warning">
          <div class="card-header">
            <h4>Total User</h4>
          </div>
          <div class="card-body">
            <p class="h2">{{ $users ?? '0' }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Aduan</h4>
            <div class="card-header-action">
              <a href="#" class="btn btn-danger">Refresh <i class="fas fa-refresh"></i></a>
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
                @if ($pengaduan->count() > 0)
                @foreach ($pengaduan as $p)
                <tbody>
                  <tr>
                    <td>{{ $p->no_pengaduan }}</td>
                    <td class="font-weight-600"><a href="/pengaduan/{{ $p->no_pengaduan }}">{{ $p->judul }}</a>
                    </td>
                    <td class="font-weight-600">{{ $p->user->name ?? '-' }}</td>
                    <td class="font-weight-600">{{ $p->kategori->nama_kategori }}</td>

                    <td>
                      <div class="badge @if ($p->status == 'Menunggu konfirmasi') badge-warning @elseif ($p->status == 'Diproses') badge-info @elseif ($p->status == 'Selesai') badge-success @else badge-danger @endif">
                        {{ $p->status }}
                      </div>
                    </td>
                    <td>{{ $p->created_at->isoFormat('dddd, D MMMM Y - hh:mm:ss') }}</td>
                    @if (auth()->user()->level == 'teknisi' || auth()->user()->level == 'user')
                    <td class="text-center">
                      @if (auth()->user()->level == 'teknisi')
                      <a href="/pengaduan/{{ $p->no_pengaduan }}/edit" class="btn btn-dark m-1"><i class="fas fa-magnifying-glass"></i></a>
                      @endif

                      @if ((auth()->user()->level == 'user' && $p->user_id == auth()->user()->id) || auth()->user()->level == 'teknisi')
                      <form action="/pengaduan/{{ $p->no_pengaduan }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger m-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></button>
                      </form>
                      @endif
                    </td>
                    @endif
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td class="text-center font-weight-bold" colspan="7">Tidak ada data pengaduan</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-hero">
          <div class="card-header">
            <div class="card-icon">
              <i class="far fa-question-circle"></i>
            </div>
            <h4>{{ $pengaduan->where('status', 'Menunggu konfirmasi')->count() }}</h4>
            <div class="card-description">Pengaduan menunggu konfirmasi</div>
          </div>
          <div class="card-body p-0">
            <div class="tickets-list">
              @foreach ($pengaduan_limit as $p)
              @if ($p->count() > 0)
              <a href="/pengaduan/{{ $p->no_pengaduan }}" class="ticket-item">
                <div class="ticket-title">
                  <h4>{{ $p->judul }}</h4>
                </div>
                <div class="ticket-info">
                  <div>{{ $p->user->name ?? '' }}</div>
                  <div class="bullet"></div>
                  <div class="text-muted">{{ $p->created_at->isoFormat('D/MMMM/Y - hh:mm:ss') }}</div>
                </div>
              </a>
              @else
              <div class="ticket-title">
                <h4>Belum ada data pengaduan yang menunggu konfirmasi</h4>
              </div>
              @endif
              @endforeach
              <a href="/pengaduan" class="ticket-item ticket-more">
                View All <i class="fas fa-chevron-right"></i>
              </a>
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
    $('#table-pengaduan').dataTable();
  })
</script>
@endsection