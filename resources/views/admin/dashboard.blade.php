<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from https://www.designesia.com/themes/rentaly/account-dashboard.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:10 GMT -->
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
    object-fit: cover;   /* pakai "contain" kalau logo tidak boleh terpotong */
}
</style>
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
            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="{{ asset('Template/asset/images/background/14.jpg') }}" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Beranda</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section id="section-cars" class="bg-gray-100">
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
                                    <li><a href="{{ route('dashboard') }}" class="active"><i class="fa fa-home"></i>Beranda</a></li>
                                    <li><a href="{{ route('produk.index') }}"><i class="fa fa-gamepad"></i>Produk</a></li>
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
                            <div class="row">
                                <div class="col-lg-3 col-6 mb25">
                                    <div class="card padding30 rounded-5">
                                        <div class="symbol mb40">
                                            <i class="fa id-color fa-2x fa-gamepad"></i>
                                        </div>
                                        <span class="h1 mb0">{{ $total }}</span>
                                        <span class="text-gray">Total Produk</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6 mb25">
                                    <div class="card padding30 rounded-5">
                                        <div class="symbol mb40">
                                            <i class="fa id-color fa-2x fa-check-circle"></i>
                                        </div>
                                        <span class="h1 mb0">{{ $tersedia }}</span>
                                        <span class="text-gray">Tersedia</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6 mb25">
                                    <div class="card padding30 rounded-5">
                                        <div class="symbol mb40">
                                            <i class="fa id-color fa-2x fa-calendar-check-o"></i>
                                        </div>
                                        <span class="h1 mb0">{{ $disewa }}</span>
                                        <span class="text-gray">Sedang Disewa</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6 mb25">
                                    <div class="card padding30 rounded-5">
                                        <div class="symbol mb40">
                                            <i class="fa id-color fa-2x fa-cubes"></i>
                                        </div>
                                        <span class="h1 mb0">{{ $totalStok }}</span>
                                        <span class="text-gray">Total Stok</span>
                                    </div>
                                </div>
                            </div>

                            <!-- PRODUK TERBARU -->
                            <div class="card padding30 rounded-5 mb25">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="mb0">Produk Terbaru</h4>
                                    <a href="{{ route('produk.index') }}" class="text-gray"><u>Lihat semua</u></a>
                                </div>

                                <table class="table de-table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><span class="fs-12 text-gray">Kode</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Nama Produk</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Jenis</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Tipe / Model</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Harga Sewa</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Stok</span></th>
                                            <th scope="col"><span class="fs-12 text-gray">Status</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produkTerbaru as $p)
                                        <tr>
                                            <td><span class="d-lg-none d-sm-block">Kode</span>
                                                <div class="badge bg-gray-100 text-dark">{{ $p->id_produk }}</div>
                                            </td>
                                            <td><span class="d-lg-none d-sm-block">Nama Produk</span><span class="bold">{{ $p->nama_produk }}</span></td>
                                            <td><span class="d-lg-none d-sm-block">Jenis</span>{{ $p->jenis_produk }}</td>
                                            <td><span class="d-lg-none d-sm-block">Tipe / Model</span>{{ $p->tipe_model }}</td>
                                            <td style="white-space:nowrap;"><span class="d-lg-none d-sm-block">Harga Sewa</span>Rp {{ number_format($p->harga_sewa, 0, ',', '.') }}</td>
                                            <td><span class="d-lg-none d-sm-block">Stok</span>{{ $p->stok_produk }}</td>
                                            <td>
                                                @php
                                                $badge = match ($p->status_produk) {
                                                'tersedia' => 'bg-success',
                                                'disewa' => 'bg-warning',
                                                default => 'bg-secondary',
                                                };
                                                @endphp
                                                <div class="badge rounded-pill {{ $badge }}">{{ ucfirst($p->status_produk) }}</div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-gray">Belum ada produk.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- PRODUK TERSEDIA -->
                            <div class="card padding30 rounded-5">
                                <h4>Produk Tersedia</h4>
                                <div class="spacer-10"></div>

                                @forelse ($produkTersedia as $p)
                                <div class="de-item-list no-border mb30">
                                    <div class="d-img">
                                        <img src="{{ $p->foto_url ?? asset('Template/asset/images/cars/jeep-renegade.jpg') }}"
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
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-price">
                                        Harga sewa <span>Rp {{ number_format($p->harga_sewa, 0, ',', '.') }}</span>
                                        <a class="btn-main" href="{{ route('produk.index') }}">Kelola</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                @empty
                                <p class="text-center text-gray">Belum ada produk yang tersedia.</p>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

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


<!-- Mirrored from https://www.designesia.com/themes/rentaly/account-dashboard.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:10 GMT -->

</html>