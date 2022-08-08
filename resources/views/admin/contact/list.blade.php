@extends('admin.layout.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">

<!-- Main content -->
<section class="content">
<div class="container-fluid">
    
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            
            <div class="card-tools d-flex">
               <a href="{{route('admin#contactDownload')}}"><button class="btn btn-sm btn-success me-3">DownLoad CSV</button><a>
               <form action="{{route('admin#contactSearch')}}" method="get">
                @csrf
               <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="searchData" class="form-control float-right mt-1" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default form-control">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
               </div>
               </form>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                </tr>
              </thead>
              <tbody>
                @if ($status == 0)
                <tr>
                    <td colspan="4">
                        <small class="text-muted">There is no data.</small>
                    </td>
                </tr>
                @else
                @foreach($contact as $item)
                <tr>
                  <td>{{$item -> contact_id}}</td>
                  <td>{{$item -> name}}</td>
                  <td>{{$item -> email}}</td>
                  <td>{{$item -> message}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
           <div class="mt-4 ms-3"> {{$contact->links()}}</div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection

