<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from https://www.designesia.com/themes/rentaly/login.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:13 GMT -->
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
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <section id="section-hero" aria-label="section" class="jarallax">
                <img src="images/background/2.jpg" class="jarallax-img" alt="">
                <div class="v-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-4 offset-lg-4">
                                <div class="padding40 rounded-3 shadow-soft" data-bgcolor="#ffffff">
                                    <h4>Login</h4>
                                    <div class="spacer-10"></div>
                                    @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <form id="form_login" class="form-border" method="POST" action="{{ route('login.store') }}">
                                        @csrf

                                        <div class="field-set">
                                            <input type="text" name="login" id="login" class="form-control"
                                                placeholder="Email atau Username" value="{{ old('login') }}" required autofocus />
                                        </div>

                                        <div class="field-set">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" required />
                                        </div>

                                        <div class="field-set">
                                            <label style="cursor:pointer;">
                                                <input type="checkbox" name="remember" value="1"> Ingat saya
                                            </label>
                                        </div>

                                        <div id="submit">
                                            <input type="submit" id="btn_login" value="Sign In"
                                                class="btn-main btn-fullwidth rounded-3" />
                                        </div>

                                        <div class="clearfix" style="margin-top:15px; text-align:center;">
                                            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                                        </div>
                                    </form>
                                    <div class="title-line">Or&nbsp;sign&nbsp;up&nbsp;with</div>
                                    <div class="row g-2">
                                        <div class="col-lg-6">
                                            <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                                    src="images/svg/google_icon.svg" alt="">Google</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                                    src="images/svg/facebook_icon.svg" alt="">Facebook</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- content close -->
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


<!-- Mirrored from https://www.designesia.com/themes/rentaly/login.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:13 GMT -->

</html>