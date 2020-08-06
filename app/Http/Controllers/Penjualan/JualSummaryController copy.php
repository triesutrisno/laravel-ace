<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JualSummaryController extends Controller
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
            ->where('menu_id', 26)
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

        $datagrupbarang = DB::table('ms_barang_grup')
            ->orderBy('grupnama')
            ->get();

        if ($berdasarkan == 'dasar_wilayah') {

            $datas1 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )
                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')

                ->groupBy('ms_wilayah.wilayahnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")

                ->get();

            $datas2 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_barang.kategoriid',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_barang.kategoriid')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")

                ->get();

            $datas3 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_barang.kategoriid',
                    'ms_barang_grup.grupnama',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_barang.kategoriid')
                ->groupBy('ms_barang_grup.grupnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")
                ->orderBy("ms_barang_grup.grupnama", "ASC")

                ->get();

            $datas4 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_barang.kategoriid',
                    'ms_barang_grup.grupnama',
                    'ms_barang.barangkode',
                    'ms_barang.barangnama',
                    DB::raw('SUM(tr_jual.qty) qty'),
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_barang.kategoriid')
                ->groupBy('ms_barang_grup.grupnama')
                ->groupBy('ms_barang.barangkode')
                ->groupBy('ms_barang.barangnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")
                ->orderBy("ms_barang_grup.grupnama", "ASC")
                ->orderBy("ms_barang.barangkode", "ASC")
                ->orderBy("ms_barang.barangnama", "ASC")

                ->get();
        } elseif ($berdasarkan == 'dasar_cabang') {

            $datas1 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")

                ->get();

            $datas2 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    'ms_barang.kategoriid',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')
                ->groupBy('ms_barang.kategoriid')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")

                ->get();

            $datas3 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    'ms_barang.kategoriid',
                    'ms_barang_grup.grupnama',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')
                ->groupBy('ms_barang.kategoriid')
                ->groupBy('ms_barang_grup.grupnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")
                ->orderBy("ms_barang_grup.grupnama", "ASC")

                ->get();

            $datas4 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    'ms_barang.kategoriid',
                    'ms_barang_grup.grupnama',
                    'ms_barang.barangkode',
                    'ms_barang.barangnama',
                    DB::raw('SUM(tr_jual.qty) qty'),
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($wilayahs, $wilayah)
                ->where($cabangs, $cabang)

                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')
                ->groupBy('ms_barang.kategoriid')
                ->groupBy('ms_barang_grup.grupnama')
                ->groupBy('ms_barang.barangkode')
                ->groupBy('ms_barang.barangnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")
                ->orderBy("ms_barang_grup.grupnama", "ASC")
                ->orderBy("ms_barang.barangkode", "ASC")
                ->orderBy("ms_barang.barangnama", "ASC")

                ->get();
        } elseif ($berdasarkan == 'dasar_pelanggan') {

            $datas1 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    'ms_pelanggan.pelanggankode',
                    'ms_pelanggan.pelanggannama',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($cabangs, $cabang)
                ->where($pelanggans, $pelanggan)

                ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual.pelangganid')
                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')
                ->groupBy('ms_pelanggan.pelanggankode')
                ->groupBy('ms_pelanggan.pelanggannama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")
                ->orderBy("ms_pelanggan.pelanggankode", "ASC")
                ->orderBy("ms_pelanggan.pelanggannama", "ASC")

                ->get();

            $datas2 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    'ms_pelanggan.pelanggankode',
                    'ms_pelanggan.pelanggannama',
                    'ms_barang.kategoriid',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($cabangs, $cabang)
                ->where($pelanggans, $pelanggan)

                ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual.pelangganid')
                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')
                ->groupBy('ms_pelanggan.pelanggankode')
                ->groupBy('ms_pelanggan.pelanggannama')
                ->groupBy('ms_barang.kategoriid')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")
                ->orderBy("ms_pelanggan.pelanggankode", "ASC")
                ->orderBy("ms_pelanggan.pelanggannama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")

                ->get();

            $datas3 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    'ms_pelanggan.pelanggankode',
                    'ms_pelanggan.pelanggannama',
                    'ms_barang.kategoriid',
                    'ms_barang_grup.grupnama',
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($cabangs, $cabang)
                ->where($pelanggans, $pelanggan)

                ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual.pelangganid')
                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')
                ->groupBy('ms_pelanggan.pelanggankode')
                ->groupBy('ms_pelanggan.pelanggannama')
                ->groupBy('ms_barang.kategoriid')
                ->groupBy('ms_barang_grup.grupnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")
                ->orderBy("ms_pelanggan.pelanggankode", "ASC")
                ->orderBy("ms_pelanggan.pelanggannama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")
                ->orderBy("ms_barang_grup.grupnama", "ASC")

                ->get();

            $datas4 = DB::table('tr_jual')->wherebetween('tglspj', [$tgl_awal, $tgl_akhir])
                ->select(
                    'ms_wilayah.wilayahnama',
                    'ms_cabang.cabangnama',
                    'ms_pelanggan.pelanggankode',
                    'ms_pelanggan.pelanggannama',
                    'ms_barang.kategoriid',
                    'ms_barang_grup.grupnama',
                    'ms_barang.barangkode',
                    'ms_barang.barangnama',
                    DB::raw('SUM(tr_jual.qty) qty'),
                    DB::raw('SUM(tr_jual.qty * ms_barang.berat) qtyberat'),
                    DB::raw('SUM(tr_jual.jumlah) jumlah'),
                    DB::raw('SUM(tr_jual.dpp) dpp'),
                    DB::raw('SUM(tr_jual.nihpp) nihpp'),
                    DB::raw('SUM(tr_jual.dpp) - SUM(tr_jual.nihpp) gcm'),
                    // DB::raw(' (SUM(tr_jual.dpp) - SUM(tr_jual.nihpp)) / SUM(tr_jual.nihpp) * 100 gcmpersen'),
                )

                ->where('tr_jual.status', '=', 0)
                ->where($cabangs, $cabang)
                ->where($pelanggans, $pelanggan)

                ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'tr_jual.pelangganid')
                ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'tr_jual.cabangid')
                ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
                ->join('ms_barang', 'ms_barang.barangid', '=', 'tr_jual.barangid')
                ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

                ->groupBy('ms_wilayah.wilayahnama')
                ->groupBy('ms_cabang.cabangnama')
                ->groupBy('ms_pelanggan.pelanggankode')
                ->groupBy('ms_pelanggan.pelanggannama')
                ->groupBy('ms_barang.kategoriid')
                ->groupBy('ms_barang_grup.grupnama')
                ->groupBy('ms_barang.barangkode')
                ->groupBy('ms_barang.barangnama')

                ->orderBy("ms_wilayah.wilayahnama", "ASC")
                ->orderBy("ms_cabang.cabangnama", "ASC")
                ->orderBy("ms_pelanggan.pelanggankode", "ASC")
                ->orderBy("ms_pelanggan.pelanggannama", "ASC")
                ->orderBy("ms_barang.kategoriid", "ASC")
                ->orderBy("ms_barang_grup.grupnama", "ASC")
                ->orderBy("ms_barang.barangkode", "ASC")
                ->orderBy("ms_barang.barangnama", "ASC")

                ->get();
        } else {
            $datas1 = null;
            $datas2 = null;
            $datas3 = null;
            $datas4 = null;
        }

        return view('penjualan.jualsummary.index', [
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
            'berdasarkan' => $berdasarkan,
            'wilayah' => $wilayah,
            'cabang' => $cabang,
            'pelanggan' => $pelanggan,
            'grupbarang' => $grupbarang,
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
