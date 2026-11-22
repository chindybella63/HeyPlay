<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public const STATUS = [
        'tersedia'    => 'Tersedia',
        'disewa'      => 'Disewa',
        'maintenance' => 'Maintenance',
    ];

    protected $fillable = [
        'nama_produk',
        'jenis_produk',
        'tipe_model',
        'harga_sewa',
        'stok_produk',
        'status_produk',
        'foto_produk',
    ];

    protected function casts(): array
    {
        return [
            'harga_sewa'  => 'integer',
            'stok_produk' => 'integer',
        ];
    }

    // alamat foto untuk ditampilkan: $produk->foto_url
    // null kalau produk belum punya foto
    protected function fotoUrl(): Attribute
    {
        return Attribute::get(
            fn () => $this->foto_produk ? asset('storage/' . $this->foto_produk) : null
        );
    }

    // isi kode produk otomatis setelah data tersimpan: PRD-0001, PRD-0002, ...
    protected static function booted(): void
    {
        static::created(function (Produk $produk) {
            $produk->id_produk = 'PRD-' . str_pad((string) $produk->id, 4, '0', STR_PAD_LEFT);
            $produk->saveQuietly();
        });
    }
}