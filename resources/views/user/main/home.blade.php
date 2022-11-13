@extends('user.Layouts.master')

@section('title','AugustineShop - Pizza Order Website')

@section('text','text-primary')

@section('bg','bg-primary')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span
                        class="bg-secondary pr-3">Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('customer#homePage') }}" class="text-dark">
                                <h4 class="me-1 pb-2 d-inline-block border-bottom" style="width: 300px">
                                    All Category</h4>
                                <small class="text-center"><i class="fa-solid fa-angle-right"></i></small>
                            </a>
                        </div>
                        @foreach ($categories as $category)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('product#filterList',$category->id) }}" class="text-dark">
                                    <h4 class="me-1 pb-2 d-inline-block border-bottom" style="width: 300px">
                                        {{ $category->name }}</h4>
                                    <small class="text-center"><i class="fa-solid fa-angle-right"></i></small>
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div >
                                <a href="{{ route('cart#cartList') }}" >
                                    <button type="button" class="btn btn-light position-relative" title="Cart List">
                                        <i class="fa-sharp fa-solid fa-cart-plus"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                            {{ count($carts) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('order#orderHistory') }}" style="margin-left: 10px">
                                    <button type="button" class="btn btn-light position-relative"  title="Order history">
                                        <i class="fa-sharp fa-solid fa-list"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                            {{ count($orders) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('contact#directReplyFromAdminPage') }}" style="margin-left: 10px" >
                                    <button type="button" class="btn btn-light position-relative" title="Reply messages from admin">
                                        <i class="fa-regular fa-bell"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                            {{ count($replies) }}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="asc">Sorting</option>
                                        <option value="desc">Latest</option>
                                        <option value="popular">Popularity</option>
                                        <option value="bestRate">Best Rating</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row" id="dataList">
                       @if (count($products) != 0 )
                            @foreach ($products as $product)
                            <div class="col-sm-4 pb-1" id="parent" >
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden rounded" style="height: 250px">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('storage/' . $product->image) }}" alt="">
                                        <div class="product-action">
                                            <input type="hidden" value="{{ $product->id }}" id="pizza">
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('cart#addOneItemToCart',$product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" id="love" href="{{ route('rating#reactLove',$product->id) }}"><i class="far fa-heart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('product#productDetailPage',$product->id) }}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $product->price }} kyats</h5>
                                        </div>
                                        @if ($product->rating_count != 0)
                                        <div class="d-flex align-items-center justify-content-center mb-1 text-primary">
                                            {{ $product->rating_count }}<small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                       @else
                          <h3 class="text-muted">There is no Pizza.</h3>
                       @endif
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('footer')
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                    dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop
                                Detail</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                {{-- <img class="img-fluid" src="img/payments.png" alt=""> --}}
            </div>
        </div>
    </div>
    <!-- Footer End -->
@endsection

@section('forJquery')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('jqueryOperation')
    <script>
        $(document).ready(function(){

            $('#sortingOption').change(function(){
                $optionValue = $('#sortingOption').val();

                if($optionValue == 'asc'){
                    $.ajax({
                        type: 'get',
                        url: '/ajax/pizzaList' ,
                        data: {'status':'asc'},
                        dataType: 'json',
                        success: function(response){
                            $list = '';
                            if(response.length != 0) {
                                for($i=0;$i<response.length;$i++){
                                    $list += `
                                    <a href="detail.html">
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden rounded">
                                                    <img class="img-fluid w-100" style="height: 250px"
                                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                    <div class="product-action">
                                                        <input type="hidden" value="{{ $product->id }}" id="pizza">
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('cart#addOneItemToCart',$product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('rating#reactLove',$product->id) }}"><i class="far fa-heart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('product#productDetailPage',$product->id) }}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href="">${response[$i].name}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price} kyats</h5>
                                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-1 text-primary">
                                                        ${response[$i].rating_count}<small class="fa fa-star text-primary mr-1"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    `;
                                }
                                $('#dataList').html($list);
                            }
                        }

                    });
                }else if($optionValue == 'desc'){
                    $.ajax({
                        type: 'get',
                        url: '/ajax/pizzaList',
                        data: {'status':'desc'},
                        dataType: 'json',
                        success: function(response){
                            $list = '';
                            if(response.length != 0){
                                for($i=0;$i<response.length;$i++){
                                    $list += `
                                    <a href="detail.html">
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden rounded">
                                                    <img class="img-fluid w-100" style="height: 250px"
                                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('cart#addOneItemToCart',$product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('rating#reactLove',$product->id) }}"><i class="far fa-heart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('product#productDetailPage',$product->id) }}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href="">${response[$i].name}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price} kyats</h5>
                                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-1 text-primary">
                                                        ${response[$i].rating_count}<small class="fa fa-star text-primary mr-1"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    `;
                                }
                                $('#dataList').html($list);
                            }
                        }
                    })
                }else if($optionValue == 'popular'){
                    $.ajax({
                        type: 'get',
                        url: '/ajax/pizzaList',
                        data: {'status':'popular'},
                        dataType: 'json',
                        success: function(response){
                            $list = '';
                            if(response.length != 0){
                                for($i=0;$i<response.length;$i++){
                                    $list += `
                                    <a href="detail.html">
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden rounded">
                                                    <img class="img-fluid w-100" style="height: 250px"
                                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('cart#addOneItemToCart',$product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('rating#reactLove',$product->id) }}"><i class="far fa-heart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('product#productDetailPage',$product->id) }}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href="">${response[$i].name}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price} kyats</h5>
                                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-1 text-primary">
                                                        ${response[$i].rating_count}<small class="fa fa-star text-primary mr-1"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    `;
                                }
                                $('#dataList').html($list);
                            }
                        }
                    })
                }else if($optionValue == 'bestRate'){
                    $.ajax({
                        type: 'get',
                        url: '/ajax/pizzaList',
                        data: {'status':'bestRate'},
                        dataType: 'json',
                        success: function(response){
                            $list = '';
                            if(response.length != 0){
                                for($i=0;$i<response.length;$i++){
                                    $list += `
                                    <a href="detail.html">
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden rounded">
                                                    <img class="img-fluid w-100" style="height: 250px"
                                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('cart#addOneItemToCart',$product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('rating#reactLove',$product->id) }}"><i class="far fa-heart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href="{{ route('product#productDetailPage',$product->id) }}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href="">${response[$i].name}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price} kyats</h5>
                                                        <h6 class="text-muted ml-2"><del>25000</del></h6>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center mb-1 text-primary">
                                                        ${response[$i].rating_count}<small class="fa fa-star text-primary mr-1"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    `;
                                }
                                $('#dataList').html($list);
                            }
                        }
                    })
                }
            });

            $('#love').click(function(){
                if($('#love').hasClass('bg-danger')){
                    $('#love').removeClass('bg-danger');
                }else {
                    $('#love').addClass('bg-danger');
                }
            });
        });

    </script>
@endsection
