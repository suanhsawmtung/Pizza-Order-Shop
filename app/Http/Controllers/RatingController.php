<?php

namespace App\Http\Controllers;

use App\Models\React;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{

    // User -> make a review //
    public function review(Request $request){
        $this->checkValidationForReview($request);
        $data = $this->requestDataForReview($request);
        Review::create($data);
        return back();
    }

     // react love //
     public function reactLove($id){
        $items =  React::where('user_id',Auth::user()->id)->where('product_id', $id)->first();

        if(empty($items)){
            React::create([
                "user_id" => Auth::user()->id,
                "name" => Auth::user()->name,
                "product_id" => $id
            ]);
        }else{
            React::where('user_id',Auth::user()->id)->where('product_id', $id)->delete();
        }

        $itemsForProduct = React::where('product_id', $id)->get();
        Product::where('id', $id)->update(["react_count" => count($itemsForProduct)]);
        return back();
    }

    // User -> check validation for review //
    private function checkValidationForReview($request){
        Validator::make($request->all(),[
            "name" => 'required',
            "email" => 'required',
            "productId" => 'required',
            "review" => 'required'
        ])->validate();
    }

    // User -> request data for review //
    private function requestDataForReview($request){
        return [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'product_id' => $request->productId,
            'review' => $request->review
        ];
    }
}
