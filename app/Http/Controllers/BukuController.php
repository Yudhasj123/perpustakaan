<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Penerbit;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index',compact('buku'));
    }
    public function store (Request $request)
    {
        
        $image = $request->file('gambar');
        $image ->storeAs('public/buku',$image->hashName());
        Buku::create([
            'kode'=>$request->kode,
            'judul'=> $request->judul,
            'kategori_id'=> $request->kategori_id,
            'penerbit_id'=> $request->penerbit_id,
            'isbn'=> $request->isbn,
            'pengarang' => $request->pengarang,
            'jumlah_halaman'=> $request->jumlah_halaman,
            'stok'=>$request->stok,
            'tahun_terbit'=> $request->tahun_terbit,
            'sinopsis'=> $request->sinopsis,
            'gambar'=> $image->hashName(),
        ]);
            return redirect('buku')->with('sukses', 'Data berhasil disimpan');
        
        

    }
    public function create()
    {
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();
        $buku = Buku::all();
        return view('buku.create', compact('kategori','penerbit','buku'));
    }
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        
        return redirect('buku')->with('sukses', 'Data berhasil di hapus');
    }
    public function show(buku $buku)
    {
        //
    }
    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategori = \App\Models\Kategori::all();
        $penerbit = \App\Models\Penerbit::all();

        return view('buku.edit', compact('buku','penerbit','kategori'));
    }

    
    public function update(Request $request, $id)
    {
        $image = $request->file('gambar');
        $image->storeAs('public/buku', $image->hashName());

        $buku = Buku::find($id);
        $buku->kode = $request->kode;
        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori_id;
        $buku->penerbit_id = $request->penerbit_id;
        $buku->isbn = $request->isbn;
        $buku->pengarang = $request->pengarang;
        $buku->jumlah_halaman = $request->jumlah_halaman;
        $buku->stok = $request->stok;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->sinopsis = $request->sinopsis;
        $buku->gambar = $image->hashName();
        $buku->Update();

        return redirect('buku')->with('sukses', 'Data berhasil di Update');

    }
       
        }

       
    


