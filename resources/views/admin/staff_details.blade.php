@extends('admin.manage_staff')
@section('user_content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header-c">
                    <div class="profileImage">
                        
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center profile-summary">
                        <div class="col-6">
                            <p>
                                {{ $data['user']->name }}
                            </p>
                            <p>
                                {{ $data['user']->location }}
                            </p>
                            <p>
                                {{ $data['user']->contact_number }}
                            </p>
                            <p>
                                {{ $data['user']->email }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-2">
                    <div class="row">
                        <div class="col-12">
                            <b>Username</b>: {{ $data['user']->username }}
                        </div>
                        <div class="col-12">
                            <b>Position</b>: {{ $data['user']->position }}
                        </div>
                        <div class="col-12 mt-4">
                            <div class="row"><h3 class="text-muted">About</h3></div>
                            {{ $data['user']->about }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection