<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // show cart detail data //
    public function cartList(){
        $carts = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                ->leftJoin('products','carts.product_id','products.id')
                ->where('carts.user_id',Auth::user()->id)
                ->get();

        $total = 0;
        foreach($carts as $cart){
            $total+=$cart->product_price*$cart->quantity;
        }
        return view('user.cart.cartList',compact('carts','total'));
    }


    // add one item to cart //
    public function addOneItemToCart($id){
        $data = $this->requestDataToCard($id);
        Cart::create($data);
        return back();
    }


    // request data to add to card //
    private function requestDataToCard($id){
        return [
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'quantity' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
