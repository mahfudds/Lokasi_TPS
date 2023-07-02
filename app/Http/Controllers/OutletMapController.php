<?php

namespace App\Http\Controllers;
use App\dpt;
use Yajra\DataTables\DataTables;
use App\DataTables\dptDataTable;
use Illuminate\Http\Request;

class OutletMapController extends Controller
{
    /**
     * Show the outlet listing in LeafletJS map.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $Kecamatan = null, $Kelurahan = null, dptDataTable $dataTable)
{
    $rekap = Dpt::select('Kecamatan', 'Kelurahan')
        ->selectRaw('SUM(Jumlah_pemilih) AS JumlahDPT')
        ->selectRaw('COUNT(No_TPS) AS JumlahTPS')
        ->groupBy('Kecamatan', 'Kelurahan')
        ->orderBy('Kecamatan')
        ->orderBy('Kelurahan')
        ->get();

    $locations = [];

    if ($Kecamatan && $Kelurahan) {
        $locations = Dpt::where('Kecamatan', $Kecamatan)
            ->where('Kelurahan', $Kelurahan)
            ->get()
            ->toArray();
    } elseif ($Kecamatan) {
        $locations = Dpt::where('Kecamatan', $Kecamatan)
            ->get()
            ->toArray();
    } elseif (is_null($Kecamatan) && is_null($Kelurahan)) {
        $locations = Dpt::where('Kode_Kelurahan', 'LIKE', '352113%')
    ->get()
    ->toArray();
    }

    $distinctKecamatan = Dpt::distinct()->orderBy('Kecamatan')->pluck('Kecamatan');
    return $dataTable->render('outlets.map', compact('locations', 'rekap', 'Kecamatan', 'Kelurahan','distinctKecamatan'));
}

}
