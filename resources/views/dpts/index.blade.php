<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@extends('layouts.app')

@section('title', __('outlet.list'))

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table text-center table-striped w-100'], true) !!}
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
