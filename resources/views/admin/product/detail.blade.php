@extends('admin.Layouts.master')

@section('title', 'Product')

@section('header')
    <h3>Product Details Page</h3>
@endsection

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 offset-3">
                        @if (session('updateSuccess'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <h6> {{ session('updateSuccess') }}</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-3 offset-1 ps-5">
                        <a href="{{ route('product#listPage') }}"><button
                                class="btn bg-dark text-white px-5 my-3  shadow"><i class="fa-solid fa-left-long me-2"></i>List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1 ">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Details</h3>
                            </div>
                            <hr/>
                        </div>
                        <div class="row px-3 mb-5">
                            <div class="col-lg-3 offset-1 text-center">
                                <div class="shadow">
                                    <img src="{{ asset('storage/'.$data->image) }}" class="img-thumbnail " alt="">
                                </div>
                                <h6 class="mt-4 btn btn-dark">View - {{ $data->view_count }}</h6>
                            </div>
                            <div class="col-lg-7 offset-1">
                                <h4 ><b class="bg-danger py-1 px-4 rounded text-white">{{ $data->name }}</b></h4>
                                <div class="d-flex mt-4">
                                    <h6><i class="bg-dark py-1 px-3 rounded text-white me-2">{{ $data->category_name }}</i></h6>
                                    <h6><i class="bg-dark py-1 px-3 rounded text-white me-2">{{ $data->price }}<b class="ms-2">Ks</b></i></h6>
                                    <h6><i class="bg-dark py-1 px-3 rounded text-white me-2">{{ $data->waiting_time }}<b class="ms-2">min</b></i></h6>
                                    <h6><i class="bg-dark py-1 px-3 rounded text-white me-2">{{ $data->updated_at->format('j - m - Y') }}</i></h6>
                                </div>
                                <p class="border border-dark text-muted p-3 rounded mt-4 me-5">{{ $data->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 offset-9 ps-5 ">
                        <a href="{{ route('product#updatePage',$data->id) }}">
                            <button class="btn bg-dark text-white px-5 shadow"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
