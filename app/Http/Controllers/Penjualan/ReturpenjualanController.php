<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\http\Model\Penjualan\Returpenjualan;
use Illuminate\Http\Request;

class ReturpenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('penjualan.returpenjualan.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\http\Model\Penjualan\Returpenjualan  $returpenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Returpenjualan $returpenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\http\Model\Penjualan\Returpenjualan  $returpenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Returpenjualan $returpenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\http\Model\Penjualan\Returpenjualan  $returpenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Returpenjualan $returpenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\http\Model\Penjualan\Returpenjualan  $returpenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Returpenjualan $returpenjualan)
    {
        //
    }
}
