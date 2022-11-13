@extends('user.Layouts.master')

@section('text','text-primary')

@section('bg','bg-primary')

@section('content')

<div class="row mb-2">
    <div class="col-4 offset-1" >
        <a href="{{ route('customer#homePage') }}" class="text-dark w-50 text-center">
            <i class="fa-solid fa-left-long me-3" style="margin-right: 15px"></i>Back to home page
        </a>
    </div>
</div>

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-10 offset-1 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-4">
                <thead class="thead-dark">
                    <tr>
                        <th>User Id</th>
                        <th>Order Code</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="parentBody">
                    @foreach ($allOrderData as $orderData)
                    <tr>
                        <td class="align-middle">{{ $orderData->user_id }}</td>
                        <td class="align-middle">{{ $orderData->order_code }}</td>
                        <td class="align-middle">{{ $orderData->total_price }} Kyats</td>
                        <td class="align-middle">{{ $orderData->created_at->format('j-F-Y') }} </td>
                        <td class="align-middle">
                            @if ($orderData->status == 0)
                                <span class="text-warning">Pending...</span>
                            @elseif ($orderData->status == 1)
                                <span class="text-success">Success</span>
                            @elseif ($orderData->status == 2)
                                <span class="text-danger">Remove</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $allOrderData->links()}}
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection
