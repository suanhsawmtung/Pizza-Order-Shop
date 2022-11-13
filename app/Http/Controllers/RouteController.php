<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderLists;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // release api from all tables //
    public function releaseApi(){
        $user = User::get();
        $category = Category::get();
        $product = Product::get();
        $orderLists = OrderLists::get();
        $order = Order::get();
        $contact = Contact::get();
        $cart = Cart::get();
        $rating = Rating::get();

        $data = [
            'user' => $user,
            'category' => $category,
            'product' => $product,
            'orderLists' => $orderLists,
            'order' => $order,
            'contact' => $contact,
            'cart' => $cart,
            'rating' => $rating
        ];

        return response()->json($data,200);
    }

    // category list //
    public function categoryList(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            return response()->json(['status'=>'success','category'=>$data],200);
        }

        return response()->json(['status'=>'fail','category'=> 'There is no category here.'],500);
    }

    // contact list //
    public function contactList($id){
        $data = Contact::where('id',$id)->first();

        if(!empty($data)){
            return response()->json(['status'=>'true','contact'=>$data],200);
        }

        return response()->json(['status'=>'false','contact'=>'There is no contact here'],500);
    }

    // create category //
    public function createCategory(Request $request){
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return response()->json(['status'=>'success','category'=>$data],200);
    }

    // update category //
    public function updateCategory(Request $request){
        $db_category = Category::where('id',$request->category_id)->first();
        $data = $this->requestCategoryData($request);

        if(isset($db_category)){
            $newData = Category::where('id',$request->category_id)->update($data);
            return response()->json(['status'=>'success','newCategory'=>$newData],200);
        }

        return response()->json(['status'=>'update failed','newCategory'=>'Updating Category Failed.'],500);

    }

    // delete category //
    public function deleteCategory($id){
        $data = Category::where('id',$id)->first();

        if(!empty($data)){
            Category::where('id',$id)->delete();
            return response()->json(['message'=> 'Delete category success.'],200);
        }

        return response()->json(['message'=>'Delete category fail.']);
    }

    // delete user //
    public function deleteUser(Request $request){
         $data = User::where('id',$request->user_id)->first();

         if(isset($data)){
            User::where('id',$request->user_id)->delete();
            return response()->json(['message'=>'Delete user account success.']);
         }

         return response()->json(['message'=>'Delete user account fail.']);
    }

    // request category data //
    private function requestCategoryData($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}
