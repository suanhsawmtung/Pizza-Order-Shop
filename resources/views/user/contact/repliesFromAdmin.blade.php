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
    <div class="col-2 offset-5">
        <a href="{{ route('contact#allReplyFromAdmin') }}" class="col-12">
            <button type="button" class="btn btn-info col-12">All Messages</button>
        </a>
    </div>
</div>

<div class="container mt-5">
    <div class="row ">
        @foreach ($replies as $reply)
        <div class="col-12 bg-white p-4 card rounded mb-4 shadow">
            <div class="card-body">
                <h5>Your Message</h5>
                <span class="d-flex text-warning mb-1">{{ $reply->created_at->format("M j, Y - g:i A") }}</span>
                {{ $reply->message }}
            </div>
            <div class="card-body ">
                <h5>Reply</h5>
                <span class="d-flex text-warning mb-1">{{ $reply->updated_at->format('M j, Y - g:i A') }}</span>
                <p>{{ $reply->reply }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('forJquery')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('jqueryOperation')
<script>
    $(document).ready(function(){
        $.ajax({
            type: 'get',
            url: 'http://127.0.0.1:8000/ajax/updateContactStatusFromUser',
            dataType: 'json'
        })
    })
</script>
@endsection
