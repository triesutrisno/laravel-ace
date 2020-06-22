<?php

namespace App\Http\Controllers\Piutang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PiutangSaldoController extends Controller
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
            $cabangs = 'ms_pelanggan.cabangid';
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

        if ($request->has('tglawal')) {
            $tglawal = $request->tglawal;
        } else {
            $tglawal = now()->format('Y-m-d');
        }

        if ($request->has('tglakhir')) {
            $tglakhir = $request->tglakhir;
        } else {
            $tglakhir = now()->format('Y-m-d');
        }

        $menu = DB::table('menu')
            ->where('menu_id', 19)
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

        $datasaldo = app('App\Http\Controllers\Piutang\PiutangController')->getPiutangPelangganRange($tglawal, $tglakhir);

        $datas = DB::table($datasaldo, 'datasaldo')
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'datasaldo.jenisplafon',
                'datasaldo.limitpkb',
                'datasaldo.temponormal',
                'datasaldo.limitpkc',
                'datasaldo.tempotambahan',
                'datasaldo.sawal',
                'datasaldo.debet',
                'datasaldo.kredit',
                DB::raw(
                    'datasaldo.sawal +
                    datasaldo.debet -
                    datasaldo.kredit sakhir'
                )
            )

            ->where($pelanggans, $pelanggan)
            ->where($statuss, $status)
            ->where($cabangs, $cabang)
            ->where($wilayahs, $wilayah)

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'datasaldo.pelangganid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pelanggan.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pelanggan.pelanggankode', 'ASC')
            ->orderBy('datasaldo.jenisplafon', 'DESC')

            ->get();

        return view('piutang.piutangsaldo.index', [
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
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
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
