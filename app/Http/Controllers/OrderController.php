<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // user -> direct order history page //
    public function orderHistory(){
        $allOrderData = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.order.orderHistory',compact('allOrderData'));
    }

    // admin -> direct order list page //
    public function orderListPage(){
        $orders = Order::select('orders.*','users.name as user_name')
                ->orderBy('orders.created_at','desc')
                ->leftJoin('users','users.id','orders.user_id')
                ->when(request('search'),function($query){
                    $query->orWhere('orders.user_id','like','%'.request('search').'%')
                          ->orWhere('users.name','like','%'.request('search').'%')
                          ->orWhere('orders.created_at','like','%'.request('search').'%')
                          ->orWhere('orders.total_price','like','%'.request('search').'%');
                })
                ->get();
        return view('admin.order.orderLists',compact('orders'));
    }

    // admin -> show new orders //
    public function newOrders(){
        $orders = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->where('status','0')->get();
        return view('admin.order.orderLists',compact('orders'));
    }

    // admin -> filter order list with ajax //
    public function filterOrderList(Request $request){
        $orders = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id');

        if($request->orderStatus !== null){
            $orders = $orders->where('status',$request->orderStatus)->get();
        }else{
            $orders = $orders->get();
        }

        return view('admin.order.orderLists',compact('orders'));
    }

    // admin -> update order status //
    public function updateOrderStatus(Request $request){
        Order::where('id',$request['orderId'])->update([
            'status' => $request['status']
        ]);
        $response = ['message' => 'success'];
        return response()->json($response,200);
    }

    // admin -> order list details //
    public function orderListDetail($orderCode){
        $allOrderLists = OrderLists::select('order_lists.*','products.name as product_name','products.image as product_image','orders.total_price as finalTotalPrice','users.name as user_name')
                      ->where('order_lists.order_code',$orderCode)
                      ->leftJoin('products','products.id','order_lists.product_id')
                      ->leftJoin('orders','orders.order_code','order_lists.order_code')
                      ->leftJoin('users','users.id','order_lists.user_id');

        $orderLists = $allOrderLists->orderBy('order_lists.created_at','desc')->get();
        $secondOrderLists = $allOrderLists->orderBy('order_lists.created_at','desc')->first();

        return view('admin.order.orderDetail',compact('orderLists','secondOrderLists'));
    }
}
