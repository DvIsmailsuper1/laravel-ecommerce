@extends('user.layouts.usertemplate')
@section('main-content')
  <div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box_main">
               <ul>
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('pendingorders')}}">Pending Orders</a></li>
                <li><a href="{{route('history')}}">History</a></li>
                <li><a href="{{route('logout')}}">Logout</a></li>
               </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="box_main">
              @yield('content')
            </div>
        </div>
    </div>
  </div>
@endsection