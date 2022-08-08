@extends('user.layout.style')

@section('content')
<div class="container-fluid">
        <div class="row mt-4">
          <div class="col-5 offset-4 mt-5">
            <div class="col-md-9">
               <div class="card ">
                <div class="card-header p-2">
                  <legend class="text-center">User Profile</legend>
                   </div>
                  <div class="card-body p-2">
                  <table class="table table-hover text-nowrap text-center">
              <tbody>
                @foreach($user as $item)
                <tr>
                  <td>Name</td><td>{{$item -> name}}</td>
               </tr>
               <tr>
                  <td>Email</td><td>{{$item -> email}}</td>
               </tr>
               <tr>
                  <td>Phone</td><td>{{$item -> phone}}</td>
              </tr>
               <tr>
                  <td>Address</td><td>{{$item -> address}}</td>
                </tr>
                @endforeach
                <tr><td colspan="2">
                <div class="float-end mt-4">
              <form class="d-flex" method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-dark">
                                Logout
                        </form>
                      </div>
                  </td></tr>  
            </table>
               </div>
            </div>
          </div>
        </div>
     </div>
  </div>
  @endsection