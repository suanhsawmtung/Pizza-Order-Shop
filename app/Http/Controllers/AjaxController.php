<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OrderLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{

    // sorting //
    public function pizzaList(Request $request){
        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }else if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else if($request->status == 'popular'){
            $data = Product::orderBy('view_count','desc')->get();
        }else if($request->status == 'bestRate'){
            $data = Product::orderBy('rating_count','desc')->get();
        }
        return response()->json($data,200);
    }

    // view count //
    public function viewCount(Request $request){
        $dataForViewCount = Product::where('id',$request->pizzaId)->first();

        $updateData = [
            'view_count' => $dataForViewCount->view_count + 1
        ];

        Product::where('id',$request['pizzaId'])->update($updateData);
    }

    // rate product //
    public function rateProduct(Request $request){
        $rate = 0;
        $checkItems = Rating::where('user_id',Auth::user()->id)->where('product_id',$request->productId)->first();

        if(empty($checkItems)){
            Rating::create([
                "user_id" => Auth::user()->id,
                "name" => Auth::user()->name,
                "product_id" => $request->productId,
                "rating" => $request->rating
            ]);
        }else{
            Rating::where('user_id',Auth::user()->id)->where('product_id',$request->productId)->update([
                "rating" => $request->rating
            ]);
        }

        $items = Rating::where('product_id',$request->productId)->get();
        $count = count($items);
        foreach($items as $item){
            $rate += $item->rating;
        }
        $ratingCount = $rate/$count;
        Product::where('id',$request->productId)->update(["rating_count" => $ratingCount]);
        return response()->json([ "status" => true ],200);
    }

    // add to order list //
    public function orderList(Request $request){
        $final_total_price = 0;
        foreach($request->all() as $item){
            $orderListCreate = OrderLists::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total_price'],
                'order_code' => $item['order_code']
            ]);

            $final_total_price += $item['total_price'];
        }

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $orderListCreate->order_code,
            'total_price' => $final_total_price+3000,
            'status' => '0'  // 0 => pending , 1 => accept , 2 => reject //
        ]);

        Cart::where('user_id',Auth::user()->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Ordered completed'
        ],200);
    }

    // remove cart lists //
    public function removeCartLists(Request $request){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // remove each cart //
    public function removeEachCart(Request $request){
        Cart::where('id',$request['cartId'])
                ->where('user_id',Auth::user()->id)
                ->where('product_id',$request['productId'])
                ->delete();
    }

    // update contact status form user //
    public function updateContactStatusFromUser(Request $request){
        Contact::where('status','2')->update(['status' => '3']);
    }

    // add to card //
    public function addToCart(Request $request){
        $data = $this->requestDataToCart($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'Added to cart'
        ];
        return response()->json($response,200);
    }

    // request data to add to cart //
    private function requestDataToCart($request){
        return [
            'user_id' => Auth::user()->id,
            'product_id' => $request->pizzaId,
            'quantity' => $request->count
        ];
    }

}
