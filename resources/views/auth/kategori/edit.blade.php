@extends('layouts.auth')
<!-- Main Content -->
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header d-flex justify-content-between">
        <h1>Kategori</h1>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Edit Kategori</h4>
              <div class="card-header-action">
                <a href="/kategori" class="btn btn-danger"><i class="fas fa-chevron-left"></i> Kembali</a>
              </div>
            </div>
            <div class="card-body pb-0">
              <form action="/kategori/{{ $kategori->id }}" method="post">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="nama_kategori" class="form-label">Nama Kategori</label>
                  <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                    name="nama_kategori" placeholder="Alat Elektronik"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" autocomplete="off">
                  @error('nama_kategori')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="slug" class="form-label">Slug</label>
                  <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                    placeholder="alat-elektronik" value="{{ old('slug', $kategori->slug) }}" autocomplete="off">
                  <small class="text-muted">Penulisan slug harus dengan huruf kecil dan dipisahkan dengan tanda strip
                    (-)</small>
                  @error('slug')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success mr-2">Simpan</button>
                  <button type="reset" class="btn btn-outline-danger">Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
