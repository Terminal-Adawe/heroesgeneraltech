@extends('layouts.head')

<head>
	<link rel="stylesheet" href="{{ asset('css/customer.css') }}" media="screen">
</head>

@section('content')
	@include('customer_features')
	@include('company_products')
	@include('customer_project_dashboard')
	<section class="u-clearfix u-grey-5 u-section-7" id="sec-8871">
		@include('contact_m')
	</section>

@endsection