<!DOCTYPE html>
<html lang="zxx">

@include('layout.head')

<body>
    <div id="wrapper">

        <!-- page preloader begin -->
        <div id="de-preloader"></div>
        <!-- page preloader close -->

        <!-- header begin -->
        @include('layout.header')
        <!-- header close -->

        <!-- content begin -->
        <div class="no-bottom no-top zebra" id="content">
            <div id="top"></div>

            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="{{ asset('Template/asset/images/background/14.jpg') }}" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Produk</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section id="section-settings" class="bg-gray-100 hp-prod">
                <div class="container">
                    <div class="row">

                        <!-- SIDEBAR -->
                        <div class="col-lg-3 mb30">
                            <div class="card padding30 rounded-5">
                                <div class="profile_avatar">
                                    <div class="profile_img">
                                        <img src="{{ asset('Template/asset/images/profile/1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="spacer-20"></div>
                                <ul class="menu-col">
                                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i>Beranda</a></li>
                                    <li><a href="{{ route('produk.index') }}" class="active"><i class="fa fa-gamepad"></i>Produk</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fa fa-sign-out"></i>Sign Out
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- ISI -->
                        <div class="col-lg-9">

                            <!-- STATISTIK -->
                            <div class="row mb20">
                                <div class="col-md-4 mb-3">
                                    <div class="hp-stat"><small>Total Produk</small><div>{{ $total }}</div></div>
                                </div>
                                <div class="col-6 col-md-4 mb-3">
                                    <div class="hp-stat"><small>Tersedia</small><div class="g">{{ $tersedia }}</div></div>
                                </div>
                                <div class="col-6 col-md-4 mb-3">
                                    <div class="hp-stat"><small>Total Stok</small><div>{{ $totalStok }}</div></div>
                                </div>
                            </div>

                            <div class="card padding40 rounded-5">

                                <div class="hp-head">
                                    <div>
                                        <h4 style="margin:0;">Daftar Produk</h4>
                                        <p class="p-info" style="margin:4px 0 0 0;">Kelola console, game, dan aksesoris yang disewakan.</p>
                                    </div>
                                    <button type="button" class="btn-main" id="btnTambah" style="border:0; cursor:pointer;">+ Tambah Produk</button>
                                </div>

                                <div class="spacer-20"></div>

                                <!-- CARI / FILTER -->
                                <form method="GET" action="{{ route('produk.index') }}" class="form-border hp-filter">
                                    <input type="text" name="q" value="{{ $q }}" class="form-control"
                                           placeholder="Cari nama, tipe, atau kode produk">
                                    <select name="jenis" class="form-control">
                                        <option value="">Semua jenis</option>
                                        @foreach ($jenisList as $j)
                                            <option value="{{ $j }}" @selected($jenis === $j)>{{ $j }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn-main" style="border:0; cursor:pointer;">Cari</button>
                                    @if ($q !== '' || $jenis)
                                        <a href="{{ route('produk.index') }}" class="hp-reset">Reset</a>
                                    @endif
                                </form>

                                <!-- TABEL -->
                                <div class="table-responsive">
                                    <table class="table hp-table">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Kode</th>
                                                <th>Nama Produk</th>
                                                <th>Jenis</th>
                                                <th>Tipe / Model</th>
                                                <th>Harga Sewa</th>
                                                <th>Stok</th>
                                                <th>Status</th>
                                                <th style="text-align:right;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($produks as $p)
                                                <tr>
                                                    <td>
                                                        @if ($p->foto_url)
                                                            <img src="{{ $p->foto_url }}" alt="{{ $p->nama_produk }}" class="hp-thumb">
                                                        @else
                                                            <div class="hp-thumb hp-thumb-empty">&ndash;</div>
                                                        @endif
                                                    </td>
                                                    <td class="hp-kode">{{ $p->id_produk }}</td>
                                                    <td><b>{{ $p->nama_produk }}</b></td>
                                                    <td>{{ $p->jenis_produk }}</td>
                                                    <td>{{ $p->tipe_model }}</td>
                                                    <td style="white-space:nowrap;">
                                                        Rp {{ number_format($p->harga_sewa, 0, ',', '.') }}<small class="text-gray"> /hari</small>
                                                    </td>
                                                    <td>{{ $p->stok_produk }}</td>
                                                    <td>
                                                        <span class="hp-badge st-{{ $p->status_produk }}">
                                                            {{ $statusList[$p->status_produk] ?? $p->status_produk }}
                                                        </span>
                                                    </td>
                                                    <td style="text-align:right; white-space:nowrap;">
                                                        <button type="button" class="hp-mini hp-mini-edit btn-edit"
                                                            data-produk="{{ json_encode(array_merge(
                                                                $p->only(['id','nama_produk','jenis_produk','tipe_model','harga_sewa','stok_produk','status_produk']),
                                                                ['foto_url' => $p->foto_url]
                                                            )) }}">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="hp-mini hp-mini-del btn-hapus"
                                                            data-id="{{ $p->id }}" data-nama="{{ $p->nama_produk }}">
                                                            Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="hp-empty">
                                                        @if ($q !== '' || $jenis)
                                                            Produk tidak ditemukan.
                                                        @else
                                                            Belum ada produk. Klik <b>+ Tambah Produk</b> untuk mulai.
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div style="margin-top:16px;">
                                    {{ $produks->links('pagination::bootstrap-5') }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- content close -->

        <a href="#" id="back-to-top"></a>

        <!-- footer begin -->
        @include('layout.footer')
        <!-- footer close -->

    </div>

    @php
        // pilihan jenis: bawaan + jenis lain yang sudah ada di data
        $opsiJenis = collect(['Console', 'Game', 'Aksesoris', 'Lainnya'])
            ->merge($jenisList)
            ->unique()
            ->values();
    @endphp

    <!-- ============ POPUP TAMBAH / EDIT ============ -->
    <div class="hp-overlay" id="produkModal" aria-hidden="true">
        <div class="hp-dialog" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <form id="produkForm" class="form-border" method="POST" action="{{ route('produk.store') }}"
                  enctype="multipart/form-data"
                  data-store-url="{{ route('produk.store') }}"
                  data-update-url="{{ route('produk.update', '__ID__') }}">
                @csrf
                <input type="hidden" name="_method" value="PUT" id="f_method" disabled>
                <input type="hidden" name="_mode" id="f_mode" value="{{ old('_mode', 'tambah') }}">
                <input type="hidden" name="_id" id="f_id" value="{{ old('_id') }}">

                <div class="hp-dialog-head">
                    <h4 id="modalTitle">Tambah Produk</h4>
                    <button type="button" class="hp-x" data-close aria-label="Tutup">&times;</button>
                </div>

                <div class="hp-dialog-body">

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul style="margin:0; padding-left:18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8 mb20">
                            <h5>Nama Produk</h5>
                            <input type="text" name="nama_produk" id="f_nama" class="form-control"
                                   value="{{ old('nama_produk') }}" placeholder="Contoh: PlayStation 5 Slim" maxlength="100" required>
                        </div>

                        <div class="col-md-4 mb20">
                            <h5>Jenis</h5>
                            <select name="jenis_produk" id="f_jenis" class="form-control" required>
                                <option value="" disabled @selected(old('jenis_produk') === null)>Pilih jenis</option>
                                @foreach ($opsiJenis as $j)
                                    <option value="{{ $j }}" @selected(old('jenis_produk') === $j)>{{ $j }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb20">
                            <h5>Tipe / Model</h5>
                            <input type="text" name="tipe_model" id="f_tipe" class="form-control"
                                   value="{{ old('tipe_model') }}" placeholder="Contoh: PS5, PS4 Pro, DualSense" maxlength="50" required>
                        </div>

                        <div class="col-md-6 mb20">
                            <h5>Harga Sewa (Rp / hari)</h5>
                            <input type="number" name="harga_sewa" id="f_harga" class="form-control"
                                   value="{{ old('harga_sewa') }}" min="0" step="1" placeholder="75000" required>
                        </div>

                        <div class="col-md-6 mb20">
                            <h5>Stok</h5>
                            <input type="number" name="stok_produk" id="f_stok" class="form-control"
                                   value="{{ old('stok_produk', 0) }}" min="0" step="1" required>
                        </div>

                        <div class="col-md-6 mb20">
                            <h5>Status</h5>
                            <select name="status_produk" id="f_status" class="form-control" required>
                                @foreach ($statusList as $val => $label)
                                    <option value="{{ $val }}" @selected(old('status_produk', 'tersedia') === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- FOTO -->
                        <div class="col-md-12 mb20">
                            <h5>Foto Produk</h5>
                            <div class="hp-foto">
                                <div class="hp-foto-prev">
                                    <span id="fotoPlaceholder">Belum ada foto</span>
                                    <img id="fotoImg" alt="Pratinjau foto" style="display:none;">
                                </div>
                                <div class="hp-foto-ctl">
                                    <input type="file" name="foto_produk" id="f_foto" accept="image/png,image/jpeg,image/webp">
                                    <small class="text-gray" style="display:block; margin-top:6px;">JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                                    <label id="hapusFotoWrap" class="hp-check" style="display:none;">
                                        <input type="checkbox" name="hapus_foto" value="1" id="f_hapus_foto"> Hapus foto saat ini
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hp-dialog-foot">
                    <button type="button" class="hp-ghost" data-close>Batal</button>
                    <button type="submit" class="btn-main" id="btnSimpan" style="border:0; cursor:pointer;">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- form hapus (dikirim lewat SweetAlert2) -->
    <form id="hapusForm" method="POST" action="" data-url="{{ route('produk.destroy', '__ID__') }}" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- status dari server (dibaca script) -->
    <div id="hp-state" hidden
         data-reopen="{{ $errors->any() ? '1' : '0' }}"
         data-mode="{{ old('_mode') }}"
         data-id="{{ old('_id') }}"
         data-flash="{{ session('success') }}"></div>

    <div id="selector">
        <div id="demo-rtl" class="sc-opt">
            <div class="sc-icon">RTL</div><span class="sc-val">Click to Enable</span>
        </div>
    </div>
    <div id="purchase-now">
        <a href="https://themeforest.net/cart/configure_before_adding/44940477" target="_blank"><span>$</span>25</a>
        <div class="pn-hover">Buy Now</div>
    </div>

    <!-- Javascript Files
    ================================================== -->
    @include('layout.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .hp-prod { --navy:#0f2f44; --green:#17a34a; }

        /* statistik */
        .hp-prod .hp-stat { background:#fff; border-radius:14px; padding:16px 20px; box-shadow:0 4px 18px rgba(15,47,68,.07); }
        .hp-prod .hp-stat small { color:#6b8190; font-weight:700; letter-spacing:1px; text-transform:uppercase; font-size:11px; }
        .hp-prod .hp-stat div { font-size:28px; font-weight:700; margin-top:2px; color:var(--navy); }
        .hp-prod .hp-stat div.g { color:var(--green); }

        .hp-head { display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:12px; }

        /* cari */
        .hp-filter { display:flex; flex-wrap:wrap; gap:10px; align-items:center; margin-bottom:18px; }
        .hp-filter .form-control { margin:0; flex:1 1 180px; min-width:0; }
        .hp-filter select.form-control { flex:0 1 190px; }
        .hp-reset { font-size:14px; font-weight:700; color:#6b8190; text-decoration:underline; }

        /* tabel */
        .hp-table { width:100%; margin:0; }
        .hp-table th { font-size:11px; letter-spacing:1.5px; text-transform:uppercase; color:#6b8190; border-bottom:2px solid #e3ebe8; white-space:nowrap; padding:12px 10px; }
        .hp-table td { vertical-align:middle; padding:12px 10px; border-bottom:1px solid #eef2f0; }
        .hp-kode { font-family:"Courier New",monospace; font-weight:700; color:#6b8190; font-size:13px; white-space:nowrap; }
        .hp-empty { text-align:center; color:#6b8190; padding:44px 12px !important; }

        /* foto kecil di tabel */
        .hp-thumb { width:52px; height:52px; object-fit:cover; border-radius:10px; border:1px solid #e3ebe8; background:#f5fbf9; display:block; }
        .hp-thumb-empty { display:flex; align-items:center; justify-content:center; color:#9fb0ba; font-weight:700; }

        .hp-badge { display:inline-block; font-size:12px; font-weight:700; padding:5px 12px; border-radius:50px; white-space:nowrap; }
        .hp-badge.st-tersedia { background:#e6f6ec; color:#146c35; }
        .hp-badge.st-disewa { background:#fff3d6; color:#8a5a00; }
        .hp-badge.st-maintenance { background:#eceff2; color:#55636f; }

        .hp-mini { font-size:13px; font-weight:700; padding:6px 12px; border-radius:8px; background:#fff; cursor:pointer; margin-left:4px; }
        .hp-mini-edit { border:1px solid #c7d3da; color:var(--navy); }
        .hp-mini-edit:hover { background:var(--navy); color:#fff; border-color:var(--navy); }
        .hp-mini-del { border:1px solid #f0c4c4; color:#b42318; }
        .hp-mini-del:hover { background:#b42318; color:#fff; border-color:#b42318; }

        /* popup */
        .hp-overlay { position:fixed; inset:0; z-index:99999; background:rgba(8,24,36,.62); display:none; align-items:center; justify-content:center; padding:16px; }
        .hp-overlay.hp-open { display:flex; }
        .hp-dialog { background:#fff; width:100%; max-width:680px; max-height:92vh; overflow:auto; border-radius:16px; box-shadow:0 24px 70px rgba(0,0,0,.35); animation:hp-pop .18s ease-out; }
        @keyframes hp-pop { from { opacity:0; transform:translateY(12px) scale(.98); } to { opacity:1; transform:none; } }

        .hp-dialog-head { display:flex; align-items:center; justify-content:space-between; background:var(--navy); border-bottom:4px solid var(--green); padding:16px 22px; }
        .hp-dialog-head h4 { margin:0; color:#fff; }
        .hp-x { background:none; border:0; color:#fff; font-size:30px; line-height:1; cursor:pointer; padding:0 4px; }
        .hp-dialog-body { padding:24px 24px 4px; }
        .hp-dialog-body h5 { font-size:14px; margin-bottom:6px; }
        .hp-dialog-foot { display:flex; justify-content:flex-end; gap:10px; padding:10px 24px 22px; }

        /* upload foto */
        .hp-foto { display:flex; gap:16px; align-items:center; flex-wrap:wrap; }
        .hp-foto-prev { width:120px; height:120px; border:2px dashed #c7d3da; border-radius:14px; background:#f5fbf9; display:flex; align-items:center; justify-content:center; overflow:hidden; text-align:center; font-size:12px; color:#8a9ba6; padding:6px; flex:0 0 auto; }
        .hp-foto-prev img { width:100%; height:100%; object-fit:cover; border-radius:10px; }
        .hp-foto-ctl { flex:1 1 220px; min-width:0; }
        .hp-foto-ctl input[type=file] { width:100%; font-size:14px; }
        .hp-check { display:flex; align-items:center; gap:8px; margin-top:10px; font-size:14px; color:#b42318; font-weight:600; cursor:pointer; }
        .hp-check input { width:auto; margin:0; }

        /* tombol */
        .hp-ghost { background:#fff; border:1px solid #c7d3da; color:var(--navy); font-weight:700; border-radius:10px; padding:10px 20px; cursor:pointer; }
        .hp-ghost:hover { background:#f1f5f7; }
        .hp-danger { background:#b42318; border:0; color:#fff; font-weight:700; border-radius:10px; padding:10px 20px; cursor:pointer; }
        .hp-danger:hover { background:#8f1c13; }

        body.hp-lock { overflow:hidden; }

        /* SweetAlert2 di atas semua */
        .swal2-container { z-index:100000 !important; }
        .swal2-actions { gap:10px; }
    </style>

    <script>
        (function () {
            var produkModal = document.getElementById('produkModal');

            function openModal(m)  { m.classList.add('hp-open'); m.setAttribute('aria-hidden', 'false'); document.body.classList.add('hp-lock'); }
            function closeModal(m) { m.classList.remove('hp-open'); m.setAttribute('aria-hidden', 'true'); document.body.classList.remove('hp-lock'); }

            // tutup: tombol batal/x, klik area gelap, tombol ESC
            produkModal.addEventListener('click', function (e) {
                if (e.target === produkModal || e.target.hasAttribute('data-close')) closeModal(produkModal);
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeModal(produkModal);
            });

            var form    = document.getElementById('produkForm');
            var title   = document.getElementById('modalTitle');
            var btnSave = document.getElementById('btnSimpan');
            var fMethod = document.getElementById('f_method');
            var fMode   = document.getElementById('f_mode');
            var fId     = document.getElementById('f_id');

            var fields = {
                nama:   document.getElementById('f_nama'),
                jenis:  document.getElementById('f_jenis'),
                tipe:   document.getElementById('f_tipe'),
                harga:  document.getElementById('f_harga'),
                stok:   document.getElementById('f_stok'),
                status: document.getElementById('f_status')
            };

            // ---- foto ----
            var fFoto     = document.getElementById('f_foto');
            var fotoImg   = document.getElementById('fotoImg');
            var fotoPh    = document.getElementById('fotoPlaceholder');
            var hapusWrap = document.getElementById('hapusFotoWrap');
            var hapusChk  = document.getElementById('f_hapus_foto');
            var fotoSaatIni = '';

            function tampilFoto(url) {
                if (url) {
                    fotoImg.src = url;
                    fotoImg.style.display = 'block';
                    fotoPh.style.display = 'none';
                } else {
                    fotoImg.removeAttribute('src');
                    fotoImg.style.display = 'none';
                    fotoPh.style.display = 'block';
                }
            }

            function resetFoto(url) {
                fotoSaatIni = url || '';
                fFoto.value = '';
                hapusChk.checked = false;
                hapusWrap.style.display = fotoSaatIni ? 'flex' : 'none';
                tampilFoto(fotoSaatIni);
            }

            fFoto.addEventListener('change', function () {
                var f = fFoto.files[0];
                if (!f) { tampilFoto(hapusChk.checked ? '' : fotoSaatIni); return; }

                if (f.size > 2 * 1024 * 1024) {
                    Swal.fire({ icon: 'error', title: 'Foto terlalu besar', text: 'Ukuran foto maksimal 2 MB.', confirmButtonColor: '#17a34a' });
                    fFoto.value = '';
                    tampilFoto(hapusChk.checked ? '' : fotoSaatIni);
                    return;
                }

                hapusChk.checked = false;
                tampilFoto(URL.createObjectURL(f));
            });

            hapusChk.addEventListener('change', function () {
                if (hapusChk.checked) {
                    fFoto.value = '';
                    tampilFoto('');
                } else {
                    tampilFoto(fotoSaatIni);
                }
            });

            // ---- mode form ----
            function setAddMode() {
                title.textContent = 'Tambah Produk';
                btnSave.textContent = 'Simpan Produk';
                form.action = form.dataset.storeUrl;
                fMethod.disabled = true;
                fMode.value = 'tambah';
                fId.value = '';
                resetFoto('');
            }

            function setEditMode(id, fotoUrl) {
                title.textContent = 'Edit Produk';
                btnSave.textContent = 'Simpan Perubahan';
                form.action = form.dataset.updateUrl.replace('__ID__', id);
                fMethod.disabled = false;
                fMode.value = 'edit';
                fId.value = id;
                resetFoto(fotoUrl);
            }

            // Tambah
            document.getElementById('btnTambah').addEventListener('click', function () {
                setAddMode();
                fields.nama.value = '';
                fields.jenis.value = '';
                fields.tipe.value = '';
                fields.harga.value = '';
                fields.stok.value = '0';
                fields.status.value = 'tersedia';
                openModal(produkModal);
                fields.nama.focus();
            });

            // Edit
            document.querySelectorAll('.btn-edit').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var d = JSON.parse(btn.dataset.produk);
                    setEditMode(d.id, d.foto_url);
                    fields.nama.value   = d.nama_produk;
                    fields.jenis.value  = d.jenis_produk;
                    fields.tipe.value   = d.tipe_model;
                    fields.harga.value  = d.harga_sewa;
                    fields.stok.value   = d.stok_produk;
                    fields.status.value = d.status_produk;
                    openModal(produkModal);
                    fields.nama.focus();
                });
            });

            // ---- Hapus pakai SweetAlert2 ----
            var swalHp = Swal.mixin({
                customClass: {
                    confirmButton: 'hp-danger',
                    cancelButton: 'hp-ghost'
                },
                buttonsStyling: false
            });

            var hapusForm = document.getElementById('hapusForm');

            document.querySelectorAll('.btn-hapus').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    swalHp.fire({
                        title: 'Hapus produk?',
                        text: 'Produk "' + btn.dataset.nama + '" dan fotonya akan dihapus. Tidak bisa dikembalikan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        focusCancel: true
                    }).then(function (result) {
                        if (!result.isConfirmed) return;

                        swalHp.fire({
                            title: 'Menghapus...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: function () { Swal.showLoading(); }
                        });

                        hapusForm.action = hapusForm.dataset.url.replace('__ID__', btn.dataset.id);
                        hapusForm.submit();
                    });
                });
            });

            // ---- Pesan sukses dari server jadi toast ----
            var st = document.getElementById('hp-state');

            if (st.dataset.flash) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: st.dataset.flash,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }

            // Validasi gagal: buka lagi popup dengan isian tadi
            // (kolom foto tidak bisa terisi ulang oleh browser, pilih foto lagi)
            if (st.dataset.reopen === '1') {
                if (st.dataset.mode === 'edit' && st.dataset.id) {
                    var fotoLama = '';
                    document.querySelectorAll('.btn-edit').forEach(function (btn) {
                        var d = JSON.parse(btn.dataset.produk);
                        if (String(d.id) === String(st.dataset.id)) { fotoLama = d.foto_url || ''; }
                    });
                    setEditMode(st.dataset.id, fotoLama);
                } else {
                    setAddMode();
                }
                openModal(produkModal);
            }
        })();
    </script>

</body>

</html>