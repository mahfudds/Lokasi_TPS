<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .modal {
        z-index: 1050; /* Adjust the value as needed */
    }
</style>
@php
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.app')

@section('title', __('outlet.list'))

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<div class="card">
    <div class="card-header">
        <a class="btn btn-sm btn-success" href="{{route('download')}}">Download</a>
        @if (Auth::user()->Kecamatan=='' && Auth::user()->Kode_Kelurahan=='' )
        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#uploadModal">Upload</button>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table text-center table-striped w-100'], true) !!}
        </div>
    </div>



    <div class="card-footer">

    </div>

</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"  style="background-color: #00235B; color: #FFDD83">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your file upload form here -->
                <form method="POST" action="{{route('import')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Select File:</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush


@endsection
