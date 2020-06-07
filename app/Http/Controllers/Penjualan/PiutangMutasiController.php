<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PiutangMutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('pelanggan')) {
            $pelanggan = $request->pelanggan;
        } else {
            $pelanggan = null;
        }

        if ($request->has('nospj')) {
            $nospj = $request->nospj;
        } else {
            $nospj = null;
        }

        $menu = DB::table('menu')
            ->where('menu_id', 16)
            ->first();

        $update = DB::table('tmp_sync')
            ->where('nama', 'Penjualan')
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

        $datasretur = DB::table('tr_jual_retur')
            ->select(DB::raw(" 
                'Retur' as keterangan,
                tr_jual_retur.nofaktur,
                tr_jual_retur.nospj,
                tr_jual_retur.noretur as noreff,
                tr_jual_retur.tglretur,
                0 as debet,
                SUM(tr_jual_retur.jumlah) as kredit"))
            ->where('tr_jual_retur.nospj', $nospj)
            ->groupBy('tr_jual_retur.nofaktur')
            ->groupBy('tr_jual_retur.nospj')
            ->groupBy('tr_jual_retur.noretur')
            ->groupBy('tr_jual_retur.tglretur');

        $dataskorharbl = DB::table('tr_jual_koreksi_harga')
            ->select(DB::raw(" 
                'Koreksi Harga' as keterangan,
                tr_jual_koreksi_harga.nofaktur,
                tr_jual_koreksi_harga.nospj,
                tr_jual_koreksi_harga.nokoreksi as noreff,
                tr_jual_koreksi_harga.tglkoreksi,
                0 as debet,
                SUM(tr_jual_koreksi_harga.jumlah) * -1 as kredit"))
            ->where('tr_jual_koreksi_harga.status', 1)
            ->where('tr_jual_koreksi_harga.tipekoreksi', 1)
            ->where('tr_jual_koreksi_harga.nospj', $nospj)
            ->groupBy('tr_jual_koreksi_harga.nofaktur')
            ->groupBy('tr_jual_koreksi_harga.nospj')
            ->groupBy('tr_jual_koreksi_harga.nokoreksi')
            ->groupBy('tr_jual_koreksi_harga.tglkoreksi');

        $dataskorharbj = DB::table('tr_jual_koreksi_harga')
            ->select(DB::raw(" 
                'Koreksi Harga' as keterangan,
                tr_jual_koreksi_harga.nofakturbaru,
                tr_jual_koreksi_harga.nospj,
                tr_jual_koreksi_harga.nokoreksi as noreff,
                tr_jual_koreksi_harga.tglkoreksi,
                SUM(tr_jual_koreksi_harga.jumlah) as debet,
                0 as kredit"))
            ->where('tr_jual_koreksi_harga.status', 1)
            ->where('tr_jual_koreksi_harga.tipekoreksi', 0)
            ->where('tr_jual_koreksi_harga.nospj', $nospj)
            ->groupBy('tr_jual_koreksi_harga.nofakturbaru')
            ->groupBy('tr_jual_koreksi_harga.nospj')
            ->groupBy('tr_jual_koreksi_harga.nokoreksi')
            ->groupBy('tr_jual_koreksi_harga.tglkoreksi');

        $datasbayar = DB::table('tr_jual_bayar')
            ->select(DB::raw(" 
                'Pembayaran' as keterangan,
                tr_jual_bayar.nofaktur,
                tr_jual_bayar.nospj,
                tr_jual_bayar.nobayar as noreff,
                tr_jual_bayar.tglbayar,
                0 as debet,
                tr_jual_bayar.jumlah as kredit"))
            ->where('tr_jual_bayar.jenisbayar', '<>', 4)
            ->where('tr_jual_bayar.nospj', $nospj);

        $datas = DB::table("tr_piutang")
            ->select(DB::raw("
                'Piutang' as keterangan,
                tr_piutang.nofaktur,
                tr_piutang.nospj,
                '' as noreff,
                tr_piutang.tglfaktur,
                tr_piutang.jumlah as debet,
                0 as kredit"))
            ->unionAll($datasretur)
            ->unionAll($dataskorharbj)
            ->unionAll($dataskorharbl)
            ->unionAll($datasbayar)
            ->where('tr_piutang.status', 0)
            ->where('tr_piutang.nospj', $nospj)
            ->get();

        return view('penjualan.piutangmutasi.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datapelanggan' => $datapelanggan,
            // 'datacabang' => $datacabang,
            'pelanggan' => $pelanggan,
            'nospj' => $nospj,
            // 'tgl_awal' => $tgl_awal,
            // 'tgl_akhir' => $tgl_akhir
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
