@extends('admin.manage_operations')
@section('op_content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2><b>{{ __('Invoices') }}</b></h2></div>
                <input type="hidden" name="user_role" value={{ Auth::user()->role }}>
                <div class="card-body">
                    <div id="invoices"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection