@extends('user.Layouts.master')

@section('text','text-primary')

@section('bg','bg-primary')

@section('content')

<div class="row mb-2">
    <div class="col-4" style="margin-left: 62px">
        <a href="{{ route('customer#homePage') }}" class="text-dark w-50 text-center">
            <i class="fa-solid fa-left-long me-2" style="margin-right: 15px"></i>Back to home page
        </a>
    </div>
</div>

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="parentBody">
                    @foreach ($carts as $cart)
                    <tr>
                        <td><img src="{{ asset('storage/'.$cart->product_image) }}" class="img-thumbnail" style="width: 100px;"></td>
                        <td class="align-middle">
                            {{ $cart->product_name }}
                            <input type="hidden" id="cartId" value="{{ $cart->id }}">
                            <input type="hidden" value="{{ $cart->user_id }}" id="userId">
                            <input type="hidden" value="{{ $cart->product_id }}" id="productId">
                        </td>
                        <td class="align-middle" id="price">{{ $cart->product_price }} Kyats</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $cart->quantity }}" id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{ $cart->product_price*$cart->quantity }} Kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger remove" id=""><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="totalPrice">{{$total}} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery Fee</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="totalFinalPrice">{{ $total+3000 }} Kyats</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="addOrderList">Add Order</button>
                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="removeCartLists">Remove Cart Lists</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
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
<script src="{{ asset('js/carts.js') }}"></script>

<script>
$('#addOrderList').click(function(){
    $orderData = [];
    $random = Math.floor(Math.random() * 10000001);
    $('#parentBody tr').each(function(index,row){
        $orderData.push({
            'user_id' : $(row).find('#userId').val(),
            'product_id' : $(row).find('#productId').val(),
            'quantity' : $(row).find('#qty').val(),
            'total_price' : $(row).find('#total').text().replace('Kyats',' ')*1,
            'order_code' : 'SSTMTC'+$random
        })
    })


    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1:8000/ajax/orderList',
        data: Object.assign({}, $orderData),
        dataType: 'json',
        success: function(response){
            if(response.status == true){
                window.location.href = 'http://127.0.0.1:8000/customer/homePage'
            }
        }
    })
})

$('#removeCartLists').click(function(){
    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1:8000/ajax/removeCartLists',
        dataType: 'json',
    })
    $('#parentBody tr').remove();
    $('#totalPrice').html('0 Kyats');
    $('#totalFinalPrice').html('3000 Kyats');
})

$('.remove').click(function() {
    $parentNode = $(this).parents('tr');
    $idForCart = $parentNode.find('#cartId').val();
    $idForProduct = $parentNode.find('#productId').val();
    $parentNode.remove();
    $finalResult = 0;
    $('#parentBody tr').each(function(index, row) {
        $finalResult += Number($(row).find('#total').text().replace('Kyats', ' '));
    })
    $('#totalPrice').html(`${$finalResult} Kyats`);
    $('#totalFinalPrice').html(`${$finalResult+3000} Kyats`);

    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1:8000/ajax/removeEachCart',
        data:{ 'cartId': $idForCart ,'productId':$idForProduct  },
        dataType: 'json',
    })
})
</script>

@endsection





