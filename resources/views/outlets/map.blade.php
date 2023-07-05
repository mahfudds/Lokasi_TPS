@extends('layouts.app')

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">

        <div class="dropdown">
            <button style="background-color:#00235B; color:#fff" class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih Kecamatan
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($distinctKecamatan as $item)
                <a class="dropdown-item" href="{{ url('dpt/' . $item) }}"> {{ $item }} </a>
            @endforeach
            </div>
        </div>
        <div class="header-title"> TPS - {{ isset($Kecamatan) ? $Kecamatan : ''}} - {{ isset($Kelurahan) ? $Kelurahan : ''}}</div>
    </div>
    <div class="card-body" id="mapid"></div>
</div>

<div class="mt-3"></div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title"> </div>
        </div>
        <div class="card-body px-2">
            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table text-center table-striped w-100'], true) !!}
            </div>
        </div>
    </div>

    <div class="mt-3"></div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title"> </div>
        </div>
        <div class="card-body px-2">
            <div class="table-responsive">
                {!! $chartrekap->container() !!}

            </div>
        </div>
    </div>
    @if (isset($chartkecamatan))

    <div class="mt-3"></div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title"> </div>
        </div>
        <div class="card-body px-2">
            <div class="table-responsive">
                {!! $chartkecamatan->container() !!}

            </div>
        </div>
    </div>

    @endif

@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<style>
    #mapid { min-height: 70vh; }
    .custom-marker0 {
        background-color:#00235B;
        border-radius: 50%;
        color: rgb(255, 255, 255);
        font-size: 7pt;
        text-align: center;
        font-weight: bold;
        line-height: 24px;
        border: 1px solid #FFDD83;
    }
    .custom-marker1 {
        background-color: rgb(247, 7, 7);
        border-radius: 50%;
        color: rgb(255, 255, 255);
        font-size: 8pt;
        text-align: center;
        font-weight: bold;
        line-height: 24px;
        border: 1px solid #00235B;
    }
    .card-header{
        background-color: rgb(245, 1, 13);
        color: rgb(255, 255, 255);
    }
</style>
@endsection

@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.gridlayer.googlemutant@1.1.0/dist/Leaflet.GoogleMutant.js"></script>
@if (isset($chartkecamatan))
{!! $chartkecamatan->script() !!}
@endif
{!! $chartrekap->script() !!}
<script>
    var map = L.map('mapid');

    var locations = {!! json_encode($locations) !!};
    
    
    function getDirections(latitude, longitude) {
        // Construct the URL for retrieving directions based on the latitude and longitude
        var directionsURL = 'https://maps.google.com/maps?q=' + latitude + ',' + longitude;
    
        // Open the directions URL in a new tab or window
        window.open(directionsURL, '_blank');
    }
    locations.forEach(function(location) {
        var latitude = parseFloat(location['Latitude']);
        var longitude = parseFloat(location['Longitude']);

        if (isNaN(latitude) || isNaN(longitude)) {
            return;
        }

        var markerIcon = L.divIcon({
            className: 'custom-marker'+location['validasi'],
            html: location['No_TPS'],
            iconSize: [24, 24],
            iconAnchor: [12, 12],
            markerColor: 'gray' // Set a single color for all markers
        });

        var marker = L.marker([latitude, longitude], {
            icon: markerIcon
        }).addTo(map)
       .bindPopup(`
            <h5 style='color: red'>${location['Kelurahan']} -  ${location['No_TPS']}</h5>
            Kecamatan: ${location['Kecamatan']}<br>
            Alamat : ${location['alamat']}<br>
            Jumlah Pemilih: ${location['Jumlah_Pemilih']}<br>
            <button class='btn btn-sm btn-danger' onclick="getDirections(${location['Latitude']}, ${location['Longitude']})">Menuju TPS</button>
            `);
        
        });

    var markerLatLngs = locations.map(function(location) {
        var latitude = parseFloat(location['Latitude']);
        var longitude = parseFloat(location['Longitude']);
        return L.latLng(latitude, longitude);
    });

    var markerBounds = L.latLngBounds(markerLatLngs);

    map.fitBounds(markerBounds);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 22
    }).addTo(map);
    
    var defaultTileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data © OpenStreetMap contributors'
    }).addTo(map);
    
    // Add the satellite tile layer
    var satelliteTileLayer = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Imagery © Esri',
    maxZoom: 22
    });
    
    
    
    var baseLayers = {
    'Map View': defaultTileLayer,
    'Satellite View': satelliteTileLayer
    };
    L.control.layers(baseLayers).addTo(map);
    
    // Event handler for toggle button click
    document.getElementById('toggleView').addEventListener('click', function() {
        // Check the current map view
        var currentTileLayer = map.hasLayer(defaultTileLayer) ? defaultTileLayer : satelliteTileLayer;
        
        // Remove the current tile layer from the map
        map.removeLayer(currentTileLayer);
        
        // Add the other tile layer to the map
        var newTileLayer = currentTileLayer === defaultTileLayer ? satelliteTileLayer : defaultTileLayer;
        newTileLayer.addTo(map);
    });

</script>
@endpush
