<div class="container-fluid mt-4">
	<div class="row">
		<div class="card">
			<div class="card-body">
            	<ol class="list-group list-group-numbered">
            		@foreach($data['customer_projects'] as $project)
 				 	<li class="list-group-item d-flex justify-content-between align-items-start">
 				   		<div class="ms-2 me-auto">
 				     	<div class="fw-bold">{{ $project->service_name }}</div>
 				     		{{ $project->name }}
 				   		</div>

 				   		<div class="ms-2 mr-auto">
 				   			<span class="badge bg-primary rounded-pill mt-1">{{ $project->service_stage_name }}</span>
 				   
 				   			<span class="badge bg-info rounded-pill mt-1"><a href="{{ route('view-project',['project_id'=>$project->customer_project_id]) }}" class="white-link">view</a></span>
 				   		</div>
  					</li>
  					@endforeach
  				</ol>
            </div>
		</div>
	</div>
</div>