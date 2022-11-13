@extends('user.Layouts.master')

@section('title','User Profile')

@section('cssContent')
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

@endsection

@section('text','text-warning')

@section('bg','bg-warning')

@section('content')
    <!-- MAIN CONTENT-->
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
                <a href="{{ route('customer#homePage') }}"><button
                        class="btn bg-dark text-white px-5 my-3  shadow"><i class="fa-solid fa-left-long me-2"></i>home</button></a>
            </div>
        </div>
        <div class="col-lg-10 offset-1">
            <div class="card shadow ">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center pb-3 border-bottom border-muted">Profile Details</h3>
                    </div>
                    <div class="row px-3 py-4">
                        <div class="col-lg-4 offset-1 text-center">
                            <div class="card-title">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/no_user.jpg') }}" class="img-thumbnail shadow" alt="Cool Admin" />
                                        @else
                                            <img src="{{ asset('image/default_user_female.jpg') }}" class="img-thumbnail shadow" alt="Cool Admin"/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow" alt="">
                                    @endif
                            </div>
                        </div>
                        <div class="col-lg-6 offset-1">
                            <div class="card-title mt-3">
                                <div class="ms-3 mb-3">
                                    <h4 class="me-5 d-inline-block text-muted" style="width: 180px"><em>Name</em></h4>-<h4
                                        class="ms-5 d-inline-block"> {{ Auth::user()->name }}</h4>
                                </div>
                                <div class="ms-3 mb-3">
                                    <h4 class="me-5 d-inline-block text-muted" style="width: 180px"><em>Email</em></h4>-<h4
                                        class="ms-5 d-inline-block"> {{ Auth::user()->email }}</h4>
                                </div>
                                <div class="ms-3 mb-3">
                                    <h4 class="me-5 d-inline-block text-muted" style="width: 180px"><em>Phone</em></h4>-<h4
                                        class="ms-5 d-inline-block"> {{ Auth::user()->phone }}</h4>
                                </div>
                                <div class="ms-3 mb-3">
                                    <h4 class="me-5 d-inline-block text-muted" style="width: 180px"><em>Gender</em></h4>-<h4
                                        class="ms-5 d-inline-block"> {{ Auth::user()->gender }}</h4>
                                </div>
                                <div class="ms-3 mb-3">
                                    <h4 class="me-5 d-inline-block text-muted" style="width: 180px"><em>Address</em></h4>-<h4
                                        class="ms-5 d-inline-block"> {{ Auth::user()->address }}</h4>
                                </div>
                                <div class="ms-3 mb-3">
                                    <h4 class="me-5 d-inline-block text-muted" style="width: 180px"><em>Created Date</em></h4>-<h4
                                        class="ms-5 d-inline-block"> {{ Auth::user()->created_at->format('j - F - Y') }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-title mt-3 col-lg-3 offset-8">
                                    <a href="{{ route('customer#editProfile') }}"><button
                                            class="btn bg-dark text-white px-5 my-3 rounded shadow"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>

    <!-- END MAIN CONTENT-->
@endsection

@push('jsContent')
     <!-- JavaScript Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@endpush
