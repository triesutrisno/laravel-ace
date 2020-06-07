<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JualReturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('penjualan.jualretur.index');
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
     * @param  \App\http\Model\Penjualan\JualRetur  $jualretur
     * @return \Illuminate\Http\Response
     */
    public function show(JualRetur $jualretur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\http\Model\Penjualan\JualRetur  $jualretur
     * @return \Illuminate\Http\Response
     */
    public function edit(JualRetur $jualretur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\http\Model\Penjualan\JualRetur  $jualretur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JualRetur $jualretur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\http\Model\Penjualan\JualRetur  $jualretur
     * @return \Illuminate\Http\Response
     */
    public function destroy(JualRetur $jualretur)
    {
        //
    }
}
