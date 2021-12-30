@extends('layouts.head')

<head>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" media="screen">

    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" media="screen">
</head>

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('admin.tabs')
                </div>
            </div>

            @include('services')
        </div>
    </div>
</div>
@endsection

<script type="text/javascript" src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>