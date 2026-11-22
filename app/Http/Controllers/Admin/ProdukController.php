<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $q     = trim((string) $request->query('q'));
        $jenis = $request->query('jenis');

        $produks = Produk::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('nama_produk', 'like', "%{$q}%")
                      ->orWhere('tipe_model', 'like', "%{$q}%")
                      ->orWhere('id_produk', 'like', "%{$q}%");
                });
            })
            ->when($jenis, fn ($query) => $query->where('jenis_produk', $jenis))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        // daftar jenis diambil dari data yang sudah ada
        $jenisList = Produk::query()
            ->select('jenis_produk')
            ->distinct()
            ->orderBy('jenis_produk')
            ->pluck('jenis_produk');

        return view('admin.produk.produk', [
            'produks'    => $produks,
            'q'          => $q,
            'jenis'      => $jenis,
            'jenisList'  => $jenisList,
            'statusList' => Produk::STATUS,
            'total'      => Produk::count(),
            'tersedia'   => Produk::where('status_produk', 'tersedia')->count(),
            'totalStok'  => (int) Produk::sum('stok_produk'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto_produk')) {
            // foto baru: hapus foto lama, simpan yang baru
            $this->hapusFile($produk->foto_produk);
            $data['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        } elseif ($request->boolean('hapus_foto')) {
            $this->hapusFile($produk->foto_produk);
            $data['foto_produk'] = null;
        }

        $produk->update($data);

        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $nama = $produk->nama_produk;

        $this->hapusFile($produk->foto_produk);
        $produk->delete();

        return back()->with('success', "Produk \"{$nama}\" dihapus.");
    }

    private function hapusFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama_produk'   => ['required', 'string', 'max:100'],
            'jenis_produk'  => ['required', 'string', 'max:30'],
            'tipe_model'    => ['required', 'string', 'max:50'],
            'harga_sewa'    => ['required', 'integer', 'min:0', 'max:100000000'],
            'stok_produk'   => ['required', 'integer', 'min:0', 'max:9999'],
            'status_produk' => ['required', 'in:' . implode(',', array_keys(Produk::STATUS))],
            'foto_produk'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nama_produk.required'   => 'Nama produk wajib diisi.',
            'jenis_produk.required'  => 'Pilih jenis produk.',
            'tipe_model.required'    => 'Tipe/model wajib diisi.',
            'harga_sewa.required'    => 'Harga sewa wajib diisi.',
            'harga_sewa.integer'     => 'Harga sewa harus angka bulat.',
            'stok_produk.required'   => 'Stok wajib diisi.',
            'stok_produk.integer'    => 'Stok harus angka bulat.',
            'status_produk.required' => 'Pilih status produk.',
            'foto_produk.image'      => 'File harus berupa gambar.',
            'foto_produk.mimes'      => 'Foto harus JPG, PNG, atau WEBP.',
            'foto_produk.max'        => 'Ukuran foto maksimal 2 MB.',
            'foto_produk.uploaded'   => 'Foto gagal diunggah. Ukuran terlalu besar atau koneksi terputus.',
        ]);

        // file ditangani terpisah di store() dan update()
        unset($data['foto_produk']);

        return $data;
    }
}