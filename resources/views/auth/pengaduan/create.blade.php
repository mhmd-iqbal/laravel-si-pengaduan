@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pengaduan</h1>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Buat Aduan</h4>
            </div>
            <div class="card-body p-4">
              <form action="/pengaduan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-4 col-md-4 mb-3">
                    <label for="tgl_pengaduan">Tanggal</label>
                    <input type="text" class="form-control" style="cursor: default;" id="tgl_pengaduan"
                      name="tgl_pengaduan" value="{{ date('d-m-Y') }}" readonly>
                  </div>
                  <div class="col-sm-4 col-md-4 mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" style="cursor: default;"
                      value="{{ auth()->user()->name }}" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-8 mb-3">
                    <label for="judul">Judul Pengaduan</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                    @error('judul')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 col-md-4 mb-3">
                    <label for="kategori_id">Kategori ID</label>
                    <select class="form-control" id="kategori_id" name="kategori_id" style="cursor: pointer;">
                      @if ($kategori->count() > 0)
                        <option value="" selected disabled>Pilih opsi</option>
                        @foreach ($kategori as $k)
                          <option value="{{ $k->id }}">{{ $k->id }} - {{ $k->nama_kategori }}</option>
                        @endforeach
                      @else
                        <option value="" selected disabled>Tidak ada data</option>
                      @endif
                    </select>
                    @error('kategori_id')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 col-md-4 mb-3">
                    <label for="gambar">Foto/Gambar</label>
                    <img class="img-preview img-fluid mb-3 col-8">
                    <input type="file" name="gambar" id="gambar" accept=".png, .jpg, .jpeg" class="form-control-file"
                      onchange="previewImage()">
                    @error('gambar')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
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

    function previewImage() {
      const image = document.querySelector('#gambar');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(e) {
        imgPreview.src = e.target.result;
      }
    }
  </script>
@endsection
