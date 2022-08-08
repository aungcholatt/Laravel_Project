@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('uploads/'.$pizza->image)}}" width="100%">            <br>
            <a href="{{route('user#order')}}"><button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Order</button></a>
            <a href="{{route('user#index')}}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
         <h5>Name</h5>
         <small>{{$pizza->pizza_name}}</small><hr>
         <h5>Price</h5>
         <small>{{$pizza->price}}</small> Kyats<hr>
         <h5>Price</h5>
         <small>{{$pizza->price}}</small> Kyats<hr>
         <h5>Discount Price</h5>
         <small>{{$pizza->discount_price}}</small><hr>
         <h5>Buy One Get One</h5>
         <small>
            @if($pizza->buy_one_get_one_status == 0)
              Not have
            @else
              Have
            @endif
        </small><hr>
           <h5>Waiting Time</h5>
              <small>{{$pizza->waiting_time}}</small>Minutes<hr>
            <h5>Description</h5>
            <small>{{$pizza->description}}</small>
            <br><br>
            <div class="">
            <h5 class="text-danger">Total Price</h5>
            <h3 class="text-success">{{$pizza->price - $pizza->discount_price}} Kyats</h3>
            </div>
        </div>
    </div>
@endsection