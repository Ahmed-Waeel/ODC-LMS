<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/app1.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app_home.css') }}" rel="stylesheet">
</head>
<body>
    <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-white bg-dark" style="width: 250px;"> <a href="{{url('admin')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"> <svg class="bi me-2" width="40" height="32"> </svg> <span class="fs-4">Orange Hackathon</span> </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"> <a href="{{url('admin/categories')}}" class="nav-link text-white" aria-current="page"> <i class="fa fa-home"></i><span class="ms-2">categories</span> </a> </li>
            <li> <a href="{{url('admin/courses')}}" class="nav-link text-white"> <i class="fa fa-dashboard"></i><span class="ms-2">Courses</span> </a> </li>
            <li> <a href="{{url('admin/students')}}" class="nav-link text-white"> <i class="fa fa-first-order"></i><span class="ms-2">Students</span> </a> </li>
            <li> <a href="{{url('admin/questions')}}" class="nav-link text-white"> <i class="fa fa-cog"></i><span class="ms-2">questions</span> </a> </li>
            <li> <a href="{{url('admin/trainers')}}" class="nav-link text-white"> <i class="fa fa-cog"></i><span class="ms-2">Trainers</span> </a> </li>
            <li> <a href="{{url('admin/admins')}}" class="nav-link text-white"> <i class="fa fa-bookmark"></i><span class="ms-2">Sub-Admins</span> </a> </li>
        </ul>
        <hr>

                <a class="text-white nav_link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
             </a>


             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>



    </div>


</body>
</html>
