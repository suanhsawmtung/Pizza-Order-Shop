<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('user/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('cssContent')

</head>

<body class="">
    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-8  ">
            <div class="col-lg-4 text-center d-flex align-items-center">
                <div class="col-10">
                    <span class="h1 text-uppercase @yield('text') bg-dark px-2">AUGUSTINE</span>
                    <span class="h1 text-uppercase text-dark @yield('bg') px-2 ml-n1">Pizza</span>
                </div>
            </div>
            <div class="col-lg-4 ">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('customer#homePage') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('cart#cartList') }}" class="nav-item nav-link">My Cart</a>
                            <a href="{{ route('contact#contactFormPage') }}" class="nav-item nav-link">Contact</a>
                        </div>
                        {{-- <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        </div> --}}
                    </div>
                </nav>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-6 offset-5 d-none d-lg-block" >
                    <a class="btn d-flex align-items-center justify-content-between @yield('bg') w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                        @if (Auth::user()->image == null)
                            @if (Auth::user()->gender == 'male')
                                <img src="{{ asset('image/no_user.jpg') }}" style="width: 60px" class="img-thumbnail "
                                    alt="Cool Admin" />
                            @else
                                <img src="{{ asset('image/default_user_female.jpg') }}" style="width: 60px"
                                    class="img-thumbnail " alt="Cool Admin" />
                            @endif
                        @else
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" style="width: 60px; max-height:65px"
                                class="img-thumbnail " alt="">
                        @endif
                        <h6 class="text-dark m-0">{{ Auth::user()->name }}</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                        <div class="navbar-nav w-100">
                            <div class="nav-item dropdown my-3 pb-2 border-bottom border-dark">
                                <a href="{{ route('customer#profilePage') }}" class="px-3 text-dark nav-item"  >
                                    <i class="fa-solid fa-user"></i><b class="mx-4"> View Profile</b>
                                </a>
                            </div>
                            <div class="nav-item dropdown my-3 pb-2 border-bottom border-dark">
                                <a href="{{ route('customer#passwordPage') }}" class="px-3 text-dark nav-item " >
                                    <i class="fa-solid fa-key"></i><b class="mx-4"> Change Password</b>
                                </a>
                            </div>
                            <div class="nav-item dropdown pb-1 mb-3 text-center">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-dark text-light text-center px-3 rounded">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <section style="min-height: 100vh">@yield('content')</section>

    @yield('footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-warning back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    {{-- <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('user/mail/contact.js') }}"></script> --}}

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>

    @yield('forJquery')
    @yield('jqueryOperation')
</body>

</html>
