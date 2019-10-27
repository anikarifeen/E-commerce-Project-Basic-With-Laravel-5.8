@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      <div class="card mb-3">
        <div class="card-header bg-success">
          Product List
        </div>
        <div class="card-body">
          @if(session('subah'))
          <div class="alert alert-danger">
            {{session('subah')}}
          </div>
          @endif
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Menu Status</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
                {{-- <th scope="col">Product Price</th>
                <th scope="col">Product Quantity</th>
                <th scope="col">Alert Quantity</th>
                <th scope="col">Product Image</th>
                <th scope="col">Action</th> --}}
              </tr>
            </thead>
                  <tbody>
              @forelse($categories as $category)
              <tr>
                <th>{{$category->id}}</th>
                <th>{{$category->category_name}}</th>
                 <th>{{($category->menu_status ==1) ? 'YES' : "No"}}</th>
                <th>{{$category->created_at->diffForHumans()}}</th>
                <th><a href="{{url('category/change/menu')}}/{{$category->id}}" class="btn btn-sm btn-primary">Change</a></th>
                {{-- <th>{{str_limit($product->product_description,20)}}</th>
                <th>{{$product->product_price}}</th>
                <th>{{$product->product_quantity}}</th>
                <th>{{$product->alert_quantity}}</th>
                <th>
                  <img src="{{asset('images/employee')}}/{{$product->product_image}}" alt="not found" width="30px">
                </th>
                <th>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{url('/edit/product')}}/{{$product->id}}" type="button" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{url('/delete/product')}}/{{$product->id}}" type="button" class="btn btn-sm btn-danger">Delete</a>
                  </div>
                </th> --}}
              </tr>
              @empty
              <tr class="text-center text-danger">
                <th colspan="3">No Data Available</th>
              </tr>
              @endforelse
            </tbody>
          </table>
          {{-- {{$products->links()}} --}}
        </div>
      </div>
      {{--       <div class="card">
        <div class="card-header bg-danger">
          Deleted Product
        </div>
        <div class="card-body">
          @if(session('subah'))
          <div class="alert alert-danger">
            {{session('subah')}}
          </div>
          @endif
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Description</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Quantity</th>
                <th scope="col">Alert Quantity</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($deleted_products as $deleted_product)
              <tr>
                <th>{{$deleted_product->id}}</th>
                <th>{{$deleted_product->product_name}}</th>
                <th>{{str_limit($deleted_product->product_description,20)}}</th>
                <th>{{$deleted_product->product_price}}</th>
                <th>{{$deleted_product->product_quantity}}</th>
                <th>{{$deleted_product->alert_quantity}}</th>
                
                <th>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{url('/restore/product')}}/{{$deleted_product->id}}" type="button" class="btn btn-sm btn-success">Restore</a>
                    <a href="{{url('force/delete/product')}}/{{$deleted_product->id}}" type="button" class="btn btn-sm btn-danger">Permanent Delete</a>
                  </div>
                </th>
              </tr>
              @empty
              <tr class="text-center text-danger">
                <th colspan="7">No Data Available</th>
              </tr>
              @endforelse
            </tbody>
          </table>
          {{$products->links()}}
        </div>
      </div> --}}
    </div>
    <div class="col-4">
      <div class="card bg-warning">
        <div class="card-header bg-success">
          Add Product Category
        </div>
        <div class="card-body">
          @if($errors->all())
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </div>
          @endif

           @if(session('anik'))
          <div class="alert alert-success">
            {{session('anik')}}
          </div>
          @endif
          <form action="{{url('/add/category/insert')}}" method="post">
            @csrf
            <div class="form-group">
              <label>Category Name</label>
              <input type="text" class="form-control" placeholder="Enter your category name" name="category_name">
            </div>
            <div class="form-group">
              <input type="checkbox" name="menu_status" value="1" id="menu"> <label for="menu">Use as Menu</label>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Category</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection