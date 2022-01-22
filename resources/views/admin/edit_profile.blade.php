@extends('layouts.head')

<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" media="screen">
</head>


@section('content')
  @if(Auth::check() && Auth::user()->username=='admin')
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-8 col-sm-12">
    		@include('admin.staff_profile')
    	</div>
    	<div class="col-md-4 col-sm-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if (session('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
        @endif

    		<div class="mx-auto">
    	        <ul class="list-group list-group-flush" style="padding-top:50px; padding-bottom:30px; padding-left: 30px; padding-right:20px; list-style-type:none; text-align: center; padding-top: 190px;">
    	          <li class="list-group-item">
    	          	<div class="invoice-list shadow1">
    	            	<a href="#" class="black-link" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change password</a>
    	            </div>
    	          </li>
    	          <li class="list-group-item">
    	          	<div class="invoice-list shadow1">
    	            	<a href="{{ route('edit-profile') }}" class="black-link">Edit Profile</a>
    	            </div>
    	          </li>
    	        </ul>
    	      </div>
    	</div>
    </div>
  </div>
  @endif


@endsection


