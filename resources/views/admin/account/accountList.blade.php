@extends('admin.Layouts.master')

@section('title', 'Addtional Setting')

@section('header')

    <form class="form-header" action="" method="GET">
        @csrf
        <input class="au-input au-input--xl" value="{{ request('search') }}" type="text" name="search"
            placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>

@endsection


@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User Accounts List</h2>

                            </div>
                        </div>
                        <div class="col-3 offset-1 ">
                            <h3>Total - ( {{ $accounts->total() }} )</h3>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('account#accountListPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small ">
                                    All Users
                                </button>
                            </a>
                            <a href="{{ route('account#seperateRole','admin') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    Admins
                                </button>
                            </a>
                            <a href="{{ route('account#seperateRole','user') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    Customers
                                </button>
                            </a>
                        </div>
                    </div>
                    @if (session('Success'))
                        <div class="alert alert-success alert-dismissible fade show " role="alert">
                            <span>{{ session('Success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr class="tr-shadow" id="parentTableRow">
                                        <td class="desc col-2 text-center">
                                            @if ($account->image == null)
                                                @if ($account->gender == 'male')
                                                    <img src="{{ asset('image/no_user.jpg') }}"
                                                        class="img-thumbnail shadow-sm" style="width: 100px" alt="">
                                                @else
                                                    <img src="{{ asset('image/default_user_female.jpg') }}"
                                                        class="img-thumbnail shadow-sm" style="width: 100px" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $account->image) }}"
                                                    class="img-thumbnail shadow-sm" style="width: 100px" alt="">
                                            @endif
                                        </td>
                                        <td class="">{{ $account->name }}</td>
                                        <td class="">{{ $account->email }}</td>
                                        <td class="">{{ $account->phone }}</td>
                                        <td class="">{{ $account->gender }}</td>
                                        <td class="">{{ $account->address }}</td>
                                        <td class="">
                                            @if (Auth::user()->id == $account->id)
                                               <input type="hidden" name="" value="{{ $account->id }}">
                                            @else
                                                <select class="form-control" id="changeRole">
                                                    <option value="admin" @if ($account->role == 'admin') selected @endif >admin</option>
                                                    <option value="user" @if ($account->role == 'user') selected @endif >User</option>
                                                </select>
                                                <input type="hidden" id="accountId" value="{{ $account->id }}">
                                            @endif
                                        </td>
                                        <td class="">
                                            @if ($account->role == 'admin')
                                                <input type="hidden" name="" value="{{ $account->id }}">
                                            @else
                                                <form action="{{ route('account#deleteAccount') }}" method="post" title="Delete Account">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $account->id }}">
                                                    <button type="submit" style="width:25px; height:25px" class="text-center text-light d-flex align-items-center justify-content-center bg-danger rounded-circle">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $accounts->links() }}
                    </div>
                </div>
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

        $('#parentTableRow #changeRole').change(function(){
            $newRole = $(this).val();
            $accountId = $(this).parents('#parentTableRow').find('#accountId').val();
            $dataForChange = {
                "newRole": $newRole,
                "accountId": $accountId
            }

            $.ajax({
                type:'get',
                url: 'http://127.0.0.1:8000/account/changeAccountRole',
                data: $dataForChange,
                dataType: 'json',
                success: function(response){
                    if(response['status'] == 'success'){
                        location.reload();
                    }
                }
            })
        })
    })
</script>
@endsection

