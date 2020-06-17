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
            $cabangs = 'tr_jual_retur.cabangid';
            $cabang = $request->cabang;
        } else {
            $cabangs = null;
            $cabang = null;
        }

        if ($request->has('tgl_awal')) {
            $tgl_awal = $request->tgl_awal;
        } else {
            $tgl_awal = now()->format('Y-m-d');
        }

        if ($request->has('tgl_akhir')) {
            $tgl_akhir = $request->tgl_akhir;
        } else {
            $tgl_akhir = now()->format('Y-m-d');
        }

        $menu = DB::table('menu')
            ->where('menu_id', 9)
            ->first();

        $update = DB::table('tmp_sync')
            ->where('nama', 'Penjualan')
            ->first();

        $datawilayah = DB::table('ms_wilayah')
            ->orderBy('wilayahnama')
            ->get();

        $datawilayah = DB::table('ms_wilayah')
            ->orderBy('wilayahnama')
            ->get();

        $datacabang = DB::table('ms_cabang')
            ->where('cabangid', '!=', 0)
            ->orderBy('cabangnama')
            ->get();

        $datas = DB::table('tr_jual_retur')->wherebetween('tglretur', [$tgl_awal, $tgl_akhir])
            ->select(
                // 'ms_wilayah.wilayahnama',
                 'ms_cabang.cabangnama',
                 'ms_gudang.gudangnama',
                 'ms_pelanggan.pelanggankode',
                 'ms_pelanggan.pelanggannama',
                 'ms_barang.barangkode',
                 'ms_barang.barangnama',
                // 'ms_barang.berat',
                // 'tr_piutang.nofaktur',
                // 'tr_piutang.tglfaktur',
                // 'tr_piutang.nofakturpajak',
                'tr_jual_retur.*'
            )
            // ->where($wilayahs, $wilayah)
             ->where($cabangs, $cabang)
             ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual_retur.cabangid')
            // ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
             ->join('ms_gudang', 'ms_gudang.gudangid', '=', 'tr_jual_retur.gudangid')
             ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual_retur.pelangganid')
             ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual_retur.barangid')
            // ->leftjoin('tr_piutang', function ($join) {
            //     $join->on('tr_piutang.nospj', '=', 'tr_jual.nospj')
            //         ->where('tr_piutang.status', '=', 0);
            // })
            ->orderBy("tr_jual_retur.cabangid")
            ->get();

        return view('penjualan.jualretur.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datawilayah' => $datawilayah,
            'datacabang' => $datacabang,
            'wilayah' => $wilayah,
            'cabang' => $cabang,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
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
