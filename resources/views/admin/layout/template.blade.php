<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>Dr-Mind</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->

    <script>
        window.codySettings = {
            widget_id: '9ed873e7-d723-4104-a0d4-da2ebcb2228b'
        };

        ! function() {
            var t = window,
                e = document,
                a = function() {
                    var t = e.createElement("script");
                    t.type = "text/javascript", t.async = !0, t.src = "https://trinketsofcody.com/cody-widget.js";
                    var a = e.getElementsByTagName("script")[0];
                    a.parentNode.insertBefore(t, a)
                };
            "complete" === document.readyState ? a() : t.attachEvent ? t.attachEvent("onload", a) : t.addEventListener(
                "load", a, !1)
        }();
    </script>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('vendors/simplebar/simplebar.min.js') }}"></script>

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="{{ asset('vendors/swiper/swiper-bundle.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('assets/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">


    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script> --}}
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>

            <nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: block;">
                <script>
                    var navbarStyle = localStorage.getItem("navbarStyle");
                    if (navbarStyle && navbarStyle !== 'transparent') {
                        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
                    }
                </script>
                <div class="d-flex align-items-center">
                    <div class="toggle-icon-wrapper">
                        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span
                                class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                    </div><a class="navbar-brand" href="index.html">
                        <div class="d-flex align-items-center py-3"><img class="me-2"
                                src="assets/img/icons/spot-illustrations/falcon.png" alt=""
                                width="40" /><span class="font-sans-serif text-primary">Dr-Mind</span></div>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar">
                        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                            <li class="nav-item">

                                <a class="nav-link" href="{{ url('dashboard') }}" role="button">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">Dashboard</span></div>
                                </a>

                                <!-- parent pages-->

                            </li>
                            <li class="nav-item">
                                <!-- label-->

                                <!-- parent pages-->
                                <a class="nav-link dropdown-indicator" href="#dr" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="dr">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">Users</span>
                                    </div>
                                </a>
                                <ul class="nav collapse" id="dr">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('users-list') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Users List</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('referral-tree') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">View Level</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>



                                </ul>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link dropdown-indicator" href="#ecommerce" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="ecommerce">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">E-Commerce</span>
                                    </div>
                                </a>
                                <ul class="nav collapse" id="ecommerce">




                                    <li class="nav-item">
                                        <a class="nav-link dropdown-indicator" href="#products"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="products">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Products</span></div>
                                        </a><!-- more inner pages-->
                                        <ul class="nav collapse" id="products">
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ url('add-product') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Add Products</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('allProducts') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">View All Products</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('eProducts') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">View e-Products</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ url('allProducts') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">View Products</span></div>
                                                </a><!-- more inner pages--></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link dropdown-indicator" href="#subscription"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="products">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Subscription</span></div>
                                        </a><!-- more inner pages-->
                                        <ul class="nav collapse" id="subscription">
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('add-product-subscription') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Add Subscription Product</span>
                                                    </div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('admin.view.subscription') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">View Subscription</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ url('allProducts') }}">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">View Orders</span></div>
                                                </a><!-- more inner pages--></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#orders"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="orders">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Orders</span></div>
                                        </a><!-- more inner pages-->
                                        <ul class="nav collapse" id="orders">
                                            <li class="nav-item"><a class="nav-link" href="javascript:;">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Order list</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link" href="javascript:;">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Pending Orders</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link" href="javascript:;">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Shipped Orders</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link" href="javascript:;">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Delivered Orders</span></div>
                                                </a><!-- more inner pages--></li>
                                            <li class="nav-item"><a class="nav-link" href="javascript:;">
                                                    <div class="d-flex align-items-center"><span
                                                            class="nav-link-text ps-1">Rejected/Cancel Orders</span>
                                                    </div>
                                                </a><!-- more inner pages--></li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <!-- <li class="nav-item">
                   
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Dr Consultancy</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider" />
                        </div>
                    </div>
                   
                    <a class="nav-link dropdown-indicator" href="#dr" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dr">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dr consultancy</span>
                        </div>
                    </a>
                    <ul class="nav collapse" id="dr">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('view-doctors') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">View Dr</span></div>
                            </a>
                           
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('add-doctors') }}">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add Dr</span></div>
                            </a>
                           
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Appointment History</span></div>
                            </a>
                         
                        </li>


                    </ul>

                </li> -->

                            <li class="nav-item">
                                <!-- label-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">Global Use</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider" />
                                    </div>
                                </div>
                                <!-- parent pages-->
                                <a class="nav-link dropdown-indicator" href="#categorys" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="categorys">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">Categorys</span>
                                    </div>
                                </a>
                                <ul class="nav collapse" id="categorys">

                                 
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('categories.create') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Add Category</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('subcategory.create') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Add Sub-Category</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>


                                </ul>

                            </li>

                            <li class="nav-item">
                                <!-- label-->

                                <!-- parent pages-->
                                <a class="nav-link dropdown-indicator" href="#testimonials" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="dr">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">Testimonials</span>
                                    </div>
                                </a>
                                <ul class="nav collapse" id="testimonials">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('testimonials-list') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">List</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('testimonials-create') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Create</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>



                                </ul>

                            </li>
                            <li class="nav-item">

                                <a class="nav-link" href="{{ url('broadcasts') }}" role="button">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">Broadcasts</span></div>
                                </a>



                            </li>

                             <li class="nav-item">
                                <!-- label-->

                                <!-- parent pages-->
                                <a class="nav-link dropdown-indicator" href="#blogs" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="dr">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">Blog</span>
                                    </div>
                                </a>
                                <ul class="nav collapse" id="blogs">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('blogs-list') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">List</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('blog-create') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Create</span></div>
                                        </a>
                                        <!-- more inner pages-->
                                    </li>



                                </ul>

                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
                <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard"
                    aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                            class="toggle-line"></span></span></button>
                <a class="navbar-brand me-1 me-sm-3" href="index.html">
                    <div class="d-flex align-items-center"><img class="me-2"
                            src="assets/img/icons/spot-illustrations/falcon.png" alt=""
                            width="40" /><span class="font-sans-serif text-primary">falcon</span></div>
                </a>

            </nav>
            <div class="content">
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false"
                        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                                class="toggle-line"></span></span></button>
                    <a class="navbar-brand me-1 me-sm-3" href="index.html">
                        <div class="d-flex align-items-center"><img class="me-2"
                                src="assets/img/icons/spot-illustrations/falcon.png" alt=""
                                width="40" /><span class="font-sans-serif text-primary">falcon</span></div>
                    </a>

                    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">

                        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                                aria-labelledby="navbarDropdownUser">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    <a class="dropdown-item fw-bold text-warning" href="#!"><span
                                            class="fas fa-crown me-1"></span><span>Go Pro</span></a>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="javascript:;">Profile &amp; account</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:;">Settings</a>
                                    <a class="dropdown-item" href="javascript:;">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>

                <script>
                    var navbarPosition = localStorage.getItem('navbarPosition');
                    var navbarVertical = document.querySelector('.navbar-vertical');
                    var navbarTopVertical = document.querySelector('.content .navbar-top');
                    var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
                    var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
                    var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

                    if (localStorage.getItem('navbarPosition') === 'double-top') {
                        document.documentElement.classList.toggle('double-top-nav-layout');
                    }

                    if (navbarPosition === 'top') {
                        navbarTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTopCombo.remove(navbarTopCombo);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'combo') {
                        navbarVertical.removeAttribute('style');
                        navbarTopCombo.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'double-top') {
                        navbarDoubleTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTop.remove(navbarTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    } else {
                        navbarVertical.removeAttribute('style');
                        navbarTopVertical.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarDoubleTop.remove(navbarDoubleTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    }
                </script>
                @yield('content')
                <footer class="footer">
                    <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">Thank you for creating with Falcon <span
                                    class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2024 &copy; <a
                                    href="https://themewagon.com/">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v3.23.0</p>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog"
                aria-labelledby="authentication-modal-label" aria-hidden="true">
                <div class="modal-dialog mt-6" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                            <div class="position-relative z-1">
                                <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                                <p class="fs-10 mb-0 text-white">Please create your free Falcon account</p>
                            </div>
                            <div data-bs-theme="dark"><button
                                    class="btn-close position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal"
                                    aria-label="Close"></button></div>
                        </div>
                        <div class="modal-body py-4 px-5">
                            <form>
                                <div class="mb-3"><label class="form-label"
                                        for="modal-auth-name">Name</label><input class="form-control" type="text"
                                        autocomplete="on" id="modal-auth-name" /></div>
                                <div class="mb-3"><label class="form-label" for="modal-auth-email">Email
                                        address</label><input class="form-control" type="email" autocomplete="on"
                                        id="modal-auth-email" /></div>
                                <div class="row gx-2">
                                    <div class="mb-3 col-sm-6"><label class="form-label"
                                            for="modal-auth-password">Password</label><input class="form-control"
                                            type="password" autocomplete="on" id="modal-auth-password" /></div>
                                    <div class="mb-3 col-sm-6"><label class="form-label"
                                            for="modal-auth-confirm-password">Confirm Password</label><input
                                            class="form-control" type="password" autocomplete="on"
                                            id="modal-auth-confirm-password" /></div>
                                </div>
                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                        id="modal-auth-register-checkbox" /><label class="form-label"
                                        for="modal-auth-register-checkbox">I accept the <a href="#!">terms
                                        </a>and <a class="white-space-nowrap" href="#!">privacy
                                            policy</a></label></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                        name="submit">Register</button></div>
                            </form>
                            <div class="position-relative mt-5">
                                <hr />
                                <div class="divider-content-center">or register with</div>
                            </div>
                            <div class="row g-2 mt-2">
                                <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100"
                                        href="#"><span class="fab fa-google-plus-g me-2"
                                            data-fa-transform="grow-8"></span> google</a></div>
                                <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100"
                                        href="#"><span class="fab fa-facebook-square me-2"
                                            data-fa-transform="grow-8"></span> facebook</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->

    <div class="offcanvas offcanvas-end settings-panel border-0" id="settings-offcanvas" tabindex="-1"
        aria-labelledby="settings-offcanvas">
        <div class="offcanvas-header settings-panel-header justify-content-between bg-shape">
            <div class="z-1 py-1">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="text-white mb-0 me-2"><span class="fas fa-palette me-2 fs-9"></span>Settings</h5>
                    <button class="btn btn-primary btn-sm rounded-pill mt-0 mb-0" data-theme-control="reset"
                        style="font-size:12px"> <span class="fas fa-redo-alt me-1"
                            data-fa-transform="shrink-3"></span>Reset</button>
                </div>
                <p class="mb-0 fs-10 text-white opacity-75"> Set your own customized style</p>
            </div>
            <div class="z-1" data-bs-theme="dark"><button class="btn-close z-1 mt-0" type="button"
                    data-bs-dismiss="offcanvas" aria-label="Close"></button></div>
        </div>
        <div class="offcanvas-body scrollbar-overlay px-x1 h-100" id="themeController">
            <h5 class="fs-9">Color Scheme</h5>
            <p class="fs-10">Choose the perfect color mode for your app.</p>
            <div class="btn-group d-block w-100 btn-group-navbar-style">
                <div class="row gx-2">
                    <div class="col-4"><input class="btn-check" id="themeSwitcherLight" name="theme-color"
                            type="radio" value="light" data-theme-control="theme" /><label
                            class="btn d-inline-block btn-navbar-style fs-10" for="themeSwitcherLight"> <span
                                class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="assets/img/generic/falcon-mode-default.jpg" alt="" /></span><span
                                class="label-text">Light</span></label></div>
                    <div class="col-4"><input class="btn-check" id="themeSwitcherDark" name="theme-color"
                            type="radio" value="dark" data-theme-control="theme" /><label
                            class="btn d-inline-block btn-navbar-style fs-10" for="themeSwitcherDark"> <span
                                class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="assets/img/generic/falcon-mode-dark.jpg" alt="" /></span><span
                                class="label-text"> Dark</span></label></div>
                    <div class="col-4"><input class="btn-check" id="themeSwitcherAuto" name="theme-color"
                            type="radio" value="auto" data-theme-control="theme" /><label
                            class="btn d-inline-block btn-navbar-style fs-10" for="themeSwitcherAuto"> <span
                                class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0"
                                    src="assets/img/generic/falcon-mode-auto.jpg" alt="" /></span><span
                                class="label-text"> Auto</span></label></div>
                </div>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-start"><img class="me-2"
                        src="assets/img/icons/left-arrow-from-left.svg" width="20" alt="" />
                    <div class="flex-1">
                        <h5 class="fs-9">RTL Mode</h5>
                        <p class="fs-10 mb-0">Switch your language direction </p><a class="fs-10"
                            href="documentation/customization/configuration.html">RTL Documentation</a>
                    </div>
                </div>
                <div class="form-check form-switch"><input class="form-check-input ms-0" id="mode-rtl"
                        type="checkbox" data-theme-control="isRTL" /></div>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-start"><img class="me-2" src="assets/img/icons/arrows-h.svg"
                        width="20" alt="" />
                    <div class="flex-1">
                        <h5 class="fs-9">Fluid Layout</h5>
                        <p class="fs-10 mb-0">Toggle container layout system </p><a class="fs-10"
                            href="documentation/customization/configuration.html">Fluid Documentation</a>
                    </div>
                </div>
                <div class="form-check form-switch"><input class="form-check-input ms-0" id="mode-fluid"
                        type="checkbox" data-theme-control="isFluid" /></div>
            </div>
            <hr />
            <div class="d-flex align-items-start"><img class="me-2" src="assets/img/icons/paragraph.svg"
                    width="20" alt="" />
                <div class="flex-1">
                    <h5 class="fs-9 d-flex align-items-center">Navigation Position</h5>
                    <p class="fs-10 mb-2">Select a suitable navigation system for your web application </p>
                    <div><select class="form-select form-select-sm" aria-label="Navbar position"
                            data-theme-control="navbarPosition">
                            <option value="vertical">Vertical</option>
                            <option value="top">Top</option>
                            <option value="combo">Combo</option>
                            <option value="double-top">Double Top</option>
                        </select></div>
                </div>
            </div>
            <hr />
            <h5 class="fs-9 d-flex align-items-center">Vertical Navbar Style</h5>
            <p class="fs-10 mb-0">Switch between styles for your vertical navbar </p>
            <p> <a class="fs-10" href="modules/components/navs-and-tabs/vertical-navbar.html#navbar-styles">See
                    Documentation</a></p>
            <div class="btn-group d-block w-100 btn-group-navbar-style">
                <div class="row gx-2">
                    <div class="col-6"><input class="btn-check" id="navbar-style-transparent" type="radio"
                            name="navbarStyle" value="transparent" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-transparent"> <img
                                class="img-fluid img-prototype" src="assets/img/generic/default.png"
                                alt="" /><span class="label-text"> Transparent</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-inverted" type="radio"
                            name="navbarStyle" value="inverted" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-inverted"> <img
                                class="img-fluid img-prototype" src="assets/img/generic/inverted.png"
                                alt="" /><span class="label-text"> Inverted</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-card" type="radio"
                            name="navbarStyle" value="card" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-card"> <img
                                class="img-fluid img-prototype" src="assets/img/generic/card.png"
                                alt="" /><span class="label-text"> Card</span></label></div>
                    <div class="col-6"><input class="btn-check" id="navbar-style-vibrant" type="radio"
                            name="navbarStyle" value="vibrant" data-theme-control="navbarStyle" /><label
                            class="btn d-block w-100 btn-navbar-style fs-10" for="navbar-style-vibrant"> <img
                                class="img-fluid img-prototype" src="assets/img/generic/vibrant.png"
                                alt="" /><span class="label-text"> Vibrant</span></label></div>
                </div>
            </div>
            <div class="text-center mt-5"><img class="mb-4" src="assets/img/icons/spot-illustrations/47.png"
                    alt="" width="120" />
                <h5>Like What You See?</h5>
                <p class="fs-10">Get Falcon now and create beautiful dashboards with hundreds of widgets.</p><a
                    class="mb-3 btn btn-primary"
                    href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/"
                    target="_blank">Purchase</a>
            </div>
        </div>
    </div>


    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('vendors/is/is.min.js') }}"></script>
    <!-- for product view -->
    <script src="{{ asset('vendors/swiper/swiper-bundle.min.js') }} "></script>
    <!--=========== end product view=========================================-->
    <script src="{{ asset('vendors/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>






    <script>
     
    </script>
</body>

</html>
