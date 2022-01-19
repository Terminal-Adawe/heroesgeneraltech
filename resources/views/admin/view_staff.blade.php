@extends('admin.manage_staff')
@section('user_content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2><b>{{ __('Staff') }}</b></h2></div>
                <input type="hidden" name="user_role" value={{ Auth::user()->role }}>
                <div class="card-body">
                    <div class="container-fluid">
                        @foreach($data['users'] as $user)
                        <div class="row">
                            <div class="invoice-list shadow1 mt-1">
                                <div class="d-flex mb-3">
                                    <div class="me-auto p-2">
                                        {{ $user->name }}
                                    </div>
                                    <div class="p-2">
                                        {{ $user->role_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection