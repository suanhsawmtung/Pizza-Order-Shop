<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct password change page //
    public function passwordChangePage(){
        return view('admin.account.changePassword');
    }

    // change password //
    public function passwordChange(Request $request){
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

    // direct profile page //
    public function profilePage(){
        return view('admin.account.profile');
    }

    // direct edit profile page //
    public function editProfilePage(){
        return view('admin.account.editProfile');
    }

    // edit profile //
    public function editProfile($id,Request $request){
        $this->dataValidationCheck($request);
        $data = $this->requestUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('account#profilePage')->with(['updateSuccess'=>'Profile update success...']);
    }

    // direct admin list page //
    public function accountListPage(){
        $accounts = User::when(request('search'),function($query){
                $query->orWhere('name','like','%'.request('search').'%')
                      ->orWhere('phone','like','%'.request('search').'%')
                      ->orWhere('gender',request('search'))
                      ->orWhere('address','like','%'.request('search').'%');
                    })->paginate(3);
        $accounts->appends(request()->all());
        return view('admin.account.accountList',compact('accounts'));
    }

    // seperate admin and customer accounts //
    public function seperateRole($role){
        $accounts = User::when(request('search'),function($query){
            $query->orWhere('name','like','%'.request('search').'%')
                  ->orWhere('phone','like','%'.request('search').'%')
                  ->orWhere('gender',request('search'))
                  ->orWhere('address','like','%'.request('search').'%');
                })->where('role',$role)->paginate(3);
        $accounts->appends(request()->all());
        return view('admin.account.accountList',compact('accounts'));
    }

    public function deleteAccount(Request $request){
        User::where('id',$request->id)->delete();
        return back()->with(['Success'=>'Deleted']);
    }

     // change account role //
     public function changeAccountRole(Request $request){
        User::where('id',$request->accountId)->update([
            'role' => $request->newRole
        ]);
        $response = [ "status" => "success" ];
        return response()->json($response,200);
    }


    // password validation check //
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required | min:8 |',
            'newPassword' => 'required | min:8 |',
            'confirmPassword' => 'required | min:8 | same:newPassword'
        ]) -> validate();
    }

    // profile data validation check //
    private function dataValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required | unique:users,email,'.Auth::user()->id,
            'phone' => 'required | min:10 | max:15',
            'gender' => 'required',
            'address' => 'required'
        ]) -> validate();
    }

    // request user data to update profile //
    private function requestUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // request data for change role //
    private function requestDataForRole($request){
        return [
            'role' => $request->role
        ];
    }

}
