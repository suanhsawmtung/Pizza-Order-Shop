@extends('admin.Layouts.master')

@section('title', 'Additional Setting')

@section('header')
    <h3>Change Account Informations</h3>
@endsection

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 offset-8">
                        <a href="{{ route('account#profilePage') }}"><button class="btn bg-dark text-white mb-3"><i
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
                            <form action="{{ route('account#editProfile',Auth::user()->id) }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group mb-3">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                value="{{ old('name', Auth::user()->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                            @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Phone...">
                                            @error('phone')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select class="form-select"  id="cc-pament" name="gender" aria-label="Default select example">
                                                <option selected>Select Gender...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
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
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="">
                                            @endif
                                            <div class="form-group mb-3">
                                                <input id="cc-pament" name="image" type="file"
                                                    class="form-control shadow @error('image') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false">
                                                @error('image')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="ms-5 mt-4 form-group mb-3">
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
                                                class="btn btn-info col-12 shadow">
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
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
