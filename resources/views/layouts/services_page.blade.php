@extends('layouts.head')

<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" media="screen">

    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" media="screen">
</head>

@section('content')
<div class="container-fluid services-page">
  @if(Auth::check() && Auth::user()->username=='admin')
	<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#addService">Add new service</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Edit</a>
    </li>
  </ul>
  <hr>
  @endif
	@include('services')
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="addService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('add-service') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
              <label for="service_name" class="form-label">Service Name </label>
              <input type="text" name="service_name" id="service_name" class="form-control"/>
            </div>
            <div class="mb-3">
              <label for="service_description" class="form-label">Service Description</label>
              <textarea name="service_description" id="service_description" class="form-control">
                
              </textarea>
              <!-- <input type="text" name="service_description" id="service_description" class="form-control"/> -->
            </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-primary">Add Service</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>