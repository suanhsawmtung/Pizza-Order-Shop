@extends('user.Layouts.master')

@section('cssContent')
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

@endsection

@section('text','text-warning')

@section('bg','bg-warning')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-8">
                <a href="{{ route('customer#profilePage') }}"><button class="btn bg-dark text-white mb-3"><i
                            class="fa-solid fa-left-long me-2"></i>Back to Profile Page</button></a>
            </div>
        </div>
        <div class="col-lg-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Change Account Informations Form</h3>
                    </div>
                    <hr>
                    <form action="{{ route('customer#updateProfile') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" type="text"
                                        value="{{ old('name', Auth::user()->name) }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Email</label>
                                    <input id="cc-pament" name="email" type="text"
                                        value="{{ old('email', Auth::user()->email) }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Phone</label>
                                    <input id="cc-pament" name="phone" type="number"
                                        value="{{ old('phone', Auth::user()->phone) }}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Phone...">
                                    @error('phone')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Gender</label>
                                    <select class="form-select"  id="cc-pament" name="gender" aria-label="Default select example">
                                        <option selected>Select Gender...</option>
                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Address</label>
                                    <textarea id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Address...">{{ old('address', Auth::user()->address) }}</textarea>
                                    @error('address')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="ms-5 mt-2 rounded">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/no_user.jpg') }}" class="img-thumbnail shadow"
                                            style="width:100%" alt="Cool Admin"/>
                                        @else
                                            <img src="{{ asset('image/default_user_female.jpg') }}" class="img-thumbnail shadow"
                                            style="width:100%" alt="Cool Admin"/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" style="width:100%" class="img-thumbnail " alt="">
                                    @endif
                                    <div class="form-group">
                                        <input id="cc-pament" name="image" type="file"
                                            class="form-control @error('image') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('image')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="ms-5 mt-4 form-group">
                                    <input id="cc-pament" name="role" type="text"
                                        value="{{ Auth::user()->role }}"
                                        class="form-control @error('role') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" disabled>
                                    @error('role')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="ms-5 mt-4">
                                    <button id="payment-button" type="submit"
                                        class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('jsContent')
     <!-- JavaScript Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@endpush
