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
                    <div class="table-data__tool">
                        <div class="table-data__tool-left col-4">
                            <div class="overview-wrap">
                                <h2 class="title-1">Contact List</h2>
                            </div>
                        </div>
                        <div class="col-3 offset-1 ">
                            <h3>Total - ( {{ $contacts->total() }} )</h3>
                        </div>
                        <div class="col-2 offset-2">
                            <a href="{{ route('contact#allMessagePage') }}" class="col-12">
                                <button class="btn btn-success col-12">
                                    All Messages
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div class="p-2 d-flex justify-content-center align-content-center mb-3">
                            @if (session('status'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('status') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif
                        </div>
                        @if (count($contacts) != 0)
                        @foreach ($contacts as $contact)
                            <div class="card p-3 rounded shadow">
                                <div class="card-body">
                                    <div class="card-title mb-3 d-flex">
                                        <h5 class="me-3 btn btn-success px-3 py-2">{{ $contact->name }}</h5>
                                        <h5 class="me-3 btn btn-success px-3 py-2">{{ $contact->email }}</h5>
                                        <h5 class="btn btn-success px-3 py-2">{{ $contact->created_at->format('M j, Y - g:i A') }}</h5>
                                    </div>
                                    <div>
                                        <p>{{ $contact->message }}</p>
                                    </div>
                                    <a href="{{ route('contact#replyPage',$contact->id) }}" class="col-2 offset-10">
                                        <button class="btn btn-primary font-weight-bold text-white col-12">Reply</button>
                                    </a>
                                </div>
                            </div>
                         @endforeach
                        @else
                        <h3 class="mt-5 text-center text-muted">There is no message.</h3>
                        @endif
                    </div>
                <!-- END DATA TABLE -->
                </div>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

@section('link')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        if(window.location.href === "/contact/contactListPage"){
            $.ajax({
                type: 'get',
                url: '/contact/updateContactStatusFromAdmin',
                dataType: 'json'
            })
        }
    })
</script>
@endsection


