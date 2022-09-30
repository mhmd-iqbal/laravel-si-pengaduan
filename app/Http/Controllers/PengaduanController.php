<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('auth.pengaduan.index', [
      'pengaduan' => Pengaduan::orderBy('created_at', 'desc')->get()
    ]);
  }

  public function index2()
  {
    return view('auth.pengaduan.index', [
      'pengaduan' => Pengaduan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('auth.pengaduan.create', [
      'kategori' => Kategori::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // dd($request->gambar);
    $validatedData = $request->validate([
      'judul' => 'required|max:50',
      'kategori_id' => 'required',
      'isi' => 'required',
      'gambar' => 'image|mimes:jpg,png,jpeg|max:1024',
    ]);

    if ($request->file('gambar')) {
      $validatedData['gambar'] = $request->file('gambar')->store('images');
    }

    $validatedData['no_pengaduan'] = 'A-' . date('ymdhis') . mt_rand(2, 100);
    $validatedData['user_id'] = auth()->user()->id;
    $validatedData['status'] = 'Menunggu konfirmasi';

    Pengaduan::create($validatedData);

    return redirect('pengaduan')->with('message', 'Pengaduan Anda berhasil dikirim!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Pengaduan  $pengaduan
   * @return \Illuminate\Http\Response
   */
  public function show(Pengaduan $pengaduan)
  {
    return view('auth.pengaduan.show', [
      'data' => $pengaduan
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Pengaduan  $pengaduan
   * @return \Illuminate\Http\Response
   */
  public function edit(Pengaduan $pengaduan)
  {
    if (auth()->user()->level != 'teknisi') {
      return abort(401);
    }

    return view('auth.pengaduan.review', [
      'pengaduan' => $pengaduan,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Pengaduan  $pengaduan
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Pengaduan $pengaduan)
  {
    // dd($request->all());
    $validatedData = $request->validate([
      'judul' => 'required|min:5|max:50',
      'status' => 'required',
      'tanggapan' => 'required|min:5',
    ]);

    if ($request->status == 'Menunggu konfirmasi') {
      $validatedData['tanggapan'] = NULL;
    }

    Pengaduan::where('no_pengaduan', $pengaduan->no_pengaduan)->update($validatedData);

    return redirect()->to('/pengaduan')->with('message', 'Data tanggapan berhasil tersimpan!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Pengaduan  $pengaduan
   * @return \Illuminate\Http\Response
   */
  public function destroy(Pengaduan $pengaduan)
  {
    if ($pengaduan->gambar) {
      Storage::delete($pengaduan->gambar);
    }

    Pengaduan::destroy($pengaduan->no_pengaduan);

    return back()->with('delete', 'Data pengaduan berhasil dihapus');
  }

  public function updateStatus(Pengaduan $pengaduan)
  {
    $data = [
      'status' => 'Selesai'
    ];

    // dd($data);
    if (Pengaduan::where('no_pengaduan', $pengaduan->no_pengaduan)->update($data)) {
      return back()->with('message', 'Status pengaduan dirubah menjadi Selesai!');
    } else {
      return back()->with('message', 'Status pengaduan gagal dirubah menjadi Selesai!');
    }
  }
}
