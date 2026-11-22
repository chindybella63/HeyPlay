<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from https://www.designesia.com/themes/rentaly/02_dark-cars-list.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:04 GMT -->
@include('layout.head')
<style>
    .de-item-list .d-img {
        width: 280px;
        height: 200px;
        overflow: hidden;
    }

    .de-item-list .d-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* pakai "contain" jika gambar tidak boleh terpotong */
    }
</style>

<body class="dark-scheme">
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
                <img src="{{asset("Template/asset/images/background/2.jpg") }}" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Cars</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section id="section-cars">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">

                            <form method="GET" action="{{ url()->current() }}">

                                <div class="item_filter_group">
                                    <h4>Jenis Produk</h4>
                                    <div class="de_form">
                                        @foreach ($jenisList as $i => $jenis)
                                        <div class="de_checkbox">
                                            <input id="jenis_{{ $i }}" name="jenis[]" type="checkbox" value="{{ $jenis }}"
                                                {{ in_array($jenis, (array) request('jenis', [])) ? 'checked' : '' }}>
                                            <label for="jenis_{{ $i }}">{{ $jenis }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="item_filter_group">
                                    <h4>Tipe Model</h4>
                                    <div class="de_form">
                                        @foreach ($modelList as $i => $model)
                                        <div class="de_checkbox">
                                            <input id="model_{{ $i }}" name="model[]" type="checkbox" value="{{ $model }}"
                                                {{ in_array($model, (array) request('model', [])) ? 'checked' : '' }}>
                                            <label for="model_{{ $i }}">{{ $model }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="item_filter_group">
                                    <h4>Ketersediaan</h4>
                                    <div class="de_form">
                                        <div class="de_checkbox">
                                            <input id="tersedia" name="tersedia" type="checkbox" value="1"
                                                {{ request('tersedia') ? 'checked' : '' }}>
                                            <label for="tersedia">Hanya yang tersedia</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="item_filter_group">
                                    <h4>Harga Sewa per Hari (Rp)</h4>
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" name="harga_min" class="input-min" value="{{ request('harga_min', 0) }}">
                                        </div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" name="harga_max" class="input-max" value="{{ request('harga_max', $hargaMax) }}">
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="{{ $hargaMax }}" value="{{ request('harga_min', 0) }}" step="5000">
                                        <input type="range" class="range-max" min="0" max="{{ $hargaMax }}" value="{{ request('harga_max', $hargaMax) }}" step="5000">
                                    </div>
                                </div>

                                <button type="submit" class="btn-main w-100 mb10">Terapkan Filter</button>
                                <a href="{{ url()->current() }}" class="btn-main w-100" style="background:#6c757d;">Reset</a>
                            </form>
                        </div>

                        <div class="col-lg-9">
                            <div class="row">

                                @forelse ($produks as $p)
                                <div class="col-lg-12">
                                    <div class="de-item-list mb30">
                                        <div class="d-img">
                                            <img src="{{ $p->foto_url ?? asset('Template/asset/images/cars-alt/jeep-renegade.png') }}"
                                                class="img-fluid" alt="{{ $p->nama_produk }}">
                                        </div>
                                        <div class="d-info">
                                            <div class="d-text">
                                                <h4>{{ $p->nama_produk }}</h4>
                                                <div class="d-atr-group">
                                                    <ul class="d-atr">
                                                        <li><span>Jenis:</span>{{ $p->jenis_produk }}</li>
                                                        <li><span>Model:</span>{{ $p->tipe_model }}</li>
                                                        <li><span>Stok:</span>{{ $p->stok_produk }}</li>
                                                        <li><span>Status:</span>{{ ucfirst($p->status_produk) }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-price">
                                            Harga sewa <span>Rp {{ number_format($p->harga_sewa, 0, ',', '.') }}</span>
                                            @if (strtolower($p->status_produk) === 'tersedia' && $p->stok_produk > 0)
                                            <a class="btn-main" href="#">Sewa Sekarang</a>
                                            @else
                                            <a class="btn-main" href="#" style="opacity:.5; pointer-events:none;">Tidak Tersedia</a>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-lg-12 text-center">
                                    <p>Belum ada produk.</p>
                                </div>
                                @endforelse



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

</body>


<!-- Mirrored from https://www.designesia.com/themes/rentaly/02_dark-cars-list.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:04 GMT -->

</html>