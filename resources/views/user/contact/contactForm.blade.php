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
    @if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show col-4 " role="alert">
        <strong>{{ session('warning') }}</strong>
    </div>
    @endif
</div>

<div class="container mt-5">
    <div class="row ">
        <div class="col-6 bg-warning p-5">
            <h3 class="mb-2 mt-5">CONTACT US?</h3>
            <h3 class="mb-2">QUESTIONS?</h3>
            <h3 class="mb-5">We love to hear everything from you.</h3>
            <h6 class="mb-4"><i class="fa-solid fa-house-chimney"></i>...............{{ $contactInfo->address }}</h6>
            <h6 class="mb-4"><i class="fa-solid fa-phone"></i>...............{{ $contactInfo->phone }}</h6>
            <h6 class="mb-4"><i class="fa-solid fa-envelope"></i>...............{{ $contactInfo->email }}</h6>
            <div class="pt-4">
                <span style="margin-right: 1em; font-size:1em" class="text-dark fs-75"><i class="fa-brands fa-facebook-f"></i></span>
                <span style="margin-right: 1em; font-size:1em" class="text-dark fs-75"><i class="fa-brands fa-instagram"></i></span>
                <span style="margin-right: 1em; font-size:1em" class="text-dark fs-75"><i class="fa-brands fa-twitter"></i></span>
                <span style="margin-right: 1em; font-size:1em" class="text-dark fs-75"><i class="fa-brands fa-linkedin-in"></i></span>
            </div>
        </div>
        <div class="col-6 bg-white p-5">
            <form action="{{ route('contact#contactToAdmin') }}" method="post">
                @csrf
                <input type="text" value="{{ old('name') }}" name="name" class="border-bottom @error('name') is-invalid border-danger @enderror form-control" style="border:0;box-shadow:none" placeholder="Enter your name.">
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
                <input type="text" value="{{ old('email') }}" name="email" class="border-bottom @error('email') is-invalid border-danger @enderror form-control mt-4" style="border:0;box-shadow:none" placeholder="Enter your valid email.">
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
                <textarea name="message" class="form-control @error('message') is-invalid @enderror mt-5" placeholder="Enter message" cols="30" rows="10">{{ old('message') }}</textarea>
                @error('message')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn btn-warning mt-4 rounded">Send your message</button>
            </form>
        </div>
    </div>
</div>

@endsection
