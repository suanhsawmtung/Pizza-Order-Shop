@extends('user.Layouts.master')

@section('text','text-primary')

@section('bg','bg-primary')

@section('content')

<div class="row mb-2">
    <div class="col-4" style="margin-left: 62px">
        <a href="{{ route('customer#homePage') }}" class="btn btn-dark w-50 text-center">
            <i class="fa-solid fa-left-long me-2" style="margin-right: 15px"></i>Back to home page
        </a>
    </div>
</div>

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100 img-thumbnail rounded" src="{{ asset('storage/'.$productInfo->image) }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{ $productInfo->name }}</h3>
                <div class="d-flex mb-3 align-content-center">
                    @if ($productInfo->rating_count != 0)
                    <h5 class="pt-1 mr-2 text-warning">( <small class="far fa-star "></small> {{ $productInfo->rating_count }} )</h5>
                    @endif
                    <h5 class="pt-1 mr-2">( <i class="fa-solid fa-eye"></i> {{ $productInfo->view_count + 1 }} )</h5>
                    @if ($productInfo->react_count != 0)
                    <h5 class="pt-1">( <i class="fa-sharp fa-solid fa-heart text-danger"></i> {{ $productInfo->react_count }} )</h5>
                    @endif
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{ $productInfo->price }} Kyats</h3>
                <p class="mb-4">{{ $productInfo->description }}</p>
                <input type="hidden" value="{{ $productInfo->id }}" id="pizzaId">
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-warning btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-muted bg-secondary border-0 text-center" id="pizzaCount" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-warning btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning px-3" id="addToCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-3">Reviews ({{count($totalReview)}})</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">Reviews for this Product</h4>
                                <div style="overflow-y: scroll;max-height:533px">
                                    @foreach ($ratingData as $data)
                                    <div class="col-12 card mb-2 me-4">
                                        <div class="media mb-4 card-body">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/no_user.jpg') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px">
                                                @elseif (Auth::user()->gender == 'female')
                                                    <img src="{{ asset('image/default_user_female.jpg') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$data->user_image) }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 50px">
                                            @endif
                                            <div class="media-body">
                                                <h5>{{ $data->user_name }}<small> - <i>{{ $data->created_at->format('M j, Y  g:i A') }}</i></small></h5>
                                                @if ($data->product_rate != 0)
                                                <div class="text-warning mb-2">
                                                    {{$data->product_rate}}<i class="fas fa-star"></i>
                                                </div>
                                                @endif
                                                <p class="text-muted">{{ $data->review }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-warning" id="starParent">
                                        <select name="rate" id="rate">
                                            <option value="0" @if ($firstRatingData == "0") selected @endif>0</option>
                                            <option value="1" @if ($firstRatingData == "1") selected @endif>1</option>
                                            <option value="2" @if ($firstRatingData == "2") selected @endif>2</option>
                                            <option value="3" @if ($firstRatingData == "3") selected @endif>3</option>
                                            <option value="4" @if ($firstRatingData == "4") selected @endif>4</option>
                                            <option value="5" @if ($firstRatingData == "5") selected @endif>5</option>
                                        </select>
                                    </div>
                                </div>
                                <form action="{{ route('rating#review') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="productId" id="productId" value="{{ $productInfo->id }}">
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" name="review" cols="30" rows="5" class="form-control @error('review') is-invalid @enderror"></textarea>
                                        @error('review')
                                            <small  class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                                        @error('name')
                                            <small  class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                                        @error('email')
                                            <small  class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-warning px-3" id="leaveReview">Leave Your Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>//
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
           <div class="owl-carousel related-carousel">
                @foreach ($allProduct as $eachProduct)
                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden" style="height: 250px">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$eachProduct->image) }}" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="{{ route('cart#addOneItemToCart',$eachProduct->id) }}"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ route('rating#reactLove',$eachProduct->id) }}"><i class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ route('product#productDetailPage',$eachProduct->id) }}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{ $eachProduct->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{ $eachProduct->price }}Kyats</h5>
                        </div>
                        @if ($eachProduct->rating_count != 0)
                        <div class="d-flex align-items-center justify-content-center mb-1 text-warning">
                            <small class=" mr-1">{{ $eachProduct->rating_count }}</small>
                            <small class="fa fa-star text-warning mr-1"></small>
                            {{-- <small>( {{ $eachProduct->rated_users }} )</small> --}}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->



@endsection

@section('forJquery')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('jqueryOperation')
<script>
    $(document).ready(function(){

        $rate = 0;

        $.ajax({
            type: 'get',
            url: '/ajax/viewCount',
            data: {"pizzaId" : $("#pizzaId").val()},
            dataType: 'json'
        })

        $('#addToCart').click(function(){
            $addToCardData = {
                pizzaId : $('#pizzaId').val(),
                count : $('#pizzaCount').val()
            };

            $.ajax({
                type : 'get',
                url : '/ajax/addToCart',
                data : $addToCardData,
                dataType : 'json',
                success : function(response){
                    if(response.status == 'success'){
                        window.location.href = 'http://127.0.0.1:8000/customer/homePage';
                    }
                }
            })
        })

        $('#rate').change(function(){
            $rate = $(this).val();
            $productId = $('#productId').val();

            if ($rate != 0) {
                $.ajax({
                    type : 'get' ,
                    url : '/ajax/rateProduct' ,
                    data : { "rating" : $rate , "productId" : $productId } ,
                    dataType : 'json' ,
                    success : function(response){
                        if(response["status"] == true){
                            location.reload();
                        }
                    }
                })
            }




        })
    })
</script>
@endsection
