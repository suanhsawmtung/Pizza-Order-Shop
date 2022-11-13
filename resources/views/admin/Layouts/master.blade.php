<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    {{-- <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all"> --}}

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{ route('category#listPage') }}">
                                <i class="fas fa-chart-bar"></i>Categories
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{ route('product#listPage') }}">
                                <i class="fas fa-chart-bar"></i>Products</a>
                        </li>
                        <li  class="active has-sub">
                            <a href="{{ route('order#orderListPage') }}" class="js-arrow">
                                <i class="fas fa-chart-bar"></i>Orders</a>
                        </li>
                        <li  class="active has-sub">
                            <a href="{{ route('contact#allMessagePage') }}" class="js-arrow">
                                <i class="fas fa-chart-bar"></i>Contacts</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            @yield('header')
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity" id="quantity"></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title" id="notiCount"></div>
                                            <a href="{{ route('contact#contactListPage') }}" id="messageNoti">
                                                <div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <i class="zmdi zmdi-email-open"></i>
                                                    </div>
                                                    <div class="content" id="messageContent"></div>
                                                </div>
                                            </a>
                                            <a href="{{ route('order#newOrders') }}" id="orderNoti">
                                                <div class="notifi__item">
                                                    <div class="bg-c3 img-cir img-40">
                                                        <i class="zmdi zmdi-file-text"></i>
                                                    </div>
                                                    <div class="content" id="orderContent"></div>
                                                </div>
                                            </a>
                                            <div class="d-flex justify-content-center align-content-center" id="noNoti">
                                                <p>There is no new notifications.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/no_user.jpg') }}" alt="Cool Admin" />
                                                @else
                                                    <img src="{{ asset('image/default_user_female.jpg') }}"
                                                        alt="Cool Admin" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if (Auth::user()->image == null)
                                                            @if (Auth::user()->gender == 'male')
                                                                <img src="{{ asset('image/no_user.jpg') }}"
                                                                    alt="Cool Admin" />
                                                            @else
                                                                <img src="{{ asset('image/default_user_female.jpg') }}"
                                                                    alt="Cool Admin" />
                                                            @endif
                                                        @else
                                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                                style="object-fit:cover;object-position:center">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('account#profilePage') }}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('account#accountListPage') }}">
                                                        <i class="zmdi zmdi-account"></i>User List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('account#passwordChangePage') }}">
                                                        <i class="fa-solid fa-key"></i>Change Password
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{ route('logout') }}" method="POST"
                                                    class=" my-3 d-flex justify-content-center">
                                                    @csrf
                                                    <button class="btn btn-dark text-white col-8" type="submit">Log
                                                        Out</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            @yield('content')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    {{-- <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script> --}}
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    @yield('link')
    @yield('scriptSection')

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $('#noNoti').css("display","none");
        $('#messageNoti').css("display","none");
        $('#orderNoti').css("display","none");
        $('#messageCount').css("display","none");
        $('#quantity').css("display","none");
        $inner = ``;
        $count = ``;

        $.ajax({
            type: 'get',
            url: 'http://127.0.0.1:8000/contact/notiForAdmin',
            dataType: 'json',
            success: function(response){

                if(response.notiMessages.length != 0 || response.notiOrders.length != 0){
                    $totalCount = response.notiMessages.length + response.notiOrders.length;
                    $count = `<p>You have ${$totalCount} new Notifications</p>`;

                    $('#messageCount').css("display","block");
                    $('#notiCount').html($count);
                    $('#quantity').text($totalCount);
                    $('#quantity').css("display","block");

                    $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                    $dbDate = new Date(response.notiOrders[0].created_at);
                    $orderDate =  $months[$dbDate.getMonth()] + " " +  $dbDate.getDate() + ", " + $dbDate.getFullYear();

                    if(response.notiMessages.length != 0){
                        $('#messageNoti').css("display","block");
                        // var messageDate = Moment().format('MMM d, yyyy - hh:mm tt')
                        $inner = `
                            <p id="message">You got ${response.notiMessages.length} new message notification</p>
                            <span id="messageDate">${response.notiMessages[0].created_at}</span>
                        `;
                        $('#messageContent').html($inner);

                    }

                    if(response.notiOrders.length != 0){
                        $('#orderNoti').css("display","block");
                        $inner = `
                            <p id="message">You got ${response.notiOrders.length} new order notification</p>
                            <span id="messageDate">${$orderDate}</span>
                        `;
                        $('#orderContent').html($inner);
                    }

                }else{
                    $('#noNoti').css("display","block");
                }
            }
        })
    })
</script>
</html>
<!-- end document-->
