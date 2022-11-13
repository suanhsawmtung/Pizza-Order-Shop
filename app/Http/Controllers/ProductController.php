<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct product list page //
    public function listPage(){
        $products = Product::select('products.*','categories.name as category_name')
                    ->when(request('search'),function($query){
                        $query->orWhere('products.name','like','%'.request('search').'%')
                              ->orWhere('products.category_name','like','%'.request('search').'%')
                              ->orWhere('products.price','like','%'.request('search').'%')  ;
                        })
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->orderBy('products.created_at','desc')
                        ->paginate(3);
        $products->appends(request()->all());
        return view('admin.product.list',compact('products'));
    }

     // filter List //
     public function filterList($categoryId){
        $products = Product::where('category_id',$categoryId)->get();
        $categories = Category::get();
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        $replies = Contact::where('status','2')->get();
        return view('user.main.home',compact('products','categories','carts','orders','replies'));
    }

    // direct product detail page //
    public function productDetailPage($productId){
        $ratingData = Review::select('reviews.*','users.name as user_name','users.email as user_email','users.image as user_image' ,'products.rating_count as product_rate')
                              ->leftJoin('users','users.id','reviews.user_id')
                              ->leftJoin('products','products.id','reviews.product_id')
                              ->where('reviews.product_id',$productId)
                              ->get();
        $totalReview = Review::where('product_id',$productId)->get();
        $allProduct = Product::get();
        $productInfo = Product::where('id',$productId)->first();
        $rating = Rating::where('user_id',Auth::user()->id)->where('product_id',$productId)->first();

        // $dataForRating = Rating::where('user_id',Auth::user()->id)->where('product_id',$productId)->get();
        // $data = $this->requestDataForCreateUserData($productId);

        if( isset($rating) ){
            $firstRatingData = $rating->rating;
        }else{
            $firstRatingData = 0;
        }

        return view('user.main.productDetail',compact('allProduct','productInfo','firstRatingData','totalReview','ratingData'));
    }

    // direct product create page //
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // create products //
    public function createProduct(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductData($request);
        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#listPage')->with(['createSuccess' => 'Created product successfully']);

    }

    // delete product //
    public function deleteProduct($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#listPage')->with(['deleteSuccess' => 'Deleted product successfully']);
    }

    // direct product detail page //
    public function detailPage($id){
        $data = Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('admin.product.detail',compact('data'));
    }

    // direct update page //
    public function updatePage($id){
        $data = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.product.update',compact('data','categories'));
    }

    // update product //
    public function updateProduct(Request $request){
        $this -> productValidationCheck($request,'update');
        $data = $this->requestProductData($request);

        if($request->hasFile('image')){
            $dbImage = Product::where('id',$request->id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$request->id)->update($data);
        return redirect()->route('product#detailPage',$request->id)->with(['updateSuccess' => 'Product updated successfully.']);
    }

    // product validation check //
    private function productValidationCheck($request,$status){
        $validationRules = [
            'name' => 'required | unique:products,name,'.$request->id,
            'category' => 'required',
            'price' => 'required',
            'waitingTime' => 'required',
            'description' => 'required'
        ];

        $validationRules['image'] = $status == 'create'? 'required | mimes:png,jpg,jpeg,webg,bmp' : 'mimes:png,jpg,jpeg,webg,bmp';

        Validator::make($request->all(),$validationRules)->validate();
    }

    // request product data //
    private function requestProductData($request){
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ];
    }

    // User -> request data for create user data //
    private function requestDataForCreateUserData($productId){
        return [
            'user_id' => Auth::user()->id,
            'email' => Auth::user()->email,
            'product_id' => $productId
        ];
    }

}
