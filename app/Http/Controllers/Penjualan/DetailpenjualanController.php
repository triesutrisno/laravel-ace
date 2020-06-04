<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\http\Model\Penjualan\Detailpenjualan;
use DB;
use Illuminate\Http\Request;

class DetailpenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     // $data = Detailpenjualan::all();
    //     $data = Detailpenjualan::wherebetween('tglspj', ['20200501', '20200501'])
    //         ->orderBy("cabangid")
    //         ->get();
    //     return view('penjualan.detailpenjualan.index', [
    //         'data' => $data
    //     ]);
    // }
    public function index()
    {

        $data = Detailpenjualan::wheredate('tglspj', '20200501')
        // $data = Detailpenjualan::where('tr_jual.nospj', 'SPJ/104/202001/0035')
            ->select('ms_wilayah.wilayahnama', 'ms_cabang.cabangnama', 'ms_gudang.gudangnama'
                    , 'ms_pelanggan.pelanggankode', 'ms_pelanggan.pelanggannama'
                    , 'ms_barang.barangkode', 'ms_barang.barangnama', 'ms_barang.berat'
                    , 'tr_piutang.nofaktur', 'tr_piutang.tglfaktur', 'tr_piutang.nofakturpajak'
                    , 'tr_jual.*'
                )
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_gudang', 'ms_gudang.gudangid', '=', 'tr_jual.gudangid')
            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual.pelangganid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
            ->leftjoin('tr_piutang', function ($join) {
                $join->on('tr_piutang.nospj', '=', 'tr_jual.nospj')
                     ->where('tr_piutang.status', '=', 0)
                ;})
            ->orderBy("tr_jual.cabangid")
            ->get();

        return view('penjualan.detailpenjualan.index', [
            'data' => $data
        ]);
    }

    public function search(Request $request)
    {
        // menangkap data pencarian
        $awal = $request->tanggal_awal;
        $akhir = $request->tanggal_akhir;

        $data = Detailpenjualan::wherebetween('tglspj', [$awal, $akhir])
            ->orderBy("cabangid")
            ->get();

        return view('penjualan.detailpenjualan.index', [
            'data' => $data
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
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Detailpenjualan $detailpenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Detailpenjualan $detailpenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detailpenjualan $detailpenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\http\Model\Penjualan\Detailpenjualan  $detailpenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detailpenjualan $detailpenjualan)
    {
        //
    }
}
