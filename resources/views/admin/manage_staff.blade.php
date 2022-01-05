@extends('layouts.head')


@section('content')
  @if(Auth::check() && Auth::user()->username=='admin')
  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="#">Add new service</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Edit</a>
    </li>
  </ul>
  <hr>
  @endif
	@include('customer_landing_page')
	@include('customer_project_dashboard')
	@include('services')
	<section class="u-clearfix u-grey-5 u-section-7" id="sec-8871">
		@include('contact_m')
	</section>

@endsection


