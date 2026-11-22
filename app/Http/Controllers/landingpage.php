<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class landingpage extends Controller
{
    public function home()
    {
        $produks = Produk::all();
        return view("landingpage.home", compact('produks'));
    }

    public function katalog(Request $request)
    {
        $query = Produk::query();

        if ($request->filled('jenis')) {
            $query->whereIn('jenis_produk', $request->jenis);
        }

        if ($request->filled('model')) {
            $query->whereIn('tipe_model', $request->model);
        }

        if ($request->boolean('tersedia')) {
            $query->where('status_produk', 'tersedia')->where('stok_produk', '>', 0);
        }

        if ($request->filled('harga_min')) {
            $query->where('harga_sewa', '>=', $request->harga_min);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga_sewa', '<=', $request->harga_max);
        }

        $produks    = $query->latest()->get();
        $jenisList  = Produk::distinct()->orderBy('jenis_produk')->pluck('jenis_produk');
        $modelList  = Produk::distinct()->orderBy('tipe_model')->pluck('tipe_model');
        $hargaMax   = (int) (ceil((Produk::max('harga_sewa') ?? 0) / 5000) * 5000);

        return view('landingpage.katalog', compact('produks', 'jenisList', 'modelList', 'hargaMax'));
    }
}
