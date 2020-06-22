<?php

namespace App\Http\Controllers\Piutang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PiutangAgingController extends Controller
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

        if ($request->pelanggan !== "0") {
            $pelanggans = 'ms_pelanggan.pelangganid';
            $pelanggan = $request->pelanggan;
        } else {
            $pelanggans = null;
            $pelanggan = null;
        }

        if ($request->has('status')) {
            $statuss = 'ms_pelanggan.status';
            $status = $request->status;
        } else {
            $statuss = null;
            $status = null;
        }

        if ($request->has('tanggal')) {
            $tanggal = $request->tanggal;
        } else {
            $tanggal = now()->format('Y-m-d');
        }

        if ($request->has('range1')) {
            $range1 = $request->range1;
        } else {
            $range1 = 30;
        }

        if ($request->has('range2')) {
            $range2 = $request->range2;
        } else {
            $range2 = 60;
        }

        if ($request->has('range3')) {
            $range3 = $request->range3;
        } else {
            $range3 = 90;
        }

        if ($request->has('range4')) {
            $range4 = $request->range4;
        } else {
            $range4 = 180;
        }

        if ($request->has('range5')) {
            $range5 = $request->range5;
        } else {
            $range5 = 360;
        }

        $menu = DB::table('menu')
            ->where('menu_id', 18)
            ->first();

        $update = DB::table('tmp_sync')
            ->orderBy('modifieddate', 'DESC')
            ->first();

        $datawilayah = DB::table('ms_wilayah')
            ->orderBy('wilayahnama')
            ->get();

        $datacabang = DB::table('ms_cabang')
            ->where('cabangid', '!=', 0)
            ->orderBy('cabangnama')
            ->get();

        $datapelanggan = DB::table('ms_pelanggan')
            ->select(
                'ms_cabang.cabangnama',
                'ms_pelanggan.*'
            )
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pelanggan.cabangid')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pelanggan.pelanggankode', 'ASC')
            ->get();

        $datapiutang = app('App\Http\Controllers\Piutang\PiutangController')->getPiutangPeriode($tanggal);

        $datas = DB::table($datapiutang, 'datapiutang')
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'ms_pelanggan_plafon.temponormal',
                'datapiutang.*',

                DB::raw("CASE
                WHEN ( datapiutang.umur - ms_pelanggan_plafon.temponormal ) <=0 THEN datapiutang.sisapiutang
                ELSE 0 END as belum
                "),

                DB::raw("CASE
                WHEN ( datapiutang.umur - ms_pelanggan_plafon.temponormal ) > 0 AND datapiutang.umur<=" . $range1 . " THEN datapiutang.sisapiutang
                ELSE 0 END as jumlah1
                "),
                DB::raw("CASE
                WHEN ( datapiutang.umur - ms_pelanggan_plafon.temponormal ) > " . $range1 . " AND datapiutang.umur<=" . $range2 . " THEN datapiutang.sisapiutang
                ELSE 0 END as jumlah2
                "),
                DB::raw("CASE
                WHEN ( datapiutang.umur - ms_pelanggan_plafon.temponormal ) > " . $range2 . " AND datapiutang.umur<=" . $range3 . " THEN datapiutang.sisapiutang
                ELSE 0 END as jumlah3
                "),
                DB::raw("CASE
                WHEN ( datapiutang.umur - ms_pelanggan_plafon.temponormal ) > " . $range3 . " AND datapiutang.umur<=" . $range4 . " THEN datapiutang.sisapiutang
                ELSE 0 END as jumlah4
                "),
                DB::raw("CASE
                WHEN ( datapiutang.umur - ms_pelanggan_plafon.temponormal ) > " . $range4 . " AND datapiutang.umur<=" . $range5 . " THEN datapiutang.sisapiutang
                ELSE 0 END as jumlah5
                "),
                DB::raw("CASE
                WHEN ( datapiutang.umur - ms_pelanggan_plafon.temponormal ) > " . $range5 . " THEN datapiutang.sisapiutang
                ELSE 0 END as jumlah6
                "),
            )

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'datapiutang.pelangganid')
            ->join('ms_pelanggan_plafon', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'datapiutang.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'datapiutang.jenisjual');
            })
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'datapiutang.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')

            ->where($pelanggans, $pelanggan)
            ->where($cabangs, $cabang)
            ->where($statuss, $status)
            ->where($wilayahs, $wilayah)

            // ->where('datapiutang.sisapiutang', '<>', 0)

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pelanggan.pelanggankode', 'ASC')
            ->orderBy('datapiutang.jenisjual', 'ASC')
            ->orderBy('datapiutang.umur', 'DESC')
            ->get();

        return view('piutang.piutangaging.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datawilayah' => $datawilayah,
            'datacabang' => $datacabang,
            'datapelanggan' => $datapelanggan,
            'wilayah' => $wilayah,
            'pelanggan' => $pelanggan,
            'status' => $status,
            'cabang' => $cabang,
            'tanggal' => $tanggal,
            'range1' => $range1,
            'range2' => $range2,
            'range3' => $range3,
            'range4' => $range4,
            'range5' => $range5,
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
