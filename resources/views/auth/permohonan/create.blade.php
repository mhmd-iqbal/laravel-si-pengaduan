@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Permohonan</h1>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Buat Permohonan</h4>
            </div>
            <div class="card-body p-4">
              <form action="/permohonan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-4 col-md-4 mb-3">
                    <label for="tgl_permohonan">Tanggal</label>
                    <input type="text" class="form-control" style="cursor: default;" id="tgl_permohonan"
                      name="tgl_permohonan" value="{{ date('d-m-Y') }}" readonly>
                  </div>
                  <div class="col-sm-4 col-md-4 mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" style="cursor: default;"
                      value="{{ auth()->user()->name }}" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-6 mb-3">
                    <label for="judul">Judul Permohonan</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                    @error('judul')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 col-md-6 mb-3">
                    <label for="kode_pengaduan">Kode Pengaduan</label>
                    <select class="form-control" id="kode_pengaduan" name="kode_pengaduan" style="cursor: pointer;">
                      @if ($pengaduan->count() > 0)
                        <option value="" selected disabled>Pilih kode pengaduan</option>
                        @foreach ($pengaduan as $p)
                          <option value="{{ $p->no_pengaduan }}"
                            {{ old('kode_pengaduan') == $p->no_pengaduan ? 'selected' : '' }}>{{ $p->no_pengaduan }} |
                            {{ $p->judul }}</option>
                        @endforeach
                      @else
                        <option value="" selected disabled>Tidak ada data pengaduan</option>
                      @endif
                    </select>
                    @error('kode_pengaduan')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 mb-3">
                    <label for="isi">Isi</label>
                    <input id="isi" value="{{ old('isi') }}" type="hidden" name="isi">
                    <trix-editor input="isi" class="trix-content"></trix-editor>
                    @error('isi')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row justify-content-center align-items-center">
                  <button type="reset" class="btn btn-lg btn-outline-danger text-uppercase rounded-pill mr-3"
                    style="letter-spacing: 2px;">Reset</button>
                  <button type="submit" class="btn btn-lg btn-primary text-uppercase rounded-pill"
                    style="letter-spacing: 2px;"><i class="fas fa-message mr-1"></i> Kirim</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('scripts')
  <script>
    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    })
  </script>
@endsection
