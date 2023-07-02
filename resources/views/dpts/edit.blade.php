@extends('layouts.app')

@section('title', __('outlet.list'))

@section('content')

<div class="row">
    <div class="col-md-6">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif

        {{ Form::model($dpt, array('route' => array('dpts.update', $dpt->id), 'method' => 'PUT')) }}

        {{ Form::hidden('id', null, array('class' => 'form-control')) }}

        <div class="mb-3">
            {{ Form::label('Kecamatan', 'Kecamatan', ['class'=>'form-label']) }}
            {{ Form::text('Kecamatan', null, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="mb-3">
            {{ Form::label('Kelurahan', 'Kelurahan', ['class'=>'form-label']) }}
            {{ Form::text('Kelurahan', null, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="mb-3">
            {{ Form::label('Kode_Kelurahan', 'Kode_kelurahan', ['class'=>'form-label']) }}
            {{ Form::text('Kode_Kelurahan', null, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="mb-3">
            {{ Form::label('No_TPS', 'No_TPS', ['class'=>'form-label']) }}
            {{ Form::text('No_TPS', null, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="mb-3">
            {{ Form::label('Latitude', 'Latitude', ['class'=>'form-label']) }}
            {{ Form::text('Latitude', null, array('class' => 'form-control','id'=>'Latitude','onchange'=>'handleInputValueChange()')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('Longitude', 'Longitude', ['class'=>'form-label']) }}
            {{ Form::text('Longitude', null, array('class' => 'form-control','id'=>'Longitude','onchange'=>'handleInputValueChange()')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('Jumlah_Pemilih', 'Jumlah_pemilih', ['class'=>'form-label']) }}
            {{ Form::text('Jumlah_Pemilih', null, array('class' => 'form-control')) }}
        </div>
        <div class="mb-3">
            {{ Form::label('validasi', 'Validasi', ['class'=>'form-label']) }}
            {{ Form::select('validasi', ['0' => 'Belum Valid', '1' => 'Sudah Valid'], null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>

    <div class="col-md-6">
        <div id="map" style="height: 500px;"></div>
    </div>
</div>
<style>
    #map-container {
        height: 100%;
        display: flex;
        align-items: stretch;
    }

    #map {
        flex-grow: 1;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map;
    var marker;

    function initMap() {
        // Get the initial Latitude and Longitude values from the form
        var initialLatitude = parseFloat('{{ $dpt->Latitude }}');
        var initialLongitude = parseFloat('{{ $dpt->Longitude }}');

        // Create a map centered at the initial coordinates
        map = L.map('map').setView([initialLatitude, initialLongitude], 14);

        // Add the tile layer (you can use different tile providers)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        // Add a marker at the initial coordinates
        marker = L.marker([initialLatitude, initialLongitude]).addTo(map);
    }

    function updateMarkerPosition(latitude, longitude) {
        // Update the marker position
        marker.setLatLng([latitude, longitude]);
    }

    function handleInputValueChange() {
        // Get the updated Latitude and Longitude values from the form inputs
        var latitude = parseFloat(document.getElementById('Latitude').value);
        var longitude = parseFloat(document.getElementById('Longitude').value);

        // Update the marker position on the map
        updateMarkerPosition(latitude, longitude);

        // Center the map on the updated coordinates
        map.setView([latitude, longitude]);
    }

    // Listen for input value changes
    document.getElementById('Latitude').addEventListener('input', handleInputValueChange);
    document.getElementById('Longitude').addEventListener('input', handleInputValueChange);

    window.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>

@endsection
