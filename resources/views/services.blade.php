<div class="row" style="background-color: #f8f9f9; padding-top: 40px;">
<div class="container-fluid my-4">
	<div class="row my-2">
		<div class="col-12">
			<h1 class="mx-auto">
				Services
			</h1>
		</div>
	</div>
<div class="row">
	@foreach($data['services'] as $i=>$service)
		<div class="col-md-4 mt-2">
			<div class="card card-shadow2" data-aos="fade-left" data-aos-offset="300" data-aos-delay="30">
				<div class="card-body">
					<h2><b>{{ $service->service_name }}</b></h2>

					<p>
					{{ $service->service_description }}
					</p>
					
					<hr>
					<a class="btn btn-outline-secondary" href="{{ route('view-service',['service_id'=>$service->service_id]) }}">
					Learn More
					</a>
					@if(Auth::check() && Auth::user()->username=="admin")
					<a class="btn btn-outline-secondary" href="{{ route('edit-service',['service_id'=>$service->service_id]) }}">
					Edit
					</a>
					@endif
				</div>
				
			</div>
		</div>
	@endforeach
</div>
</div>
</div>