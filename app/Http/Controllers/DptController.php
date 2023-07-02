<?php

namespace App\Http\Controllers;

use App\dpt;
use App\Http\Requests\StoredptRequest;
use App\Http\Requests\UpdatedptRequest;

class DptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\dpt  $dpt
     * @return \Illuminate\Http\Response
     */
    public function show(dpt $dpt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\dpt  $dpt
     * @return \Illuminate\Http\Response
     */
    public function edit(dpt $dpt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedptRequest  $request
     * @param  \App\dpt  $dpt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedptRequest $request, dpt $dpt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\dpt  $dpt
     * @return \Illuminate\Http\Response
     */
    public function destroy(dpt $dpt)
    {
        //
    }
}
