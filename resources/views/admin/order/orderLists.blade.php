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
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        <div class="col-3 offset-1 ">
                            <h3>Total - ( {{ count($orders) }} )</h3>
                        </div>
                        <div class="col-2">
                            <form action="{{ route('order#filterOrderList') }}" method="get" class="col-2 input-group mb-3">
                                @csrf
                                <select class="form-control" name="orderStatus">
                                    <option value="">All</option>
                                    <option value="0" @if ( request('orderStatus') == '0') selected @endif>Pending</option>
                                    <option value="1" @if ( request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if ( request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-list-check"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>user id</th>
                                    <th>user name</th>
                                    <th>order code</th>
                                    <th>price</th>
                                    <th>status</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                            <tbody id="parentBody">
                                @foreach ($orders as $order)
                                <tr id="parentTableRow">
                                    <td class="col-2">{{ $order->user_id }}</td>
                                    <td class="col-2">{{ $order->user_name }}</td>
                                    <td class="col-2">
                                        <a href="{{ route('order#orderListDetail',$order->order_code) }}">{{ $order->order_code }}</a>
                                    </td>
                                    <td class="col-2">{{ $order->total_price }} Kyats</td>
                                    <td class="col-2">
                                        <input type="hidden" value="{{ $order->id }}" id="orderId">
                                        <select class="form-control" id="status" >
                                            <option value="0" @if ($order->status == '0') selected @endif>Pending</option>
                                            <option value="1" @if ($order->status == '1') selected @endif>Accept</option>
                                            <option value="2" @if ($order->status == '2') selected @endif>Reject</option>
                                        </select>
                                    </td>
                                    <td class="col-2">{{ $order->created_at->format('M d, Y - h:i A') }}</td>
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

@section('link')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        // $('#orderStatus').change(function(){
        //     $statusValue = $(this).val();

        //     $.ajax({
        //         type: 'get',
        //         url: '/order/ajaxOrderList',
        //         data: { 'status': $statusValue },
        //         dataType: 'json',
        //         success: function(response){
        //             $lists = '';
        //             for($i=0;$i<response.length;$i++){
        //                 $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        //                 $dbDate = new Date(response[$i].created_at);
        //                 $orderDate = $dbDate.getDate()+ " " + $months[$dbDate.getMonth()] + ", " + $dbDate.getFullYear();
        //                 console.log(response[$i].status);
        //                 console.log($orderDate);
        //                 if(response[$i].status == 0){
        //                     $messageStatus = `
        //                         <input type="hidden" value="${response[$i].id}" id="orderId">
        //                         <select class="form-control" id="status" >
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
        //                 }else if(response[$i].status == 1){
        //                     $messageStatus = `
        //                         <input type="hidden" value="${response[$i].id}" id="orderId">
        //                         <select class="form-control" id="status" >
        //                             <option value="0" >Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
        //                 }else if(response[$i].status == 2){
        //                     $messageStatus = `
        //                         <input type="hidden" value="${response[$i].id}" id="orderId">
        //                         <select class="form-control" id="status" >
        //                             <option value="0" >Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                     `;
        //                 }

        //                 $lists += `
        //                 <tr id="parentTableRow">
        //                     <td class="col-2">${response[$i].user_id}</td>
        //                     <td class="col-2">${response[$i].user_name}</td>
        //                     <td class="col-2">${response[$i].order_code}</td>
        //                     <td class="col-2">${response[$i].total_price} Kyats</td>
        //                     <td class="col-2">${$messageStatus}</td>
        //                     <td class="col-2">${$orderDate}</td>
        //                 </tr>
        //                 `;
        //             }
        //             $('#parentBody').html($lists);
        //         }
        //     })
        // })

        $('#parentTableRow select').change(function(){
            $orderId = $(this).parents('#parentTableRow').find('#orderId').val();
            $orderStatus = $(this).parents('#parentTableRow').find('#status').val();
            $dataForUpdating = {
                "status": $orderStatus,
                "orderId": $orderId
            }

            $.ajax({
                type: 'get',
                url: '/order/updateOrderStatus',
                data: $dataForUpdating,
                dataType: 'json',
                success: function(response){
                    if(response['message'] == 'success'){
                        window.location.href = '/order/orderListPage';
                    }
                }
            })

        })
    })
</script>
@endsection
