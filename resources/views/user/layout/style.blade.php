<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pizza Order System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('customer/assets/favicon.ico')}}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('customer/css/styles.css')}}" rel="stylesheet" />
      <!-- CSS link asset -->
    <link rel="stylesheet" href="{{asset('customer/css/list.css')}}"/>
      <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
       <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
          <!-- cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <style>
      
    </style>
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container px-5">
            <a class="navbar-brand" href="#!">Pizza Order System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('user#index')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('user#index')}}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pizza">Pizza</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-primary" href="{{route('user#profile')}}">{{Auth()->user()->name}}</a></li>
                        <form class="d-flex" method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                Logout
                        </form>
                </ul>
            </div>
        </div>
    </nav>
@yield('content')

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{asset('customer/js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>
</body>
 <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</html>