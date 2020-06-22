<?php

namespace App\Http\Controllers\Piutang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PiutangKartuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->pelanggan !== "0") {
            $pelanggans = 'ms_pelanggan.pelangganid';
            $pelanggan = $request->pelanggan;
        } else {
            $pelanggans = null;
            $pelanggan = null;
        }

        $tanggal = now()->format('Y-m-d');

        $menu = DB::table('menu')
            ->where('menu_id', 16)
            ->first();

        $update = DB::table('tmp_sync')
            ->orderBy('modifieddate', 'DESC')
            ->first();

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
                'datapiutang.*',
                DB::raw("CASE
                    WHEN datapiutang.jenisjual=1 THEN datapiutang.sisapiutang
                    ELSE 0 END as piutangsemen
                "),
                DB::raw("CASE
                    WHEN datapiutang.jenisjual=2 THEN datapiutang.sisapiutang
                    ELSE 0 END as piutangnonsemen
                "),
                DB::raw("CASE
                    WHEN datapiutang.jenisjual=4 THEN datapiutang.sisapiutang
                    ELSE 0 END as piutangcurah
                "),
            )

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'datapiutang.pelangganid')

            ->where($pelanggans, $pelanggan)
            ->where('datapiutang.sisapiutang', '<>', 0)
            ->orderBy('datapiutang.umur', 'DESC')
            ->get();

        return view('piutang.piutangkartu.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datapelanggan' => $datapelanggan,
            'pelanggan' => $pelanggan,
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
