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
              <h4>Detail Data Permohonan ID : {{ $permohonan->no_permohonan }}</h4>
              <div class="card-header-action">
                <button onclick="history.back()" class="btn btn-danger"><i
                    class="fas fa-chevron-left mr-1"></i>Kembali</button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <form action="/permohonan/{{ $permohonan->no_permohonan }}" method="post">
                  @method('put')
                  @csrf
                  <table class="table table-striped mb-0">
                    <tbody>
                      <tr>
                        <td>No. Permohonan : <br /><strong>{{ $permohonan->no_permohonan }}</strong>
                        </td>
                        <td class="text-right">Dibuat pada :
                          {{ $permohonan->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                      </tr>
                      <tr>
                        <td>Kode Pengaduan</td>
                        <td><a
                            href="/pengaduan/{{ $permohonan->pengaduan->no_pengaduan }}"><strong>{{ $permohonan->pengaduan->no_pengaduan }}</strong></a>
                        </td>
                      </tr>
                      <tr>
                        <td>Nama Pengirim</td>
                        <td>{{ $permohonan->user->name }}</td>
                      </tr>
                      <tr>
                        <td>Judul</td>
                        <td>{{ $permohonan->judul }}</td>
                      </tr>
                      <tr>
                        <td>Kategori</td>
                        <td>{{ $permohonan->pengaduan->kategori->nama_kategori }}</td>
                      </tr>
                      <tr>
                        <td>Isi</td>
                        <td>{!! $permohonan->isi !!}</td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>
                          <select name="status" id="status" class="form-control w-auto">
                            <option value="Menunggu tanggapan"
                              {{ $permohonan->status == 'Menunggu tanggapan' ? 'selected' : '' }}>Menunggu tanggapan
                            </option>
                            <option value="Barang ada" {{ $permohonan->status == 'Barang ada' ? 'selected' : '' }}>
                              Barang ada
                            </option>
                            <option value="Barang tidak ada"
                              {{ $permohonan->status == 'Barang tidak ada' ? 'selected' : '' }}>Barang tidak ada
                            </option>
                          </select>
                          @error('status')
                            <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </td>
                      </tr>
                      <tr id="col-tanggapan">
                        <td>Tanggapan</td>
                        <td class="py-2">
                          <input id="tanggapan" value="{{ old('tanggapan', $permohonan->tanggapan) }}" type="hidden"
                            name="tanggapan">
                          <trix-editor input="tanggapan" class="trix-content">
                          </trix-editor>
                          @error('tanggapan')
                            <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <div class="row justify-content-end">
                            <div class="col-4 col-md-3 mb-2">
                              <button type="reset" class="btn btn-outline-danger w-100 text-uppercase rounded-pill"
                                style="letter-spacing: 2px;">Reset</button>
                            </div>
                            <div class="col-4 col-md-3 mb-2">
                              <button type="submit" class="btn btn-primary w-100 text-uppercase rounded-pill"
                                style="letter-spacing: 2px;">Simpan</button>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </form>
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
      if ($('#status').value = 'Menunggu tanggapan') {
        $('#col-tanggapan').hide();
      }

      $('#status').change(function() {
        if (this.value == 'Menunggu tanggapan') {
          $('#col-tanggapan').hide();
        } else {
          $('#col-tanggapan').show();
        }
      })
    })
    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    })
  </script>

  @if (session()->has('message'))
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
