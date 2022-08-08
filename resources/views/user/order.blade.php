@extends('user.layout.style')

@section('content')
<div class="row mt-5 d-flex justify-content-center">
        <div class="col-4 ">
            <img src="{{ asset('uploads/'.$pizza->image)}}" width="100%">            <br>
            <a href="{{route('user#index')}}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
        @if(Session::has('totalTime'))
    <div class="alert alert-warning alert-dismissible fade show m-2" role="alert">
        Order Success ! Please wait {{Session::get('totalTime')}} Minutes....
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
    @endif
         <h5>Name</h5>
         <small>{{$pizza->pizza_name}}</small><hr>
         <h5>Price</h5>
         <small>{{$pizza->price - $pizza->discount_price}}</small> Kyats<hr>
           <h5>Waiting Time</h5>
              <small>{{$pizza->waiting_time}}</small>Minutes<hr>
              <form action="" method="post">
                @csrf
              <h5>Pizza Count</h5>
              <input type="number" name="pizzaCount" id="" class="form-control" placeholder="Number of you want"><hr>
              @if ($errors->has('pizzaCount'))
              <p class="text-danger">{{$errors->first('pizzaCount')}}</p>
              @endif
              <h5>Payment Type</h5>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="paymentType" id="inlineCheckbox1" value="1">
              <label class="form-check-label" for="inlineCheckbox1">Credit Card</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="paymentType" id="inlineCheckbox2" value="2">
              <label class="form-check-label" for="inlineCheckbox2">Cash</label>
            </div></br>
            @if ($errors->has('paymentType'))
              <p class="text-danger">{{$errors->first('paymentType')}}</p>
              @endif
            <button class="btn btn-primary mt-4"><i class="fas fa-shopping-cart"></i> Place Order</button>
          </form>
            </div>
        </div>
    </div>
@endsection