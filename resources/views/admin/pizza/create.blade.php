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
                  <legend class="text-center">Add Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                    <form class="form-horizontal" method="Post" action="{{route('admin#insertPizza')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Name" name="name">
                            @if ($errors -> has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="image" class="col-sm-2 col-form-label">Image</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" placeholder="Enter Image" name="image">
                            @if ($errors -> has('image'))
                            <p class="text-danger">{{$errors->first('image')}}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="price" class="col-sm-2 col-form-label">Price</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter Price" name="price">
                            @if ($errors -> has('price'))
                            <p class="text-danger">{{$errors->first('price')}}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="publish" class="col-sm-2 col-form-label">Publish Status</label>
                          <div class="col-sm-10">
                           <select name="publish" class="form-control">
                           <option value="">Choose Option...</option>
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                           </select>
                            @if ($errors -> has('publish'))
                            <p class="text-danger">{{$errors->first('publish')}}</p>
                            @endif
                          </div>
                        </div>
      
                        <div class="form-group row">
                          <label for="category" class="col-sm-2 col-form-label">Category</label>
                          <div class="col-sm-10 mt-2">
                           <select name="category" class="form-control">
                            <option value="">Choose Category</option>
                             @foreach($category as $item)
                             <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                             @endforeach
                           </select>
                            @if ($errors -> has('category'))
                            <p class="text-danger">{{$errors->first('category')}}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="discount" class="col-sm-2 col-form-label">Discount</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter Discount Price" name="discount">
                            @if ($errors -> has('discount'))
                            <p class="text-danger">{{$errors->first('discount')}}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="buyOneGetOne" class="col-sm-2 col-form-label">BuyOneGetOne</label>
                          <div class="col-sm-10 mt-2">
                          <input type="radio" name="buyOneGetOne" class="form-input-check" value="1">Yes
                             <input type="radio" name="buyOneGetOne" class="form-input-check" value="0">No
                            @if ($errors -> has('buyOneGetOne'))
                            <p class="text-danger">{{$errors->first('buyOneGetOne')}}</p>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="waitingTime" class="col-sm-2 col-form-label">WaitingTime</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter WaitingTime" name="waitingTime">
                            @if ($errors -> has('waitingTime'))
                            <p class="text-danger">{{$errors->first('waitingTime')}}</p>
                            @endif
                          </div>
                        </div>
                          
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="description" rows="3" 
                            placeholder="Enter Description"></textarea>
                            @if ($errors -> has('description'))
                            <p class="text-danger">{{$errors->first('description')}}</p>
                            @endif
                          </div>
                        </div>


                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Add</button>
                          </div>
                        </div>
                      </form>
                      
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