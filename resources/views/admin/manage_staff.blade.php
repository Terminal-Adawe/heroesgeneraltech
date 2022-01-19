@extends('layouts.head')

<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" media="screen">
</head>


@section('content')
  @if(Auth::check() && Auth::user()->username=='admin')
  <div class="container-fluid" style="font-size: 12px;">
    <div class="row my-4">
        <div class="col-md-4 col-sm-12">
          <div class="users_menu mx-auto">
            <ul class="list-group list-group-custom" style="padding-top:50px; padding-bottom:30px; padding-left: 30px; padding-right: 20px; list-style-type:none;">
              <li class="list-group-item">
                <a href="{{ route('add-staff') }}">Add Users</a>
              </li>
              <li class="list-group-item">
                <a href="{{ route('view-staff') }}">View Users</a>
              </li>
              <li class="list-group-item">
                <a href="#">Settle Users</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-8  col-sm-12">
          @yield('user_content')
        </div>
    </div>
  </div>
  @endif


@endsection


