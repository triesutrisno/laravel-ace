<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CabgudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wilayah !== "0") {
            $wilayahs = 'ms_wilayah.wilayahid';
            $wilayah = $request->wilayah;
        } else {
            $wilayahs = null;
            $wilayah = null;
        }

        if ($request->cabang !== "0") {
            $cabangs = 'ms_cabang.cabangid';
            $cabang = $request->cabang;
        } else {
            $cabangs = null;
            $cabang = null;
        }

        $menu = DB::table('menu')
            ->where('menu_id', 22)
            ->first();

        $update = DB::table('tmp_sync')
            ->where('nama', 'Cabang')
            ->first();

        $datawilayah = DB::table('ms_wilayah')
            ->orderBy('wilayahnama')
            ->get();

        $datacabang = DB::table('ms_cabang')
            ->where('cabangid', '!=', 0)
            ->orderBy('cabangnama')
            ->get();

        $datas = DB::table('ms_cabang')
            ->select(
                'ms_wilayah.wilayahid',
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangkode',
                'ms_cabang.cabangnama',
                'ms_cabang.status AS statuscabang',
                'ms_gudang.gudangkode',
                'ms_gudang.gudangnama',
                'ms_gudang.status AS statusgudang',
            )
            ->where($wilayahs, $wilayah)
            ->where($cabangs, $cabang)
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_gudang', 'ms_gudang.cabangid', '=', 'ms_cabang.cabangid')
            ->orderBy("ms_wilayah.wilayahnama", "ASC")
            ->orderBy("ms_cabang.cabangnama", "ASC")
            ->orderBy("ms_gudang.gudangnama", "ASC")
            ->get();

        return view('master.cabgud.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datawilayah' => $datawilayah,
            'datacabang' => $datacabang,
            'wilayah' => $wilayah,
            'cabang' => $cabang,
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
