<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // user -> direct contact form page //
    public function contactFormPage(){
        $contactInfo = User::where('id',1)->first();
        return view('user.contact.contactForm',compact('contactInfo'));
    }

    // user -> contact to admin //
    public function contactToAdmin(Request $request){
        $this->contactValidationCheck($request);
       if($request->name == Auth::user()->name && $request->email == Auth::user()->email){
            $contactData = $this->requestContactFormData($request);
            Contact::create($contactData);
            return redirect()->route('customer#homePage');
       }else{
            return back()->with(["warning" => "The informations you entered is doesn't match with your account info."]);
       }

    }

    // user -> direct reply from admin page //
    public function directReplyFromAdminPage(){
        $replies = Contact::where('status','2')->get();
        return view('user.contact.repliesFromAdmin',compact('replies'));
    }

    // user -> show all reply messages from admin //
    public function allReplyFromAdmin(){
        $replies = Contact::where('status','3')->get();
        return view('user.contact.repliesFromAdmin',compact('replies'));
    }

    // admin -> notifications for admin //
    public function notiForAdmin(){
        $notiMessages = Contact::where('status','0')->orderBy('created_at','desc')->get();
        $notiOrders = Order::where('status','0')->orderBy('created_at','desc')->get();
        return response()->json([
            'notiMessages' => $notiMessages,
            'notiOrders' => $notiOrders
        ],200);
    }

    // admin -> direct contact list page //
    public function contactListPage(){
        $contacts = Contact::where('status','0')->paginate(4);
        return view('admin.contact.contactList',compact('contacts'));
    }

    // admin -> update contact status form user //
    public function updateContactStatusFromAdmin(Request $request){
        Contact::where('status','0')->update(['status' => '1']);
    }


    // admin -> shaw all message from customers //
    public function allMessagePage(){
        $contacts = Contact::where('status','!=','0')->paginate(4);
        return view('admin.contact.contactList',compact('contacts'));
    }

    // admin -> direct reply page //
    public function replyPage($id){
        $contactForReply = Contact::where('id',$id)->first();
        return view('admin.contact.reply',compact('contactForReply'));
    }

    // admin -> reply to customer //
    public function replyToCustomer(Request $request){
        Contact::where('id',$request->id)->update([
            'reply' => $request->reply,
            'status' => '2',
            'updated_at' => Carbon::now()
        ]);
        return redirect()->route('contact#allMessagePage')->with(['status' => 'Sent']);
    }


    // contact validation check //
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
           'name' => 'required ',
           'email' => 'required',
           'message' => 'required'
        ])->validate();
    }

    // request contact form data //
    private function requestContactFormData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }
}
