@extends('layouts.head')

<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" media="screen">

    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" media="screen">
</head>

@section('content')
<div class="container-fluid my-4">
	<nav aria-label="breadcrumb my-4" style="padding-top: 50px;">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Projects</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Project Details</li>
	  </ol>
	</nav>
	<div class="row mt-4">
		<div class="col-md-5 col-sm-12 mt-4">
			<div class="row mb-4">
				<input type="hidden" id="due_date" value="{{ $data['project_details'][0]->objective_completion_date }}">
				<div class="mt-4 p-5 bg-secondary text-white rounded">
  					Due Date: <h1><div id="projectCountDown"></div></h1>
				</div>
			</div>
			<div class="row my-2">
				<div class="col-12">
				<h2>Progress..</h2>
				<ul style="list-style-type:none;">
				@foreach($data['stages'] as $stage)
					@if($stage->position!=2)
					<li>
						@if($stage->service_stage_id==$data['project_details'][0]->stage) &#10004; @elseif($data['project_details'][0]->position>$stage->position) &#10004; @else &nbsp; @endif {{ $stage->service_stage_name }}
					</li>
					@endif
					@if ($loop->last) 
						<li>
						@if($stage->service_stage_id==$data['project_details'][0]->stage) &#10004; @elseif($stage->position<$data['project_details'][0]->position) &#10004; @else &nbsp; @endif completed
						</li> 
					@endif
				@endforeach
				</ul>
				</div>
			</div>
			<div class="row">
				<div class="progress">
				  <div class="progress-bar" role="progressbar" style="width: {{ $data['progress'] }}%" aria-valuenow="{{ $data['progress'] }}" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="col-md-7 col-sm-12 mt-4">
			<div class="row mt-4">
				<div class="col-md-7 col-sm-12">
					<div class="card">
						<img src="{{ asset('images/cctv3.jpg') }}">
					</div>
				</div>
				<div class="col-md-5 col-sm-12 mt-4">
					@foreach($data['project_details'] as $project_detail)
						@if ($loop->first) 
							<h1>{{ $project_detail->service_name }}</h1> 
						@endif
					@endforeach
				</div>
			</div>
			<hr>
			<div class="row mt-4">
				<div class="col-12"> 
				@foreach($data['project_details'] as $project_detail)
						@if ($loop->first) 
							{{ nl2br($project_detail->service_description) }}
						@endif
				@endforeach
				</div>
				<div class="col-md-6 col-sm-12">
					
				</div>
				<div class="col-md-6 col-sm-12">
					<ul>
						@foreach($data['features'] as $feature)
							<li>
								{{ $feature->service_feature_name }}
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>		
	</div>
	<hr>
	<div class="row">
		<div class="col-12 my-2">
			<h2>Provide updates on this project</h2>
		</div>
		<div class="col-md-8 col-sm-12">
			<form action="{{ route('update-project') }}" method="POST">
				@csrf
				<input type="hidden" name="project_id" value="{{ $data['project_details'][0]->customer_project_id }}">
			<div class="row">
				<div class="col-md-6 col-sm-12 mt-2">
					<label>Update stage</label>
					<select class="form-select" name="service_stage_id" aria-label="Default select example">
			  			<option value="{{ $data['project_details'][0]->stage }}" selected>{{ $data['project_details'][0]->service_stage_name }}</option>
			  			@foreach($data['stages'] as $stage)
			  				<option value="{{ $stage->service_stage_id }}">{{ $stage->service_stage_name }}</option>
			  			@endforeach
					</select>
				</div>
				<div class="col-md-6 col-sm-12 mt-2"><label>Add comment</label>
					<textarea class="form-control" id="comment" rows="2" name="comment">{{ $data['project_details'][0]->comment }}</textarea>
				</div>
				<div class="col-6 mt-4">
					<label>Date project will be completed</label>
					<input type="date" name="due_date" class="form-control" value="{{ $data['project_details'][0]->objective_completion_date }}">
				</div>
				<div class="col-6 mt-4">
					<label>What is the cost of this project?</label>
					<input type="number" name="cost" class="form-control" value="{{ $data['project_details'][0]->cost }}">
				</div>
			</div>
			<div class="row my-2">
				<div class="col-12 mt-1">
					<button class="btn btn-block btn-secondary mx-1" type="submit">Update</button>	

					<button class="btn btn-block btn-success mx-1" type="button" data-bs-toggle="modal" data-bs-target="#closeProject">Close Project</button>	
				</div>
			</div>
			</form>
		</div>
		
		<div class="col-md-4 col-sm-12">
			<div class="card">
				<button class="btn btn-primary">Send Notification</button>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="closeProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Close this project?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('close-project') }}" method="POST">
        @csrf
        <input type="hidden" name="project_id" value="{{ $data['project_details'][0]->customer_project_id }}">
        <div class="modal-body">
            <div class="mb-3">
              <label for="service_name" class="form-label">Please confirm </label>
              	<select class="form-select" name="service_stage_id" aria-label="Default select example">
				  		<option value="2">Completed</option>
				  		<option value="3">Cancelled</option>
				</select>
            </div>
            <div class="mb-3">
              <label for="comment" class="form-label">Comment</label>
              <textarea name="comment" id="comment" class="form-control">{{ $data['project_details'][0]->comment }}</textarea>
              <!-- <input type="text" name="service_description" id="service_description" class="form-control"/> -->
            </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-primary">Confirm closure</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>