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
                                    <form id="form_register" class="form-border" method="post"
                                        action="https://www.designesia.com/themes/rentaly/account-dashboard.html">
                                        <div class="field-set">
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Your Name" />
                                        </div>
                                        <div class="field-set">
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Your Name" />
                                        </div>
                                        <div id="submit">
                                            <input type="submit" id="send_message" value="Sign In"
                                                class="btn-main btn-fullwidth rounded-3" />
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
