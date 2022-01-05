@extends('layouts.head')

<head>
	<link rel="stylesheet" href="{{ asset('css/customer.css') }}" media="screen">
	<link rel="stylesheet" href="{{ asset('css/customer_c.css') }}" media="screen">
</head>

@section('content')
	@include('customer_landing_page')
	@include('customer_project_dashboard')
	@include('services')
	<section class="u-clearfix u-grey-5 u-section-7" id="sec-8871">
		@include('contact_m')
	</section>

@endsection

<!-- Modal -->
<div class="modal fade" id="requestService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('request-service') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
              <label for="service_name" class="form-label">Service Name </label>
              	<select class="form-select" name="service_id" aria-label="Default select example">
              		@foreach($data['services'] as $service)
				  		<option value="{{ $service->service_id }}">{{ $service->service_name }}</option>
				  	@endforeach
				</select>
            </div>
            <div class="mb-3">
              <label for="comment" class="form-label">Extra comment</label>
              <textarea name="comment" id="comment" class="form-control"></textarea>
              <!-- <input type="text" name="service_description" id="service_description" class="form-control"/> -->
            </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-primary">Request Service</button>
        </div>
      </form>
    </div>
  </div>
</div>

