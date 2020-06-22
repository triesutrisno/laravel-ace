<?php

namespace App\Http\Controllers\Piutang;

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
    public function index()
    {
        $menu = DB::table('menu')
            ->where('menu_id', 17)
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

        $datas = DB::table("tr_piutang")
            ->select(DB::raw("
                tr_piutang.pelangganid,
                'Piutang' as keterangan,
                tr_piutang.nospj,
                tr_piutang.nofaktur,
                '' as noreff,
                tr_piutang.tglfaktur,
                tr_piutang.jumlah as debet,
                0 as kredit"))
            ->whereNull('tr_piutang.tglfaktur')
            // ->wherebetween('tr_piutang.tglfaktur', ['19700101', '19700101'])
            // ->limit(2)
            ->get();

        return view('piutang.piutangmutasi.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datapelanggan' => $datapelanggan,
            'pelanggan' => null,
            'berdasarkan' => null,
            'nofaktur' => null,
            'nospj' => null,
            'tgl_awal' => now()->format('Y-m-d'),
            'tgl_akhir' => now()->format('Y-m-d')
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
    public function show(Request $request)
    {
        if ($request->has('berdasarkan')) {
            $berdasarkan = $request->berdasarkan;

            if ($berdasarkan == 'dasarnospj') {

                if ($request->has('nospj')) {
                    $nospj = $request->nospj;

                    $nospjs = DB::raw("nospj = '" . $nospj . "'");
                } else {
                    $nospj = null;
                    $nospjs = null;
                }

                $nofaktur = null;
                $nofakturs = null;
                $nofakturbarus = null;

                $pelanggan = null;
                $pelanggans = null;

                $tgl_awal = null;
                $tgl_akhir = null;
                $tglpiutang = null;
                $tglretur = null;
                $tglkoreksi = null;
                $tglbayar = null;
            } elseif ($berdasarkan == 'dasarnofaktur') {

                if ($request->has('nofaktur')) {
                    $nofaktur = $request->nofaktur;

                    $nofakturs = DB::raw("nofaktur = '" . $nofaktur . "'");
                    $nofakturbarus = DB::raw("nofakturbaru = '" . $nofaktur . "'");
                } else {
                    $nofaktur = null;
                    $nofakturs = null;
                    $nofakturbarus = null;
                }

                $nospj = null;
                $nospjs = null;

                $pelanggan = null;
                $pelanggans = null;

                $tgl_awal = null;
                $tgl_akhir = null;
                $tglpiutang = null;
                $tglretur = null;
                $tglkoreksi = null;
                $tglbayar = null;
            } elseif ($berdasarkan == 'dasarpelanggan') {

                if ($request->has('pelanggan')) {
                    $pelanggan = $request->pelanggan;
                    $tgl_awal = $request->tgl_awal;
                    $tgl_akhir = $request->tgl_akhir;

                    $pelanggans = DB::raw("pelangganid = '" . $pelanggan . "'");

                    $tglpiutang = DB::raw("AND tglfaktur BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
                    $tglretur = DB::raw("AND tglretur BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
                    $tglkoreksi = DB::raw("AND tglkoreksi BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
                    $tglbayar = DB::raw("AND tglbayar BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "'");
                } else {
                    $pelanggan = null;
                    $pelanggans = null;
                }
                $nospj = null;
                $nospjs = null;

                $nofaktur = null;
                $nofakturs = null;
                $nofakturbarus = null;
            }
        } else {
            $berdasarkan = null;
        }

        $menu = DB::table('menu')
            ->where('menu_id', 17)
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

        $datasretur = DB::table('tr_jual_retur')
            ->select(DB::raw(" 
                pelangganid,
                'Retur' as keterangan,
                nospj,
                nofaktur,
                noretur as noreff,
                tglretur,
                0 as debet,
                SUM(jumlah) as kredit"))
            ->whereraw($pelanggans . $tglretur . $nospjs . $nofakturs)
            ->groupBy('pelangganid')
            ->groupBy('nospj')
            ->groupBy('nofaktur')
            ->groupBy('noretur')
            ->groupBy('tglretur');

        $dataskorharbl = DB::table('tr_jual_koreksi_harga')
            ->select(DB::raw(" 
            pelangganid,
            'Koreksi Harga' as keterangan,
            nospj,
            nofaktur,
            nokoreksi as noreff,
            tglkoreksi,
            0 as debet,
            SUM(jumlah) * -1 as kredit"))
            ->whereraw($pelanggans . $tglkoreksi . $nospjs . $nofakturs)
            ->where('status', 1)
            ->where('tipekoreksi', 1)
            ->groupBy('pelangganid')
            ->groupBy('nospj')
            ->groupBy('nofaktur')
            ->groupBy('nokoreksi')
            ->groupBy('tglkoreksi');

        $dataskorharbj = DB::table('tr_jual_koreksi_harga')
            ->select(DB::raw(" 
                pelangganid,
                'Koreksi Harga' as keterangan,
                    nospj,
                nofakturbaru,
                nokoreksi as noreff,
                tglkoreksi,
                SUM(jumlah) as debet,
                0 as kredit"))
            ->whereraw($pelanggans . $tglkoreksi . $nospjs . $nofakturbarus)
            ->where('status', 1)
            ->where('tipekoreksi', 0)
            ->groupBy('pelangganid')
            ->groupBy('nospj')
            ->groupBy('nofakturbaru')
            ->groupBy('nokoreksi')
            ->groupBy('tglkoreksi');

        $datasbayar = DB::table('tr_jual_bayar')
            ->select(DB::raw(" 
                pelangganid,
                'Pembayaran' as keterangan,
                nospj,
                nofaktur,
                nobayar as noreff,
                tglbayar,
                0 as debet,
                jumlah as kredit"))
            ->whereraw($pelanggans . $tglbayar . $nospjs . $nofakturs)
            ->where('jenisbayar', '<>', 4);

        $dataspiutang = DB::table("tr_piutang")
            ->select(DB::raw("
                pelangganid,
                'Piutang' as keterangan,
                nospj,
                nofaktur,
                '' as noreff,
                tglfaktur,
                jumlah as debet,
                0 as kredit"))
            ->unionAll($datasretur)
            ->unionAll($dataskorharbj)
            ->unionAll($dataskorharbl)
            ->unionAll($datasbayar)
            ->whereraw($pelanggans . $tglpiutang . $nospjs . $nofakturs)
            ->where('status', 0);

        $datas = DB::table($dataspiutang, 'piutang')
            ->select(
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'keterangan',
                'nospj',
                'nofaktur',
                'noreff',
                'tglfaktur',
                'debet',
                'kredit',
            )
            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'piutang.pelangganid')
            ->orderBy('piutang.nospj', 'ASC')
            ->orderBy('piutang.nofaktur', 'ASC')
            ->orderBy('piutang.tglfaktur', 'ASC')
            ->get();

        return view('piutang.piutangmutasi.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas' => $datas,
            'datapelanggan' => $datapelanggan,
            'pelanggan' => $pelanggan,
            'berdasarkan' => $berdasarkan,
            'nospj' => $nospj,
            'nofaktur' => $nofaktur,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        ]);
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
