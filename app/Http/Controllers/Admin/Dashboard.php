<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class Dashboard extends Controller
{
    public function dashboard()
    {
        $total       = Produk::count();
        $tersedia    = Produk::where('status_produk', 'tersedia')->count();
        $disewa      = Produk::where('status_produk', 'disewa')->count();
        $maintenance = Produk::where('status_produk', 'maintenance')->count();
        $totalStok   = Produk::sum('stok_produk');

        $produkTerbaru  = Produk::latest()->take(5)->get();
        $produkTersedia = Produk::where('status_produk', 'tersedia')
            ->where('stok_produk', '>', 0)
            ->latest()->take(3)->get();

        return view('admin.dashboard', compact('total', 'tersedia', 'disewa', 'maintenance', 'totalStok', 'produkTerbaru', 'produkTersedia'));
    }
}
