@extends('admin.Layouts.master')

@section('title','Additional Setting')

@section('header')
    <h3>Password</h3>
@endsection

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('category#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            <form action="{{ route('account#passwordChange') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                                    @error('oldPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    @if (session('notMatch'))
                                        <small class="invalid-feedback">{{ session('notMatch') }}</small>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                                    @error('newPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                                    @error('confirmPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="my-3">
                                    <button id="payment-button" type="submit" class="btn btn-info col-12 ">
                                        <span id="payment-button-amount">Save</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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
