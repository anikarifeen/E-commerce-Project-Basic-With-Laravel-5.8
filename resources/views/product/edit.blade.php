@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">


        <div class="col-6 offset-3">
            <div class="card bg-warning">
                <div class="card-header bg-success">
                    Edit Product
                </div>
                <div class="card-body">
                    @if(session('anik'))
                    <div class="alert alert-success">
                   {{session('anik')}}
                    </div>
                    @endif

                    <form action="{{url('/edit/product/insert')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="hidden" name="product_id" value="{{$single_product_info->id}}">
                            <input type="text" class="form-control" placeholder="Enter your product name" name="product_name" value="{{$single_product_info->product_name}}">
                        </div>

                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea type="text" class="form-control" rows="3" placeholder="Enter your product description" name="product_description" >{{$single_product_info->product_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" placeholder="Enter your product price" name="product_price" value="{{$single_product_info->product_price}}">
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter your product quantity" name="product_quantity" value="{{$single_product_info->product_quantity}}">
                        </div>
                        <div class="form-group">
                            <label>Alert Quantity</label>
                            <input type="text" class="form-control" placeholder="Enter your product alert" name="alert_quantity" value="{{$single_product_info->alert_quantity}}">
                        </div>
                         <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" class="form-control" name="product_image" >
                            <img src="{{asset('images/employee')}}/{{$single_product_info->product_image}}" alt="not found" width="150">
                        </div>


                        <button type="submit" class="btn btn-dark">Update Product</button>
                        
                    </form>

                </div>

            </div>
        </div>


    </div>


</div>
@endsection
