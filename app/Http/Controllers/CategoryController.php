<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
class CategoryController extends Controller
{
public function addcategoryview(){
	$categories = Category::all();
	return view ('category/view',compact('categories'));
}
public function addcategoryinsert(Request $request)
{
	
	$request->validate([
	'category_name' => 'required|unique:categories,category_name'
	
	]);
	//print_r($request->all());
	if(isset($request->menu_status)){
	Category::insert([
		'category_name'=>$request->category_name,
		'menu_status' => true,
		'created_at'=>Carbon::now()
	 	 
	]);
}
else
{
	
	Category::insert([
		'category_name'=>$request->category_name,
		'menu_status' => false,
		'created_at'=>Carbon::now()
	 	 
	]);
 
}

	return back()->with('anik','Category Added Successfully');

}
}
