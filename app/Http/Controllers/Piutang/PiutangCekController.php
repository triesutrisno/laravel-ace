<?php

namespace App\Http\Controllers\Piutang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PiutangCekController extends Controller
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

        if ($request->has('tanggal')) {
            $tanggal = $request->tanggal;
        } else {
            $tanggal = now()->format('Y-m-d');
        }

        $menu = DB::table('menu')
            ->where('menu_id', 18)
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
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'ms_pelanggan_plafon.temponormal',
                'datapiutang.*',
            )

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'datapiutang.pelangganid')
            ->join('ms_pelanggan_plafon', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'datapiutang.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'datapiutang.jenisjual');
            })

            ->where($pelanggans, $pelanggan)

            ->orderBy('ms_pelanggan.pelanggankode', 'ASC')
            ->orderBy('datapiutang.jenisjual', 'ASC')
            ->orderBy('datapiutang.umur', 'DESC')
            ->get();

        return view('piutang.piutangcek.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datapelanggan' => $datapelanggan,
            'pelanggan' => $pelanggan,
            'tanggal' => $tanggal,
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
