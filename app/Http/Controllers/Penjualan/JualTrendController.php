<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JualTrendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('berdasarkan')) {
            $berdasarkan = $request->berdasarkan;
        } else {
            $berdasarkan = null;
        }

        if ($request->has('periode')) {
            $periode = $request->periode;
        } else {
            $periode = null;
        }

        if ($request->has('kumulasi')) {
            $kumulasi = $request->kumulasi;
        } else {
            $kumulasi = null;
        }

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

        if ($request->sales !== "0") {
            $saless = 'ms_pegawai.pegawaiid';
            $sales = $request->sales;
        } else {
            $saless = null;
            $sales = null;
        }

        if ($request->grupbarang !== "0") {
            $grupbarangs = 'ms_barang_grup.grupid';
            $grupbarang = $request->grupbarang;
        } else {
            $grupbarangs = null;
            $grupbarang = null;
        }

        if ($request->has('tgl_awal')) {
            $tgl_awal = $request->tgl_awal;
        } else {
            $tgl_awal = now()->format('Y-m-01');
        }

        if ($request->has('tgl_akhir')) {
            $tgl_akhir = $request->tgl_akhir;
        } else {
            $tgl_akhir = now()->format('Y-m-d');
        }

        $menu = DB::table('menu')
            ->where('menu_id', 27)
            ->first();

        $update = DB::table('tmp_sync')
            ->where('nama', 'Penjualan')
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

        $datasales = DB::table('ms_pegawai')
            ->select(
                'ms_cabang.cabangnama',
                'ms_pegawai.*'
            )
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pegawai.cabangid')
            ->whereIn('ms_pegawai.jabatanid', [2, 74, 86])
            ->where('ms_pegawai.status', '=', 1)
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pegawai.pegawainama', 'ASC')
            ->get();

        $datagrupbarang = DB::table('ms_barang_grup')
            ->orderBy('grupnama')
            ->get();

        $kalender = CAL_GREGORIAN;
        $periode = 'bulanan';
        $thn = 2020;

        if ($periode == 'bulanan') {
            # code...
            for ($a = 1; $a <= 12; $a++) {
                // hiung jumlah hari dalam bulan
                $hari = cal_days_in_month($kalender, $a, $thn);
                // ambil tgl awal bulan
                $tgl_awal =  date($thn . '-' . sprintf("%02d", $a)  . '-01');
                // ambil tgl akhir bulan dari perhitungan
                $tgl_akhir =  date($thn . '-' . sprintf("%02d", $a)  . '-' . $hari);
                echo $tgl_awal . ' - ' . $tgl_akhir . '<br>';
            }
        } elseif ($periode == 'harian') {
            # code...
            $bln = 2;
            // hiung jumlah hari dalam bulan
            $hari = cal_days_in_month($kalender, $bln, $thn);

            for ($a = 1; $a <= $hari; $a++) {
                // ambil tgl awal bulan
                $tgl_awal =  date($thn . '-' . sprintf("%02d", $bln)  . '-' . sprintf("%02d", $a));
                // ambil tgl akhir bulan dari perhitungan
                $tgl_akhir =  date($thn . '-' . sprintf("%02d", $bln)  . '-' . sprintf("%02d", $a));
                echo $tgl_awal . ' - ' . $tgl_akhir . '<br>';
            }
        }





        die();

        if ($berdasarkan == 'dasar_barang') {
            // dasar barang
            $datas1 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_jenisbarang($tgl_awal, $tgl_akhir), 'gr_jual_barang')
                ->select(
                    'gr_jual_barang.*',
                )
                ->where($wilayahs, $wilayah)

                ->get();

            $datas2 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_grupbarang($tgl_awal, $tgl_akhir), 'gr_jual_barang')
                ->select(
                    'gr_jual_barang.*',
                )
                ->where($wilayahs, $wilayah)

                ->get();

            $datas3 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_barang($tgl_awal, $tgl_akhir), 'gr_jual_barang')
                ->select(
                    'gr_jual_barang.*',
                )
                ->where($wilayahs, $wilayah)

                ->get();

            $datas4 = null;
        } elseif ($berdasarkan == 'dasar_wilayah') {
            // dasar wilayah
            $datas1 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_wilayah($tgl_awal, $tgl_akhir), 'gr_jual_wilayah')
                ->select(
                    'gr_jual_wilayah.*',
                )
                ->where($wilayahs, $wilayah)

                ->get();

            $datas2 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_wilayah_jenisbarang($tgl_awal, $tgl_akhir), 'gr_jual_wilayah')
                ->select(
                    'gr_jual_wilayah.*',
                )
                ->where($wilayahs, $wilayah)

                ->get();

            $datas3 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_wilayah_grupbarang($tgl_awal, $tgl_akhir), 'gr_jual_wilayah')
                ->select(
                    'gr_jual_wilayah.*',
                )
                ->where($wilayahs, $wilayah)

                ->get();

            $datas4 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_wilayah_barang($tgl_awal, $tgl_akhir), 'gr_jual_wilayah')
                ->select(
                    'gr_jual_wilayah.*',
                )
                ->where($wilayahs, $wilayah)

                ->get();
        } elseif ($berdasarkan == 'dasar_cabang') {
            // dasar cabang
            $datas1 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_cabang($tgl_awal, $tgl_akhir), 'gr_jual_cabang')
                ->select(
                    'gr_jual_cabang.*',
                )
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->get();

            $datas2 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_cabang_jenisbarang($tgl_awal, $tgl_akhir), 'gr_jual_cabang')
                ->select(
                    'gr_jual_cabang.*',
                )
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->get();

            $datas3 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_cabang_grupbarang($tgl_awal, $tgl_akhir), 'gr_jual_cabang')
                ->select(
                    'gr_jual_cabang.*',
                )
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->get();

            $datas4 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_cabang_barang($tgl_awal, $tgl_akhir), 'gr_jual_cabang')
                ->select(
                    'gr_jual_cabang.*',
                )
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->get();
        } elseif ($berdasarkan == 'dasar_pelanggan') {
            // dasar pelanggan
            $datas1 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_pelanggan($tgl_awal, $tgl_akhir), 'gr_jual_pelanggan')
                ->select(
                    'gr_jual_pelanggan.*',
                )
                ->where($cabang, $cabang)
                ->where($pelanggans, $pelanggan)

                ->get();

            $datas2 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_pelanggan_jenisbarang($tgl_awal, $tgl_akhir), 'gr_jual_pelanggan')
                ->select(
                    'gr_jual_pelanggan.*',
                )
                ->where($cabang, $cabang)
                ->where($pelanggans, $pelanggan)

                ->get();

            $datas3 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_pelanggan_grupbarang($tgl_awal, $tgl_akhir), 'gr_jual_pelanggan')
                ->select(
                    'gr_jual_pelanggan.*',
                )
                ->where($cabang, $cabang)
                ->where($pelanggans, $pelanggan)

                ->get();

            $datas4 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_pelanggan_barang($tgl_awal, $tgl_akhir), 'gr_jual_pelanggan')
                ->select(
                    'gr_jual_pelanggan.*',
                )
                ->where($cabang, $cabang)
                ->where($pelanggans, $pelanggan)

                ->get();
        } elseif ($berdasarkan == 'dasar_sales') {
            // dasar sales
            $datas1 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_sales($tgl_awal, $tgl_akhir), 'gr_jual_sales')
                ->select(
                    'gr_jual_sales.*',
                )
                ->where($cabangs, $cabang)
                ->where($saless, $sales)

                ->get();

            $datas2 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_sales_jenisbarang($tgl_awal, $tgl_akhir), 'gr_jual_sales')
                ->select(
                    'gr_jual_sales.*',
                )
                ->where($cabangs, $cabang)
                ->where($saless, $sales)

                ->get();

            $datas3 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_sales_grupbarang($tgl_awal, $tgl_akhir), 'gr_jual_sales')
                ->select(
                    'gr_jual_sales.*',
                )
                ->where($cabangs, $cabang)
                ->where($saless, $sales)

                ->get();

            $datas4 = DB::table(app('App\Http\Controllers\Penjualan\JualController')->gr_jual_sales_barang($tgl_awal, $tgl_akhir), 'gr_jual_sales')
                ->select(
                    'gr_jual_sales.*',
                )
                ->where($cabangs, $cabang)
                ->where($saless, $sales)

                ->get();
        } else {
            $datas1 = null;
            $datas2 = null;
            $datas3 = null;
            $datas4 = null;
        }

        return view('penjualan.jualtrend.index', [
            'menu' => $menu->menu_nama,
            'keterangan' => $menu->menu_keterangan,
            'update' => $update->modifieddate,
            'datas1' => $datas1,
            'datas2' => $datas2,
            'datas3' => $datas3,
            'datas4' => $datas4,
            'datawilayah' => $datawilayah,
            'datacabang' => $datacabang,
            'datapelanggan' => $datapelanggan,
            'datagrupbarang' => $datagrupbarang,
            'datasales' => $datasales,
            'berdasarkan' => $berdasarkan,
            'periode' => $periode,
            'kumulasi' => $kumulasi,
            'grupbarang' => $grupbarang,
            'wilayah' => $wilayah,
            'cabang' => $cabang,
            'pelanggan' => $pelanggan,
            'sales' => $sales,
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
}
