@extends('admin.manage_operations')
@section('op_content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2><b>{{ __('Preview') }}</b></h2></div>

                <div class="card-body">
                    <div id="createInvoice"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection