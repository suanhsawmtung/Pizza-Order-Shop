@extends('admin.Layouts.master')

@section('title', 'Category List Page')

@section('header')
    <h3>Admin Dashboard Panel</h3>
@endsection


@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="row mb-3">
                        <div class="col-3">
                            <h2 class="title-1">Reply to customer</h2>
                        </div>
                        <div class="col-2 offset-7">
                            <a href="{{ route('contact#allMessagePage') }}" class="col-12">
                                <button class="btn btn-dark col-12">
                                    <i class="fa-solid fa-arrow-left me-2"></i></i>back
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 card p-3">
                                <form action="{{ route('contact#replyToCustomer') }}" method="post">
                                    @csrf
                                    <div class="card-body">{{ $contactForReply->message }}</div>
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{ $contactForReply->id }}">
                                        <textarea name="reply" class="form-control" placeholder="Enter reply message" cols="10" rows="10"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-info col-2 offset-10 my-3">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
