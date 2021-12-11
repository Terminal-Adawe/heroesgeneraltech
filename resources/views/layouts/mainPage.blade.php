@extends('layouts.head')
<head>
	<link rel="stylesheet" href="{{ asset('css/Home.css') }}" media="screen">
</head>

@section('content')
	@include('carousel')
	@include('whatWeDo')
	@include('projects')
	@include('partners')
	<section class="u-clearfix u-grey-5 u-section-5" id="carousel_7145">
		@include('contact_m')
	</section>

@endsection