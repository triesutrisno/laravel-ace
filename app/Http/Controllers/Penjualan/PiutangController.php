<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGroupByPelangganPeriode($tanggal)
    {
        $datas = DB::table('tr_piutang')
            ->select(
                'pelangganid',
                'jenisjual',
                DB::raw('SUM(jumlah) jmlpiutang'),
            )
            ->where('status', '=', 0)
            ->where('tglfaktur', '<', $tanggal)
            ->groupBy('pelangganid')
            ->groupBy('jenisjual');

        return $datas;
    }

    public function getGroupByPelangganRange($tglawal, $tglakhir)
    {
        $datas = DB::table('tr_piutang')
            ->select(
                'pelangganid',
                'jenisjual',
                DB::raw('SUM(jumlah) jmlpiutang'),
            )
            ->where('status', '=', 0)
            ->whereBetween('tglfaktur', [$tglawal, $tglakhir])
            ->groupBy('pelangganid')
            ->groupBy('jenisjual');

        return $datas;
    }

    public function getPiutangPeriode($tanggal)
    {
        $dataspiutang = DB::table('tr_piutang')
            ->where('tr_piutang.tglfaktur', '<=', $tanggal)
            ->select(
                'tr_piutang.*',

                DB::raw("CASE
                WHEN tr_piutang.jenisjual=1 THEN 'Semen'
                WHEN tr_piutang.jenisjual=2 THEN 'Non Semen'
                WHEN tr_piutang.jenisjual=4 THEN 'Curah'
                END as jenisplafon
                "),

                'jr.jmlretur',
                'jh1.jmlkorhar as jmlkorhar1',
                'jh2.jmlkorhar as jmlkorhar2',
                'jp.jmlkorpiu',
                'jb.jmlbayar',
                'jbb.jmlbatal',
                'jbl.jmllebih',

                DB::raw("'" . $tanggal . "'::date - tr_piutang.tglfaktur::date umur"),

                DB::raw('CASE WHEN tr_piutang.status=0 then tr_piutang.jumlah ELSE 0 END -
                CASE WHEN tr_piutang.status=0 then COALESCE(jr.jmlretur,0) ELSE 0 END +
                CASE WHEN tr_piutang.status=0 then COALESCE(jh1.jmlkorhar,0) ELSE COALESCE(jh2.jmlkorhar,0) END +
                COALESCE(jp.jmlkorpiu,0) -
                COALESCE(jb.jmlbayar,0) +
                COALESCE(jbb.jmlbatal,0)  +
                COALESCE(jbl.jmllebih,0)
                sisapiutang')
            )

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualReturController')->getGroupByNospjPeriode($tanggal), 'jr', function ($join) {
                $join->on('tr_piutang.nospj', '=', 'jr.nospj');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiHargaController')->getGroupByFakturPeriode($tanggal), 'jh1', function ($join) {
                $join->on('tr_piutang.nofaktur', '=', 'jh1.nofaktur');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiHargaController')->getGroupByFakturBaruPeriode($tanggal), 'jh2', function ($join) {
                $join->on('tr_piutang.nofaktur', '=', 'jh2.nofakturbaru');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiPiutangController')->getGroupByFakturPeriode($tanggal), 'jp', function ($join) {
                $join->on('tr_piutang.nofaktur', '=', 'jp.nofaktur');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarController')->getGroupByFakturPeriode($tanggal), 'jb', function ($join) {
                $join->on('tr_piutang.nofaktur', '=', 'jb.nofaktur');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarBatalController')->getGroupByFakturPeriode($tanggal), 'jbb', function ($join) {
                $join->on('tr_piutang.nofaktur', '=', 'jbb.nofaktur');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarLebihController')->getGroupByFakturPeriode($tanggal), 'jbl', function ($join) {
                $join->on('tr_piutang.nofaktur', '=', 'jbl.nofaktur');
            });

        return $dataspiutang;
    }

    public function getPiutangPelangganPeriode($tanggal)
    {
        $datas = DB::table('ms_pelanggan_plafon')
            ->select(
                'ms_pelanggan_plafon.pelangganid',
                DB::raw("CASE
                WHEN ms_pelanggan_plafon.jenisplafon=1 THEN 'Semen'
                WHEN ms_pelanggan_plafon.jenisplafon=2 THEN 'Non Semen'
                WHEN ms_pelanggan_plafon.jenisplafon=4 THEN 'Curah'
                END as jenisplafon
                "),

                'ms_pelanggan_plafon.limitpkb',
                'ms_pelanggan_plafon.temponormal',
                'ms_pelanggan_plafon.limitpkc',
                'ms_pelanggan_plafon.tempotambahan',

                'piu.jmlpiutang',
                'jr.jmlretur',
                'jh.jmlkorhar',
                'jp.jmlkorpiu',
                'jb.jmlbayar',
                'jbb.jmlbatal',
                'jbl.jmllebih',

                DB::raw('COALESCE(piu.jmlpiutang,0) -
                COALESCE(jr.jmlretur,0) +
                COALESCE(jh.jmlkorhar,0) +
                COALESCE(jp.jmlkorpiu,0) -
                COALESCE(jb.jmlbayar,0) +
                COALESCE(jbb.jmlbatal,0) +
                COALESCE(jbl.jmllebih,0) sisasaldo')
            )

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\PiutangController')->getGroupByPelangganPeriode($tanggal), 'piu', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'piu.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'piu.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualReturController')->getGroupByPelangganPeriode($tanggal), 'jr', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jr.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jr.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiHargaController')->getGroupByPelangganPeriode($tanggal), 'jh', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jh.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jh.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiPiutangController')->getGroupByPelangganPeriode($tanggal), 'jp', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jp.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jp.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarController')->getGroupByPelangganPeriode($tanggal), 'jb', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jb.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jb.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarBatalController')->getGroupByPelangganPeriode($tanggal), 'jbb', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jbb.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jbb.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarLebihController')->getGroupByPelangganPeriode($tanggal), 'jbl', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jbl.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jbl.jenisjual');
            });

        return $datas;
    }

    public function getPiutangPelangganRange($tglawal, $tglakhir)
    {
        $datas = DB::table('ms_pelanggan_plafon')
            ->select(
                'ms_pelanggan_plafon.pelangganid',
                DB::raw("CASE
                WHEN ms_pelanggan_plafon.jenisplafon=1 THEN 'Semen'
                WHEN ms_pelanggan_plafon.jenisplafon=2 THEN 'Non Semen'
                WHEN ms_pelanggan_plafon.jenisplafon=4 THEN 'Curah'
                END as jenisplafon
                "),
                'ms_pelanggan_plafon.limitpkb',
                'ms_pelanggan_plafon.temponormal',
                'ms_pelanggan_plafon.limitpkc',
                'ms_pelanggan_plafon.tempotambahan',

                DB::raw('COALESCE(piu1.jmlpiutang,0) -
                COALESCE(jr1.jmlretur,0) +
                COALESCE(jh1.jmlkorhar,0) +
                COALESCE(jp1.jmlkorpiu,0) -
                COALESCE(jb1.jmlbayar,0) +
                COALESCE(jbb1.jmlbatal,0) +
                COALESCE(jbl1.jmllebih,0) sawal'),

                DB::raw('COALESCE(piu2.jmlpiutang,0) +
                CASE WHEN COALESCE(jh2.jmlkorhar,0)>0 THEN COALESCE(jh2.jmlkorhar,0) ELSE 0 END +
                CASE WHEN COALESCE(jp2.jmlkorpiu,0)>0 THEN COALESCE(jp2.jmlkorpiu,0) ELSE 0 END +
                COALESCE(jbb2.jmlbatal,0) +
                COALESCE(jbl2.jmllebih,0) debet'),

                DB::raw('COALESCE(jr2.jmlretur,0) +
                CASE WHEN COALESCE(jh2.jmlkorhar,0)<0 THEN COALESCE(jh2.jmlkorhar,0) *-1 ELSE 0 END +
                CASE WHEN COALESCE(jp2.jmlkorpiu,0)<0 THEN COALESCE(jp2.jmlkorpiu,0) *-1 ELSE 0 END +
                COALESCE(jb2.jmlbayar,0) kredit')
            )

            // periode
            ->leftjoinsub(app('App\Http\Controllers\Penjualan\PiutangController')->getGroupByPelangganPeriode($tglawal), 'piu1', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'piu1.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'piu1.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualReturController')->getGroupByPelangganPeriode($tglawal), 'jr1', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jr1.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jr1.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiHargaController')->getGroupByPelangganPeriode($tglawal), 'jh1', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jh1.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jh1.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiPiutangController')->getGroupByPelangganPeriode($tglawal), 'jp1', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jp1.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jp1.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarController')->getGroupByPelangganPeriode($tglawal), 'jb1', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jb1.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jb1.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarBatalController')->getGroupByPelangganPeriode($tglawal), 'jbb1', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jbb1.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jbb1.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarLebihController')->getGroupByPelangganPeriode($tglawal), 'jbl1', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jbl1.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jbl1.jenisjual');
            })

            // range
            ->leftjoinsub(app('App\Http\Controllers\Penjualan\PiutangController')->getGroupByPelangganRange($tglawal, $tglakhir), 'piu2', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'piu2.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'piu2.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualReturController')->getGroupByPelangganRange($tglawal, $tglakhir), 'jr2', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jr2.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jr2.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiHargaController')->getGroupByPelangganRange($tglawal, $tglakhir), 'jh2', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jh2.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jh2.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualKoreksiPiutangController')->getGroupByPelangganRange($tglawal, $tglakhir), 'jp2', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jp2.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jp2.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarController')->getGroupByPelangganRange($tglawal, $tglakhir), 'jb2', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jb2.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jb2.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarBatalController')->getGroupByPelangganRange($tglawal, $tglakhir), 'jbb2', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jbb2.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jbb2.jenisjual');
            })

            ->leftjoinsub(app('App\Http\Controllers\Penjualan\JualBayarLebihController')->getGroupByPelangganRange($tglawal, $tglakhir), 'jbl2', function ($join) {
                $join->on('ms_pelanggan_plafon.pelangganid', '=', 'jbl2.pelangganid')
                    ->on('ms_pelanggan_plafon.jenisplafon', '=', 'jbl2.jenisjual');
            });

        return $datas;
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
