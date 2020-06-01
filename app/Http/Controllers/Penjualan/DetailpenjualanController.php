<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\http\Model\Penjualan\Detailpenjualan;
use App\Http\Model\Role\Role;
use Illuminate\Http\Request;

class DetailpenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Detailpenjualan::get();
        return view('penjualan.detailpenjualan.index', [
            'data' => $data
        ]);
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
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Detailpenjualan $detailpenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Detailpenjualan $detailpenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detailpenjualan $detailpenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detailpenjualan $detailpenjualan)
    {
        //
    }
}
