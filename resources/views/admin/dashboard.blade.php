<div class="row my-4">
	<div class="col-md-4">
		<div class="card card-shadow">
			<div class="centerDiv">
				<p class="mx-auto"><h1>
					{{ $data['customer_count']->number_of_users }}
				</h1>
				</p>
				<small>total customers</small>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card card-shadow">
			<div class="centerDiv">
				<p class="mx-auto"><h1>
					{{ $data['projects_count']->number_of_projects }}
				</h1>
				</p>
				<small>total projects</small>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card card-shadow">
			<div class="centerDiv">
				<p class="mx-auto"><h1>
					{{ $data['pending_projects_count']->number_of_projects }}
					</h1>
				</p>
				<small class="mx-auto">pending projects</small>
			</div>
		</div>
	</div>
</div>