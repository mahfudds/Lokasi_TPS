@extends('default')

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			@foreach ($errors->all() as $error)
				{{ $error }} <br>
			@endforeach
		</div>
	@endif

	{!! Form::open(['route' => 'dpts.store']) !!}

		<div class="mb-3">
			{{ Form::label('ID', 'ID', ['class'=>'form-label']) }}
			{{ Form::text('ID', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Kecamatan', 'Kecamatan', ['class'=>'form-label']) }}
			{{ Form::text('Kecamatan', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Kelurahan', 'Kelurahan', ['class'=>'form-label']) }}
			{{ Form::text('Kelurahan', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Kode_kelurahan', 'Kode_kelurahan', ['class'=>'form-label']) }}
			{{ Form::text('Kode_kelurahan', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('No_TPS', 'No_TPS', ['class'=>'form-label']) }}
			{{ Form::text('No_TPS', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Latitude', 'Latitude', ['class'=>'form-label']) }}
			{{ Form::text('Latitude', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Longitude', 'Longitude', ['class'=>'form-label']) }}
			{{ Form::text('Longitude', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('Jumlah_pemilih', 'Jumlah_pemilih', ['class'=>'form-label']) }}
			{{ Form::text('Jumlah_pemilih', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('validasi', 'Validasi', ['class'=>'form-label']) }}
			{{ Form::text('validasi', null, array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}


@stop