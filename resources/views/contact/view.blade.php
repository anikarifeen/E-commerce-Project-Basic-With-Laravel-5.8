@extends('layouts.app')
{{-- @php 
error_reporting(0);

@endphp --}}
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card mb-3">
        <div class="card-header bg-success">
         List Contact Message
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
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
                <th scope="col">Action</th>
             
              {{--   <th scope="col">Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @forelse($contactmessages as $contactmessage)
              <tr class={{($contactmessage->read_status==0)? "bg-info" : ""}}>
                <th>{{$contactmessage->id}}</th>
                {{-- <th>{{App\Category::find($product->category_id)->category_name}}</th> --}}
                <th>{{$contactmessage->first_name}}</th>
                <th>{{$contactmessage->last_name}}</th>
                <th>{{$contactmessage->subject}}</th>
                <th>{{$contactmessage->message}}</th>
                <th><a href="{{url('contact/message/change')}}/{{$contactmessage->id}}" class="btn btn-sm btn-primary">Read/Unread</a></th>
               
                
               
               {{--  <th>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{url('/edit/product')}}/{{$product->id}}" type="button" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{url('/delete/product')}}/{{$product->id}}" type="button" class="btn btn-sm btn-danger">Delete</a>
                  </div>
                </th> --}}
              </tr>
              @empty
              <tr class="text-center text-danger">
                <th colspan="7">No Data Available</th>
              </tr>
              @endforelse
            </tbody>
          </table>
          {{-- {{$products->links()}} --}}
        </div>
      </div>

    </div>

  </div>
</div>
@endsection