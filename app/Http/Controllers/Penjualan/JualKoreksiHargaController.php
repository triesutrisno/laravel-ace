<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class JualKoreksiHargaController extends Controller
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
            $cabangs = 'tr_jual_koreksi_harga.cabangid';
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
            ->where('menu_id', 10)
            ->first();

        $update = DB::table('tmp_sync')
            ->where('nama', 'Penjualan Koreksi Harga')
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

        $datas = DB::table('tr_jual_koreksi_harga')->wherebetween('tglkoreksi', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'ms_barang.barangkode',
                'ms_barang.barangnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'ms_barang.barangkode',
                'ms_barang.barangnama',
                'tr_jual_koreksi_harga.*',
                DB::raw("CASE
                    WHEN tr_jual_koreksi_harga.nofakturbaru IS NULL THEN piu1.nofakturpajak 
                    ELSE piu2.nofakturpajak END nofakturpajak
                ")
            )
            ->where($wilayahs, $wilayah)
            ->where($cabangs, $cabang)
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual_koreksi_harga.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual_koreksi_harga.pelangganid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual_koreksi_harga.barangid')
            ->leftjoin('tr_piutang as piu1', function ($join) {
                $join->on('piu1.nofaktur', '=', 'tr_jual_koreksi_harga.nofaktur');
            })
            ->leftjoin('tr_piutang as piu2', function ($join) {
                $join->on('piu2.nofaktur', '=', 'tr_jual_koreksi_harga.nofakturbaru');
            })
            ->orderBy("tr_jual_koreksi_harga.cabangid")
            ->get();

        return view('penjualan.jualkoreksiharga.index', [
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
        $datas = DB::table('tr_jual_koreksi_harga')
            ->select(
                'nofaktur',
                DB::raw('SUM(jumlah) jmlkorhar'),
            )
            ->where('status', '=', 1)
            ->where(function ($where1) {
                $where1->where('jeniskoreksi', '=', 0)
                    ->whereIn('tipekoreksi', [0, 1])
                    ->orWhere(function ($where2) {
                        $where2->where('jeniskoreksi', '=', 1)
                            ->where('tipekoreksi', '=', 1);
                    });
            })
            ->where('tglkoreksi', '<=', $tanggal)
            ->groupBy('nofaktur');

        return $datas;
    }

    public function getGroupByFakturBaruPeriode($tanggal)
    {
        $datas = DB::table('tr_jual_koreksi_harga')
            ->select(
                'nofakturbaru',
                DB::raw('SUM(jumlah) jmlkorhar'),
            )
            ->where('status', '=', 1)
            ->where('jeniskoreksi', '=', 1)
            ->where('tipekoreksi', '=', 0)
            ->where('tglkoreksi', '<=', $tanggal)
            ->groupBy('nofakturbaru');

        return $datas;
    }

    public function getGroupByPelangganPeriode($tanggal)
    {
        $datas = DB::table('tr_jual_koreksi_harga')
            ->select(
                'pelangganid',
                'jenisjual',
                DB::raw('SUM(jumlah) jmlkorhar'),
            )
            ->where('status', '=', 1)
            ->where('tglkoreksi', '<', $tanggal)
            ->groupBy('pelangganid')
            ->groupBy('jenisjual');

        return $datas;
    }

    public function getGroupByPelangganRange($tglawal, $tglakhir)
    {
        $datas = DB::table('tr_jual_koreksi_harga')
            ->select(
                'pelangganid',
                'jenisjual',
                DB::raw('SUM(jumlah) jmlkorhar'),
            )
            ->where('status', '=', 1)
            ->whereBetween('tglkoreksi', [$tglawal, $tglakhir])
            ->groupBy('pelangganid')
            ->groupBy('jenisjual');

        return $datas;
    }
}
