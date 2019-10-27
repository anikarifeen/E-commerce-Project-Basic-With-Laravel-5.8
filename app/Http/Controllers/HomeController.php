<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function contactmessageview()
    {
        $contactmessages = Contact::all();
        return view('contact.view',compact('contactmessages'));
    }

    public function categorychangemenu($category_id){
        $category_change = Category::find($category_id);
        if($category_change->menu_status==0){
            $category_change->menu_status = true;
        }
        else{
            $category_change->menu_status = false;
        }
        $category_change->save();
        return back();
    }

     public function contactmessagechange($contactmessage_id){
        $contactmessage_change = Contact::find($contactmessage_id);
        if($contactmessage_change->read_status==0){
            $contactmessage_change->read_status = true;
        }
        else{
            $contactmessage_change->read_status = false;
        }
        $contactmessage_change->save();
        return back();
    }
}
