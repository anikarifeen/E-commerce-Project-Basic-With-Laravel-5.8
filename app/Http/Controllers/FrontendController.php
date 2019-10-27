<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Contact;
use App\Cart;
use Carbon\Carbon;
use Mail;
use App\Mail\ContactMessage;


class FrontendController extends Controller
{
    function index()
    {
    	$products=Product::all();
        $categories=Category::all();
    	 return view('welcome',compact('products', 'categories'));
    }
    function about(){
    	return view ('about');
    }
    function contact(){
    	return view ('contact');
    }

    function contactinsert(Request $request){
        Contact::insert([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'subject'=>$request->subject,
            'message'=>$request->message
        ]);
        // Send mail to the company
        $message= $request->message;
        $first_name=$request->first_name;
        Mail::to('anikarifeen10@yahoo.com')->send(new ContactMessage($message,$first_name));
        return back()->with('status','Message Sent Successfully');
    }

    function productdetails($id)
    {
        $single_product_info=Product::find($id);
        $related_products=Product::where('id','!=',$id)->where('category_id',$single_product_info->category_id)->
        get();
    	return view ('frontend/productdetails',compact('single_product_info','related_products'));
    }
    public function Categorywiseproduct($category_id)
    {
        $products=Product::where('category_id',$category_id)->get();
        return view('frontend/categorywiseproduct',compact('products'));
    }

    public function Addtocart($product_id)
    {

        $ip_address = $_SERVER['REMOTE_ADDR'];
        if(Cart::where('customer_ip', $ip_address)->where('product_id',$product_id)->exists())
        {
        Cart::where('customer_ip', $ip_address)->where('product_id',$product_id)->increment('product_quantity');
        }
        else{
        Cart::insert([
            'customer_ip' => $ip_address,
            'product_id' => $product_id,
            'created_at' => Carbon::now()
        ]);
    }
    return back();
    }

    public function cart(){
        $cart_items = Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();
        return view('frontend.cart',compact('cart_items'));
    }
   
   public function deletefromcart($cart_id)
   {
    Cart::find($cart_id)->delete();
    return back();
   }

   public function clearfromcart()
   {
    Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->delete();
    return back();
   }
}
  