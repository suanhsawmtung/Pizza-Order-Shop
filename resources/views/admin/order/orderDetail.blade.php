@extends('admin.Layouts.master')

@section('title', 'Order List Page')

@section('header')

    <form class="form-header" action="{{ route('order#orderListPage') }}" method="GET">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between ">
                                <div class="card col-2" style="background: #E7F6F2">
                                    <div class="p-3"><h3 class="border-dark border-bottom ">User Name</h3></div>
                                    <div class="card-body fs-5">{{ $secondOrderLists->user_name }}</div>
                                </div>
                                <div class="card col-2" style="background: #C0E6BA">
                                    <div class="p-3"><h3 class="border-dark border-bottom ">Order Code</h3></div>
                                    <div class="card-body fs-5">{{ $secondOrderLists->order_code }}</div>
                                </div>
                                <div class="card col-2" style="background: #9BBBFC">
                                    <div class="p-3"><h3 class="border-dark border-bottom ">Count</h3></div>
                                    <div class="card-body fs-5">{{ count($orderLists) }}</div>
                                </div>
                                <div class="card col-2" style="background: #FDB2DB">
                                    <div class="p-3"><h3 class="border-dark border-bottom ">Total Price</h3></div>
                                    <div class="card-body fs-5">{{ $secondOrderLists->total_price }}</div>
                                </div>
                                <div class="card col-2" style="background: #FCE77D">
                                    <div class="p-3"><h3 class="border-dark border-bottom ">Date</h3></div>
                                    <div class="card-body fs-5">{{ $secondOrderLists->created_at->format('d M, Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>id</th>
                                    <th></th>
                                    <th>product name</th>
                                    <th>quantity</th>
                                    <th>price</th>
                                </tr>
                            </thead>
                            <tbody id="parentBody">
                                @foreach ($orderLists as $order)
                                    <tr>
                                        <td></td>
                                        <td>{{$order->id}}</td>
                                        <td class="col-2"><img src="{{ asset('storage/'.$order->product_image) }}" class="img-thumbnail shadow-sm"></td>
                                        <td>{{$order->product_name}}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{$order->total_price}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

