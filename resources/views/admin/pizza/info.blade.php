@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-1">
          <div class="col-9 offset-2 mt-5">
            <div class="col-md-9">
              <a href="{{route('admin#pizza')}}" class="text-decoration-none"><div class="mb-4"><button class="btn btn-sm btn-dark"><< Back</button></div></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Pizza Information</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane d-flex justify-content-center" id="activity">
                    <div class="mt-2 text-center py-4 px-3 pt-4">
                        <img class="img-thumbnail" src="{{asset('uploads/'.$pizza->image)}}" style="width:300px;heigh:300px">
                    </div>
                    <div>
                     <div class="mt-3">
                        <b>Name</b>: <span>{{$pizza->pizza_name}}</span>
                     </div>
                     <div class="mt-3">
                        <b>Price</b>: <span>{{$pizza->price}} Kyats</span>
                     </div>
                     <div class="mt-3">
                        <b>Publish Status</b>: 
                        <span>
                        @if($pizza->publish_status==1)
                            Yes
                       @else
                            No
                       @endif
                        </span>
                     </div>
                     <div class="mt-3">
                        <b>Category</b>: <span>{{$pizza->category_id}} Kyats</span>
                     </div>
                     <div class="mt-3">
                        <b>Discount Price</b>: <span>{{$pizza->discount_price}} Kyats</span>
                     </div>
                     <div class="mt-3">
                        <b>Buy One Get One Status</b>: 
                        <span>
                        @if($pizza->buy_one_get_one_status==1)
                            Yes
                       @else
                            No
                       @endif
                        </span>
                     </div>
                     <div class="mt-3">
                        <b>Wait Time</b>: <span>{{$pizza->waiting_time}}</span>
                     </div>
                     <div class="mt-3">
                        <b>Description</b>: <span>{{$pizza->description}}</span>
                     </div>
                    </div>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection