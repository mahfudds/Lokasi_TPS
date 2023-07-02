<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DataTables\dptsDataTable;
use App\Dpt;
use App\Http\Requests\DptRequest;

class DptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index( dptsDataTable $dataTable)
    {

        $dpts= Dpt::all();
        return $dataTable->render('dpts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dpts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DptRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DptRequest $request)
    {
        $dpt = new Dpt;
		$dpt->ID = $request->input('ID');
		$dpt->Kecamatan = $request->input('Kecamatan');
		$dpt->Kelurahan = $request->input('Kelurahan');
		$dpt->Kode_kelurahan = $request->input('Kode_kelurahan');
		$dpt->No_TPS = $request->input('No_TPS');
		$dpt->Latitude = $request->input('Latitude');
		$dpt->Longitude = $request->input('Longitude');
        $dpt->l = $request->input('l');
        $dpt->p = $request->input('p');
		$dpt->Jumlah_pemilih = $request->input('Jumlah_pemilih');
		$dpt->validasi = $request->input('validasi');
        $dpt->save();

        return redirect()->route('dpts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $dpt = Dpt::findOrFail($id);
        return view('dpts.show',['dpt'=>$dpt]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $dpt = Dpt::findOrFail($id);
        return view('dpts.edit',['dpt'=>$dpt]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DptRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DptRequest $request, $id)
    {
        $dpt = Dpt::findOrFail($id);
		$dpt->id = $request->input('id');
		$dpt->Kecamatan = $request->input('Kecamatan');
		$dpt->Kelurahan = $request->input('Kelurahan');
		$dpt->Kode_Kelurahan = $request->input('Kode_Kelurahan');
		$dpt->No_TPS = $request->input('No_TPS');
		$dpt->Latitude = $request->input('Latitude');
		$dpt->Longitude = $request->input('Longitude');
        $dpt->l = $request->input('l');
        $dpt->p = $request->input('p');
		$dpt->Jumlah_Pemilih = $dpt->l + $dpt->p ;
		$dpt->validasi = $request->input('validasi');
        $dpt->save();

        return redirect()->route('dpts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $dpt = Dpt::findOrFail($id);
        $dpt->delete();

        return to_route('dpts.index');
    }
}
