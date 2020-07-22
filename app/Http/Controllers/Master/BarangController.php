<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('jenis')) {
            $jeniss = 'ms_barang.kategoriid';
            $jenis = $request->jenis;
        } else {
            $jeniss = null;
            $jenis = null;
        }

        if ($request->grup !== "0") {
            $grups = 'ms_barang_grup.grupid';
            $grup = $request->grup;
        } else {
            $grups = null;
            $grup = null;
        }

        $menu = DB::table('menu')
            ->where('menu_id', 23)
            ->first();

        $update = DB::table('tmp_sync')
            ->where('nama', 'Barang')
            ->first();

        $datagrup = DB::table('ms_barang_grup')
            ->orderBy('grupnama')
            ->get();

        $datas = DB::table('ms_barang')
            ->select(
                'ms_barang_grup.grupid',
                'ms_barang_grup.grupnama',
                'ms_barang.*',
            )
            ->where($grups, $grup)
            ->where($jeniss, $jenis)
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')
            ->orderBy("ms_barang_grup.grupnama", "ASC")
            ->orderBy("ms_barang.barangnama", "ASC")
            ->get();

        return view('master.barang.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datagrup' => $datagrup,
            'jenis' => $jenis,
            'grup' => $grup,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
