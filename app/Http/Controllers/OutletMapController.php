<?php

namespace App\Http\Controllers;
use App\dpt;
use Yajra\DataTables\DataTables;
use App\DataTables\dptDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use ConsoleTVs\Charts\Classes\Chartjs\Plugins;
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
    $rekapkab = DB::table('dpt')
    ->select('Kecamatan', DB::raw('SUM(Jumlah_Pemilih) AS DPT'))
    ->groupBy('Kecamatan')
    ->get();

    $color = '#00235B'; // Specify the desired color

    $chartrekap = new Chart;
    $chartrekap->labels($rekapkab->pluck('Kecamatan'));

    $dataset = $chartrekap->dataset('DPT', 'bar', $rekapkab->pluck('DPT')->toArray());
    $dataset->backgroundColor($color)->color($color);
    $dataset->fill(true); // Enable filling



    return $dataTable->render('outlets.map', compact('locations', 'rekap', 'Kecamatan', 'Kelurahan','distinctKecamatan','chartrekap'));
}

}
