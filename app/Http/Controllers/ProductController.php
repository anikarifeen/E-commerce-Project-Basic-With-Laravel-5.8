<?php
namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Image;
use App\Category;
class ProductController extends Controller
{
public function addproductview(){
$products = Product::all();
$products = Product::paginate(4);
$categories = Category::all();
$deleted_products=Product::onlyTrashed()->get();
return view('product/view',compact('products','deleted_products','categories'));
}
public function addproductinsert(Request $request){

$request->validate([
'category_id' => 'required',
'product_name' => 'required',
'product_description' => 'required',
'product_price' => 'required',
'product_quantity' => 'required|numeric',
'alert_quantity' => 'required|numeric',
]);
// a variable is required for storing a pic
$last_pic_id = Product::insertGetId([
'category_id'=>$request->category_id,
'product_name'=>$request->product_name,
'product_description'=>$request->product_description,
'product_price'=>$request->product_price,
'product_quantity'=>$request->product_quantity,
'alert_quantity'=>$request->alert_quantity,
//'product_image'=>$request->product_image
]);
// Upload Image
if($request->hasFile('product_image')){
$photo_to_upload = $request->product_image;
$filename = $last_pic_id.".".$photo_to_upload->getClientOriginalExtension();
Image::make($photo_to_upload)->resize(640,480)->save(base_path('public/images/employee/'.$filename));
Product::find($last_pic_id)->update([
'product_image'=>$filename
]);
}

return back()->with('anik','Product inserted successfully');
}
public function deleteproduct($product_id){
Product::find($product_id)->delete();
return back()->with('subah','Product deleted successfully');
}

public function editproduct($product_id){
$single_product_info= Product::findOrFail($product_id);
return view('product/edit',  compact('single_product_info'));
}


public function editproductinsert(Request $request){
	if($request->hasFile('product_image')){
		if(Product::find($request->product_id)->product_image=='defaultproductphoto.jpg'){
$photo_to_upload = $request->product_image;
$filename = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();
Image::make($photo_to_upload)->resize(640,480)->save(base_path('public/images/employee/'.$filename));
Product::find($request->product_id)->update([
'product_image'=>$filename
]);
}
else{

// first delete the old photo 
$delete_this_file = Product::find($request->product_id)->product_image;
unlink(base_path('public/images/employee/'.$delete_this_file));
// now update the new one
$photo_to_upload = $request->product_image;
$filename = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();
Image::make($photo_to_upload)->resize(640,480)->save(base_path('public/images/employee/'.$filename));
Product::find($request->product_id)->update([
'product_image'=>$filename
]);
}
	}

Product::find($request->product_id)->update([
'product_name'=>$request->product_name, 
'product_description'=>$request->product_description,
'product_price'=>$request->product_price,
'product_quantity'=>$request->product_quantity,
'alert_quantity'=>$request->alert_quantity
]);
return back()->with('anik','Product edited successfully');

}
public function restoreproduct($product_id){
Product::onlyTrashed()->where('id',$product_id)->restore();
return back();
}
public function permanentdeleteproduct($product_id){
	$delete_this_file = Product::onlyTrashed()->find($product_id)->product_image;
unlink(base_path('public/images/employee/'.$delete_this_file));
	Product::onlyTrashed()->find($product_id)->forceDelete();
return back();
}
}