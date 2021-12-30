<div class="row" style="margin-top: 80px;">
    <div class="container">
        <form method="POST" action="{{ url('/save-service') }}">  
            @csrf      
            <input type="hidden" name="service_id" id="service_id" value="{{ $data['service_details']->service_id }}">
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-success mx-4">Save</button>
                <button type="button" class="btn btn-danger mx-4 delete_service" data-bs-toggle="modal" data-bs-target="#delete_modal"  >Delete</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 my-4">
                <h2>Service Name</h2>
                <textarea class="form-control" name="service_name">{{ $data['service_details']->service_name }}</textarea>
            </div>
            <hr>
        </div>

        <div class="row">
            <div class="col-12 my-4">
                <h2>Service Description</h2>
                <textarea class="form-control" name="service_description" rows="5">{{ $data['service_details']->service_description }}</textarea>
            </div>
            <hr>
        </div>
        </form>



        <div class="row">
            <span><h2>Features</h2></span>

            <div class="col-12">
                <div id="features"></div>
            </div>
            <hr>
        </div>

        <div class="row">
            <span><h2>Stages</h2></span>

            <div class="col-12">
                <div id="stages"></div>
            </div>
            <hr>
        </div>
    </div>
</div>