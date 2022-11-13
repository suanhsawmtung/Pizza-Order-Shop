<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // direct shopping home page //
    public function homePage(){
        $categories = Category::get();
        $productCount = count(Product::get());
        if($productCount != 0){
            $products = Product::get();
        }else{
            $products = [];
        }
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $orders = Order::where('user_id',Auth::user()->id)->get();
        $replies = Contact::where('status','2')->get();
        return view('user.main.home',compact('categories','products','carts','orders','replies'));
    }

    // direct customer profile page //
    public function profilePage(){
        return view('user.main.profile');
    }

    // direct customer profile edit page //
    public function editPage(){
        return view('user.main.editProfile');
    }

    // update user data //
    public function updateProfile(Request $request){
        $this -> updateValidationCheck($request);
        $data = $this -> requestUpdateData($request);

        if($request->hasFile('image')){
            $dbName = User::where('id',Auth::user()->id)->first();
            $dbName = $dbName->image;

            if($dbName != null){
                Storage::delete('public/'.$dbName);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('customer#profilePage')->with(['updateSuccess' => 'Profile update succeed.']);

    }

    // direct password change page //
    public function passwordPage(){
        return view('user.main.password');
    }

    // change password //
    public function changePassword(Request $request){
        $oldDbHashPassword = Auth::user()->password;
        $oldPassword = $request->oldPassword;

        if(Hash::check($oldPassword,$oldDbHashPassword)){
            $this->passwordValidationCheck($request);
            $data = ['password' => Hash::make($request->newPassword)];
            User::select('password') -> where('id',Auth::user()->id) -> update($data);
            return redirect() -> route('category#listPage') -> with(['changeSuccess' => 'Success saving your new password..']);
        }

        return redirect() -> route('account#passwordChangePage') -> with(['notMatch' => 'The old password you entered is incorrect!']);
    }

    // update validation check //
    private function updateValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required | unique:users,email,'.Auth::user()->id,
            'phone' => 'required | min:10 | max:15',
            'gender' => 'required',
            'address' => 'required'
        ])->validate();
    }

    // request update profile data //
    private function requestUpdateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->name
        ];
    }

     // password validation check //
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required | min:8 |',
            'newPassword' => 'required | min:8 |',
            'confirmPassword' => 'required | min:8 | same:newPassword'
        ]) -> validate();
    }

}
