<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('auth.permohonan.index', [
      'permohonan' => Permohonan::orderBy('updated_at', 'desc')->get()
    ]);
  }

  public function index2()
  {
    return view('auth.permohonan.index', [
      'permohonan' => Permohonan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('auth.permohonan.create', [
      'pengaduan' => Pengaduan::where('status', 'Menunggu konfirmasi')->get()
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
    $validatedData = $request->validate([
      'judul' => 'required|max:50',
      'kode_pengaduan' => 'required',
      'isi' => 'required',
    ]);
    $validatedData['no_permohonan'] = 'M-' . date('ymdhis') . mt_rand(2, 100);
    $validatedData['user_id'] = auth()->user()->id;
    $validatedData['status'] = 'Menunggu tanggapan';

    Permohonan::create($validatedData);

    return redirect('/permohonan-saya')->with('message', 'Permohonan Anda berhasil dikirim!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Permohonan  $permohonan
   * @return \Illuminate\Http\Response
   */
  public function show(Permohonan $permohonan)
  {
    return view('auth.permohonan.show', [
      'data' => $permohonan
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Permohonan  $permohonan
   * @return \Illuminate\Http\Response
   */
  public function edit(Permohonan $permohonan)
  {
    if (auth()->user()->level != 'aset') {
      return abort(401);
    }

    return view('auth.permohonan.review', [
      'permohonan' => $permohonan,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Permohonan  $permohonan
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Permohonan $permohonan)
  {
    // dd($request->all());
    $validatedData = $request->validate([
      'status' => 'required',
      'tanggapan' => 'required|min:5',
    ]);

    Permohonan::where('no_permohonan', $permohonan->no_permohonan)->update($validatedData);

    return redirect('/permohonan')->with('message', 'Data tanggapan berhasil tersimpan!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Permohonan  $permohonan
   * @return \Illuminate\Http\Response
   */
  public function destroy(Permohonan $permohonan)
  {
    Permohonan::destroy($permohonan->no_permohonan);

    return back()->with('delete', 'Data permohonan berhasil dihapus');
  }
}
