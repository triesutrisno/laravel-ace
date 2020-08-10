<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use DB;


class JualController extends Controller
{
    // mulai barang
    public function gr_jual_jenisbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_barang')
            ->wherebetween('gr_jual_barang.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_barang.kategoriid',
                DB::raw('SUM(gr_jual_barang.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_barang.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_barang.dpp) dpp'),
                DB::raw('SUM(gr_jual_barang.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_barang.dpp) - SUM(gr_jual_barang.nihpp) gcm'),
            )

            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_barang.barangid')

            ->groupBy('ms_barang.kategoriid')

            ->orderBy('jumlah', 'DESC');

        return $datas;
    }

    public function gr_jual_grupbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_barang')
            ->wherebetween('gr_jual_barang.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                DB::raw('SUM(gr_jual_barang.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_barang.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_barang.dpp) dpp'),
                DB::raw('SUM(gr_jual_barang.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_barang.dpp) - SUM(gr_jual_barang.nihpp) gcm'),
            )

            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_barang.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')

            ->orderBy('jumlah', 'DESC');

        return $datas;
    }

    public function gr_jual_barang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_barang')
            ->wherebetween('gr_jual_barang.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                'ms_barang.barangkode',
                'ms_barang.barangnama',
                DB::raw('SUM(gr_jual_barang.qty) qty'),
                DB::raw('SUM(gr_jual_barang.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_barang.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_barang.dpp) dpp'),
                DB::raw('SUM(gr_jual_barang.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_barang.dpp) - SUM(gr_jual_barang.nihpp) gcm'),
            )

            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_barang.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')
            ->groupBy('ms_barang.barangkode')
            ->groupBy('ms_barang.barangnama')

            ->orderBy('jumlah', 'DESC');

        return $datas;
    }

    // mulai wilayah
    public function gr_jual_wilayah($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_wilayah')
            ->wherebetween('gr_jual_wilayah.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                DB::raw('SUM(gr_jual_wilayah.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_wilayah.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_wilayah.dpp) dpp'),
                DB::raw('SUM(gr_jual_wilayah.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_wilayah.dpp) - SUM(gr_jual_wilayah.nihpp) gcm'),
            )

            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'gr_jual_wilayah.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_wilayah.barangid')

            ->groupBy('ms_wilayah.wilayahnama')

            ->orderBy('jumlah', 'DESC');

        return $datas;
    }

    public function gr_jual_wilayah_jenisbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_wilayah')
            ->wherebetween('gr_jual_wilayah.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_barang.kategoriid',
                DB::raw('SUM(gr_jual_wilayah.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_wilayah.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_wilayah.dpp) dpp'),
                DB::raw('SUM(gr_jual_wilayah.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_wilayah.dpp) - SUM(gr_jual_wilayah.nihpp) gcm'),
            )

            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'gr_jual_wilayah.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_wilayah.barangid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_barang.kategoriid')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC');

        return $datas;
    }

    public function gr_jual_wilayah_grupbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_wilayah')
            ->wherebetween('gr_jual_wilayah.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                DB::raw('SUM(gr_jual_wilayah.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_wilayah.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_wilayah.dpp) dpp'),
                DB::raw('SUM(gr_jual_wilayah.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_wilayah.dpp) - SUM(gr_jual_wilayah.nihpp) gcm'),
            )

            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'gr_jual_wilayah.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_wilayah.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC');

        return $datas;
    }

    public function gr_jual_wilayah_barang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_wilayah')
            ->wherebetween('gr_jual_wilayah.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                'ms_barang.barangkode',
                'ms_barang.barangnama',
                DB::raw('SUM(gr_jual_wilayah.qty) qty'),
                DB::raw('SUM(gr_jual_wilayah.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_wilayah.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_wilayah.dpp) dpp'),
                DB::raw('SUM(gr_jual_wilayah.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_wilayah.dpp) - SUM(gr_jual_wilayah.nihpp) gcm'),
            )

            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'gr_jual_wilayah.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_wilayah.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')
            ->groupBy('ms_barang.barangkode')
            ->groupBy('ms_barang.barangnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC')
            ->orderBy('ms_barang.barangkode', 'ASC')
            ->orderBy('ms_barang.barangnama', 'ASC');

        return $datas;
    }

    // mulai cabang
    public function gr_jual_cabang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_cabang')
            ->wherebetween('gr_jual_cabang.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                DB::raw('SUM(gr_jual_cabang.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_cabang.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_cabang.dpp) dpp'),
                DB::raw('SUM(gr_jual_cabang.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_cabang.dpp) - SUM(gr_jual_cabang.nihpp) gcm'),
            )

            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'gr_jual_cabang.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_cabang.barangid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')

            ->orderBy('jumlah', 'DESC');;

        return $datas;
    }

    public function gr_jual_cabang_jenisbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_cabang')
            ->wherebetween('gr_jual_cabang.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_barang.kategoriid',
                DB::raw('SUM(gr_jual_cabang.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_cabang.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_cabang.dpp) dpp'),
                DB::raw('SUM(gr_jual_cabang.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_cabang.dpp) - SUM(gr_jual_cabang.nihpp) gcm'),
            )

            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'gr_jual_cabang.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_cabang.barangid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_barang.kategoriid')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC');

        return $datas;
    }

    public function gr_jual_cabang_grupbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_cabang')
            ->wherebetween('gr_jual_cabang.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                DB::raw('SUM(gr_jual_cabang.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_cabang.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_cabang.dpp) dpp'),
                DB::raw('SUM(gr_jual_cabang.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_cabang.dpp) - SUM(gr_jual_cabang.nihpp) gcm'),
            )

            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'gr_jual_cabang.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_cabang.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC');

        return $datas;
    }

    public function gr_jual_cabang_barang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_cabang')
            ->wherebetween('gr_jual_cabang.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                'ms_barang.barangkode',
                'ms_barang.barangnama',
                DB::raw('SUM(gr_jual_cabang.qty) qty'),
                DB::raw('SUM(gr_jual_cabang.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_cabang.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_cabang.dpp) dpp'),
                DB::raw('SUM(gr_jual_cabang.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_cabang.dpp) - SUM(gr_jual_cabang.nihpp) gcm'),
            )

            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'gr_jual_cabang.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_cabang.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')
            ->groupBy('ms_barang.barangkode')
            ->groupBy('ms_barang.barangnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC')
            ->orderBy('ms_barang.barangkode', 'ASC')
            ->orderBy('ms_barang.barangnama', 'ASC');

        return $datas;
    }

    // mulai pelanggan
    public function gr_jual_pelanggan($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_pelanggan')
            ->wherebetween('gr_jual_pelanggan.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                DB::raw('SUM(gr_jual_pelanggan.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_pelanggan.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) dpp'),
                DB::raw('SUM(gr_jual_pelanggan.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) - SUM(gr_jual_pelanggan.nihpp) gcm'),
            )

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'gr_jual_pelanggan.pelangganid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pelanggan.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_pelanggan.barangid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pelanggan.pelanggankode')
            ->groupBy('ms_pelanggan.pelanggannama')

            ->orderBy('jumlah', 'DESC');

        return $datas;
    }

    public function gr_jual_pelanggan_jenisbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_pelanggan')
            ->wherebetween('gr_jual_pelanggan.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'ms_barang.kategoriid',
                DB::raw('SUM(gr_jual_pelanggan.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_pelanggan.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) dpp'),
                DB::raw('SUM(gr_jual_pelanggan.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) - SUM(gr_jual_pelanggan.nihpp) gcm'),
            )

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'gr_jual_pelanggan.pelangganid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pelanggan.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_pelanggan.barangid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pelanggan.pelanggankode')
            ->groupBy('ms_pelanggan.pelanggannama')
            ->groupBy('ms_barang.kategoriid')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pelanggan.pelanggankode', 'ASC')
            ->orderBy('ms_pelanggan.pelanggannama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC');

        return $datas;
    }

    public function gr_jual_pelanggan_grupbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_pelanggan')
            ->wherebetween('gr_jual_pelanggan.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                DB::raw('SUM(gr_jual_pelanggan.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_pelanggan.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) dpp'),
                DB::raw('SUM(gr_jual_pelanggan.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) - SUM(gr_jual_pelanggan.nihpp) gcm'),
            )

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'gr_jual_pelanggan.pelangganid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pelanggan.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_pelanggan.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pelanggan.pelanggankode')
            ->groupBy('ms_pelanggan.pelanggannama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pelanggan.pelanggankode', 'ASC')
            ->orderBy('ms_pelanggan.pelanggannama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC');

        return $datas;
    }

    public function gr_jual_pelanggan_barang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_pelanggan')
            ->wherebetween('gr_jual_pelanggan.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pelanggan.pelanggankode',
                'ms_pelanggan.pelanggannama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                'ms_barang.barangkode',
                'ms_barang.barangnama',
                DB::raw('SUM(gr_jual_pelanggan.qty) qty'),
                DB::raw('SUM(gr_jual_pelanggan.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_pelanggan.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) dpp'),
                DB::raw('SUM(gr_jual_pelanggan.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_pelanggan.dpp) - SUM(gr_jual_pelanggan.nihpp) gcm'),
            )

            ->join('ms_pelanggan', 'ms_pelanggan.pelangganid', '=', 'gr_jual_pelanggan.pelangganid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pelanggan.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_pelanggan.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pelanggan.pelanggankode')
            ->groupBy('ms_pelanggan.pelanggannama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')
            ->groupBy('ms_barang.barangkode')
            ->groupBy('ms_barang.barangnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pelanggan.pelanggankode', 'ASC')
            ->orderBy('ms_pelanggan.pelanggannama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC')
            ->orderBy('ms_barang.barangkode', 'ASC')
            ->orderBy('ms_barang.barangnama', 'ASC');

        return $datas;
    }

    // mulai sales
    public function gr_jual_sales($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_sales')
            ->wherebetween('gr_jual_sales.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pegawai.pegawainik',
                'ms_pegawai.pegawainama',
                DB::raw('SUM(gr_jual_sales.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_sales.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_sales.dpp) dpp'),
                DB::raw('SUM(gr_jual_sales.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_sales.dpp) - SUM(gr_jual_sales.nihpp) gcm'),
            )

            ->join('ms_pegawai', 'ms_pegawai.pegawaiid', '=', 'gr_jual_sales.salesid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pegawai.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_sales.barangid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pegawai.pegawainik')
            ->groupBy('ms_pegawai.pegawainama')

            ->orderBy('jumlah', 'DESC');

        return $datas;
    }

    public function gr_jual_sales_jenisbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_sales')
            ->wherebetween('gr_jual_sales.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pegawai.pegawainik',
                'ms_pegawai.pegawainama',
                'ms_barang.kategoriid',
                DB::raw('SUM(gr_jual_sales.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_sales.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_sales.dpp) dpp'),
                DB::raw('SUM(gr_jual_sales.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_sales.dpp) - SUM(gr_jual_sales.nihpp) gcm'),
            )

            ->join('ms_pegawai', 'ms_pegawai.pegawaiid', '=', 'gr_jual_sales.salesid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pegawai.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_sales.barangid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pegawai.pegawainik')
            ->groupBy('ms_pegawai.pegawainama')
            ->groupBy('ms_barang.kategoriid')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pegawai.pegawainik', 'ASC')
            ->orderBy('ms_pegawai.pegawainama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC');

        return $datas;
    }

    public function gr_jual_sales_grupbarang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_sales')
            ->wherebetween('gr_jual_sales.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pegawai.pegawainik',
                'ms_pegawai.pegawainama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                DB::raw('SUM(gr_jual_sales.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_sales.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_sales.dpp) dpp'),
                DB::raw('SUM(gr_jual_sales.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_sales.dpp) - SUM(gr_jual_sales.nihpp) gcm'),
            )

            ->join('ms_pegawai', 'ms_pegawai.pegawaiid', '=', 'gr_jual_sales.salesid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pegawai.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_sales.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pegawai.pegawainik')
            ->groupBy('ms_pegawai.pegawainama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pegawai.pegawainik', 'ASC')
            ->orderBy('ms_pegawai.pegawainama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC');

        return $datas;
    }

    public function gr_jual_sales_barang($tgl_awal, $tgl_akhir)
    {
        $datas = DB::table('gr_jual_sales')
            ->wherebetween('gr_jual_sales.tglspj', [$tgl_awal, $tgl_akhir])
            ->select(
                'ms_wilayah.wilayahnama',
                'ms_cabang.cabangnama',
                'ms_pegawai.pegawainik',
                'ms_pegawai.pegawainama',
                'ms_barang.kategoriid',
                'ms_barang_grup.grupnama',
                'ms_barang.barangkode',
                'ms_barang.barangnama',
                DB::raw('SUM(gr_jual_sales.qty) qty'),
                DB::raw('SUM(gr_jual_sales.qty * ms_barang.berat) qtyberat'),
                DB::raw('SUM(gr_jual_sales.jumlah) jumlah'),
                DB::raw('SUM(gr_jual_sales.dpp) dpp'),
                DB::raw('SUM(gr_jual_sales.nihpp) nihpp'),
                DB::raw('SUM(gr_jual_sales.dpp) - SUM(gr_jual_sales.nihpp) gcm'),
            )

            ->join('ms_pegawai', 'ms_pegawai.pegawaiid', '=', 'gr_jual_sales.salesid')
            ->join('ms_cabang', 'ms_cabang.cabangid', '=', 'ms_pegawai.cabangid')
            ->join('ms_wilayah', 'ms_wilayah.wilayahid', '=', 'ms_cabang.wilayahid')
            ->join('ms_barang', 'ms_barang.barangid', '=', 'gr_jual_sales.barangid')
            ->join('ms_barang_grup', 'ms_barang_grup.grupid', '=', 'ms_barang.grupid')

            ->groupBy('ms_wilayah.wilayahnama')
            ->groupBy('ms_cabang.cabangnama')
            ->groupBy('ms_pegawai.pegawainik')
            ->groupBy('ms_pegawai.pegawainama')
            ->groupBy('ms_barang.kategoriid')
            ->groupBy('ms_barang_grup.grupnama')
            ->groupBy('ms_barang.barangkode')
            ->groupBy('ms_barang.barangnama')

            ->orderBy('ms_wilayah.wilayahnama', 'ASC')
            ->orderBy('ms_cabang.cabangnama', 'ASC')
            ->orderBy('ms_pegawai.pegawainik', 'ASC')
            ->orderBy('ms_pegawai.pegawainama', 'ASC')
            ->orderBy('ms_barang.kategoriid', 'ASC')
            ->orderBy('ms_barang_grup.grupnama', 'ASC')
            ->orderBy('ms_barang.barangkode', 'ASC')
            ->orderBy('ms_barang.barangnama', 'ASC');

        return $datas;
    }
}
