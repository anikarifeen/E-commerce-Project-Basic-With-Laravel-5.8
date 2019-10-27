<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
   use SoftDeletes;
   protected $fillable = ['product_name','product_description','product_price','product_quantity',
   'alert_quantity','product_image'];
   protected $dates =['deleted_at'];

   public function relationtocategory(){
   	return $this->hasOne('App\Category', 'id','category_id');
   }        
}


// DB::table('users')->join('shahjahan','user.id','shahjahan.abc')->select ('users.*','shahjahan.contact')->get();
// DB::table('old')->join('new table','new table.new table_id','old table.old table_extra col')->select ('old.*','newtable.*')->get();


// 