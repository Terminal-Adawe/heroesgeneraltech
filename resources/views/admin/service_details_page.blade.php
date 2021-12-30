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
                <div class="card-header">{{ __('Service Details') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($data['action']=='edit')
                        @include('admin.service_details_edit')
                    @else
                        @include('admin.service_details')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete <span class="anym"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('delete-service') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="" id="seType">
        <input type="hidden" name="id_" value="" id="id_">
        <input type="hidden" name="sid" value="" id="sid">

        <div class="modal-body">
            <p>
                Are you sure you want to delete this <span class="anym"></span>?
            </p>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-danger">Confirm Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.min.js') }}"></script>
