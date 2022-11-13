@extends('admin.Layouts.master')

@section('title', 'Profile')

@section('header')
    <h3>My Profile</h3>
@endsection

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 offset-3">
                        @if (session('updateSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h6> {{ session('updateSuccess') }}</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-3 offset-1 ps-5">
                        <a href="{{ route('category#listPage') }}"><button
                                class="btn bg-dark text-white px-5 my-3  shadow"><i class="fa-solid fa-left-long me-2"></i>List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Profile Details</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="row px-3  ">
                        <div class="card shadow col-lg-3">
                            <div class="card-body">
                                <div class="card-title">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/no_user.jpg') }}" alt="Cool Admin" />
                                        @else
                                            <img src="{{ asset('image/default_user_female.jpg') }}" alt="Cool Admin"/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card shadow col-lg-8 offset-1">
                            <div class="card-body">
                                <div class="card-title mt-3">
                                    <div class="ms-3 mb-2">
                                        <h5 class="em-box me-5 d-inline-block text-muted"><em>Name</em></h5>-<h5
                                            class="ms-5 d-inline-block"> {{ Auth::user()->name }}</h5>
                                    </div>
                                    <div class="ms-3 mb-2">
                                        <h5 class="em-box me-5 d-inline-block text-muted"><em>Email</em></h5>-<h5
                                            class="ms-5 d-inline-block"> {{ Auth::user()->email }}</h5>
                                    </div>
                                    <div class="ms-3 mb-2">
                                        <h5 class="em-box me-5 d-inline-block text-muted"><em>Phone</em></h5>-<h5
                                            class="ms-5 d-inline-block"> {{ Auth::user()->phone }}</h5>
                                    </div>
                                    <div class="ms-3 mb-2">
                                        <h5 class="em-box me-5 d-inline-block text-muted"><em>Gender</em></h5>-<h5
                                            class="ms-5 d-inline-block"> {{ Auth::user()->gender }}</h5>
                                    </div>
                                    <div class="ms-3 mb-2">
                                        <h5 class="em-box me-5 d-inline-block text-muted"><em>Address</em></h5>-<h5
                                            class="ms-5 d-inline-block"> {{ Auth::user()->address }}</h5>
                                    </div>
                                    <div class="ms-3 mb-2">
                                        <h5 class="em-box me-5 d-inline-block text-muted"><em>Created Date</em></h5>-<h5
                                            class="ms-5 d-inline-block"> {{ Auth::user()->created_at->format('j - F - Y') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 offset-9 ps-5 ">
                        <a href="{{ route('account#editProfilePage') }}"><button
                                class="btn bg-dark text-white px-5 my-3 shadow"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
