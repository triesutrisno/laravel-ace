<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JualBayarController extends Controller
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
            $cabangs = 'tr_jual_bayar.cabangid';
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
            ->where('menu_id', 12)
            ->first();

        $update = DB::table('tmp_sync')
            ->where('nama', 'Penjualan Bayar')
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

        $datas = DB::table('tr_jual_bayar')->wherebetween('tglbayar', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'tr_piutang.noinvoice',
                DB::raw("CASE
                    WHEN tr_jual_bayar.jenisbayar=1 THEN 'Tunai'
                    WHEN tr_jual_bayar.jenisbayar=2 THEN 'Transfer Cabang'
                    WHEN tr_jual_bayar.jenisbayar=3 THEN 'BG'
                    WHEN tr_jual_bayar.jenisbayar=4 THEN 'Kembali Utuh'
                    WHEN tr_jual_bayar.jenisbayar=5 THEN 'Deposit'
                    WHEN tr_jual_bayar.jenisbayar=6 THEN 'Via Langsung'
                    WHEN tr_jual_bayar.jenisbayar=7 THEN 'Kompensansi'
                    WHEN tr_jual_bayar.jenisbayar=8 THEN ''
                    END jenisbayar2
                "),
                'tr_jual_bayar.*'
            )
            ->where($wilayahs, $wilayah)
            ->where($cabangs, $cabang)
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual_bayar.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual_bayar.pelangganid')
            ->leftjoin('tr_piutang', 'tr_piutang.nofaktur', '=', 'tr_jual_bayar.nofaktur')
            ->orderBy("tr_jual_bayar.cabangid")
            ->get();

        return view('penjualan.jualbayar.index', [
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

    public function getGroupByFakturPeriode($tanggal)
    {
        $datas = DB::table('tr_jual_bayar')
            ->select(
                'nofaktur',
                DB::raw('SUM(jumlah) jmlbayar'),
            )
            ->where('tglbayar', '<=', $tanggal)
            ->groupBy('nofaktur');

        return $datas;
    }

    public function getGroupByPelangganPeriode($tanggal)
    {
        $datas = DB::table('tr_jual_bayar')
            ->select(
                'pelangganid',
                'jenisjual',
                DB::raw('SUM(jumlah) jmlbayar'),
            )
            ->where('tglbayar', '<', $tanggal)
            ->groupBy('pelangganid')
            ->groupBy('jenisjual');

        return $datas;
    }

    public function getGroupByPelangganRange($tglawal, $tglakhir)
    {
        $datas = DB::table('tr_jual_bayar')
            ->select(
                'pelangganid',
                'jenisjual',
                DB::raw('SUM(jumlah) jmlbayar'),
            )
            ->whereBetween('tglbayar', [$tglawal, $tglakhir])
            ->groupBy('pelangganid')
            ->groupBy('jenisjual');

        return $datas;
    }
}
