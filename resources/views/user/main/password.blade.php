@extends('user.Layouts.master')

@section('title','Additional Setting')

@section('cssContent')
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

@endsection

@section('text','text-warning')

@section('bg','bg-warning')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('customer#homePage') }}"><button class="btn bg-dark text-white my-3">Home</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Change Password</h3>
                </div>
                <hr>
                <form action="{{ route('customer#changePassword') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                        <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                        @error('oldPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                        @if (session('notMatch'))
                            <small class="invalid-feedback">{{ session('notMatch') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-4">
                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                        <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                        @error('newPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                        <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Password...">
                        @error('confirmPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Save</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
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
