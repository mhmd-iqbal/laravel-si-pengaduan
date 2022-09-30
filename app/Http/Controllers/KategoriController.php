<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.kategori.index', [
            'kategori' => Kategori::orderBy('id', 'asc')->get()
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
            'nama_kategori' => 'required|min:5|max:20',
            'slug' => 'required|alpha_dash|min:5|max:20|unique:kategori,slug',
        ]);

        Kategori::create($validatedData);

        return redirect('kategori')->with('success', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('auth.kategori.edit', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $rules = [
            'nama_kategori' => 'required|min:5|max:20',
        ];

        if ($request->slug != $kategori->slug) {
            $rules['slug'] = 'required|alpha_dash|min:5|max:20|unique:kategori,slug';
        }

        $validatedData = $request->validate($rules);

        Kategori::where('id', $kategori->id)->update($validatedData);
        return redirect('kategori')->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);

        return redirect('kategori')->with('delete', 'delete');
    }
}
