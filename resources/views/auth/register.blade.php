<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from https://www.designesia.com/themes/rentaly/register.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:13 GMT -->

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

            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="{{ asset('Template/asset/images/background/subheader.jpg') }}" class="jarallax-img"
                    alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Register</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->


            <section aria-label="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <h3>Don't have an account? Register now.</h3>
                            <p>Welcome to Rentaly. We're excited to have you on board. By creating an account with us,
                                you'll gain access to a range of benefits and convenient features that will enhance your
                                car rental experience.</p>

                            <div class="spacer-10"></div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

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

                            <form name="registerForm" id="register_form" class="form-border" method="POST"
                                action="{{ route('register.store') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Name:</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Email Address:</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Choose a Username:</label>
                                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Phone:</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Password:</label>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-set">
                                            <label>Re-enter Password:</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div id="submit" class="pull-left">
                                            <input type="submit" id="btn_register" value="Register Now" class="btn-main color-2">
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>

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


<!-- Mirrored from https://www.designesia.com/themes/rentaly/register.html by HTTrack Website Copier/3.x [XR&CO], Sat, 21 Nov 2026 07:18:13 GMT -->

</html>