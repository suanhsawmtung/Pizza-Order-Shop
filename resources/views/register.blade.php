@extends('Layouts.master')

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            @error('terms')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full  mt-2 mb-3 @error('name') is-invalid @enderror" type="text" name="name"
                    placeholder="Username">
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full  mt-2 mb-3" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Phone Number</label>
                <input class="au-input au-input--full  mt-2 mb-3" type="number" name="phone" placeholder="09....">
            </div>
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>User Gender</label>
                <input type="radio" id="male" name="gender" value="male">
                <label class="d-inline-block me-3  mt-2 mb-3" for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label class="d-inline-block" for="female">Female</label>
            </div>
            @error('gender')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>User Address</label>
                <input class="au-input au-input--full  mt-2 mb-3" type="text" name="address" placeholder="Useraddress">
            </div>
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full  mt-2 mb-3" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Confirm Password</label>
                <input class="au-input au-input--full  mt-2 mb-3" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <button class="au-btn au-btn--block au-btn--green mb-1" type="submit">register</button>

        </form>
        <div class="register-link  mt-1 mb-2">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
