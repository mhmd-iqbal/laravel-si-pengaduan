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
              <h4>Detail Data Aduan ID : {{ $pengaduan->no_pengaduan }}</h4>
              <div class="card-header-action">
                <button onclick="history.back()" class="btn btn-danger"><i
                    class="fas fa-chevron-left mr-1"></i>Kembali</button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <form action="/pengaduan/{{ $pengaduan->no_pengaduan }}" method="post">
                  @method('put')
                  @csrf
                  <table class="table table-striped mb-0">
                    <tbody>
                      <tr>
                        <td>No. Pengaduan</td>
                        <td>
                          <div class="d-flex flex-row flex-wrap justify-content-between align-items-center">
                            <p class="mr-3 mb-0"><strong>{{ $pengaduan->no_pengaduan }}</strong></p>
                            <p class="m-0">Dibuat pada :
                              {{ $pengaduan->created_at->isoFormat('dddd, D MMMM Y') }}
                            </p>
                          </div>

                        </td>

                      </tr>
                      <tr>
                        <td>Nama Pengirim</td>
                        <td>{{ $pengaduan->user->name }}</td>
                      </tr>
                      <tr>
                        <td>Judul</td>
                        <td><input type="text" class="form-control w-auto" name="judul"
                            value="{{ old($pengaduan->judul, $pengaduan->judul) }}"></td>
                      </tr>
                      <tr>
                        <td>Kategori</td>
                        <td>{{ $pengaduan->kategori->nama_kategori }}</td>
                      </tr>
                      <tr>
                        <td>Isi</td>
                        <td>{!! $pengaduan->isi !!}</td>
                      </tr>
                      <tr>
                        <td>Gambar</td>
                        @isset($pengaduan->gambar)
                          <td class="py-2"><img src="{{ asset('storage/' . $pengaduan->gambar) }}"
                              class="img-fluid rounded" style="cursor: pointer;" alt="" width="200"
                              data-toggle="modal" data-target="#imageModal"></td>
                        @else
                          <td class="text-danger">Tidak ada gambar</td>
                        @endisset
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>
                          <select name="status" id="status"
                            class="form-control w-auto @error('status') is-invalid @enderror">
                            <option value="Menunggu konfirmasi"
                              {{ $pengaduan->status == 'Menunggu konfirmasi' ? 'selected' : '' }}>Menunggu konfirmasi
                            </option>
                            <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="Ditolak" {{ $pengaduan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                          </select>
                          @error('status')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </td>
                      </tr>
                      <tr id="col-tanggapan">
                        <td>Tanggapan</td>
                        <td class="py-2">

                          <input id="tanggapan" value="{{ old('tanggapan', $pengaduan->tanggapan) }}" type="hidden"
                            name="tanggapan">
                          <trix-editor input="tanggapan" class="trix-content">
                          </trix-editor>
                          @error('tanggapan')
                            <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </td>
                      </tr>
                      <tr>
                        <td>Isi Tanggapan</td>
                        <td>
                          {!! $pengaduan->tanggapan ?? 'Belum ada tanggapan' !!}
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

  @isset($pengaduan->gambar)
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
            <img src="{{ asset('storage/' . $pengaduan->gambar) }}" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  @endisset
@endsection

@section('scripts')
  <script>
    $('#imageModal').modal('handleUpdate')

    if ($('#status').value = 'Menunggu konfirmasi') {
      $('#col-tanggapan').hide();
    }

    $(document).ready(function() {
      $('#status').change(function() {
        if (this.value == 'Menunggu konfirmasi') {
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
