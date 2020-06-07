@extends('layout.main')

@push('styles')
<!-- page specific plugin style -->
@endpush

@section('breadcrumb','Detail Penjualan')
@section('title','Detail Penjualan')
@section('subTitle','Merupakan Laporan Detail Penjualan')

@section('container')
<div class="row">
    <div class="col-xs-12 col-sm-12">

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead class="center">
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Gudang</th>
                    <th>No SPJ</th>
                    <th>Tgl SPJ</th>
                    <th>No Reff</th>
                    <th>Pelanggan</th>
                    <th>Jenis Jual</th>
                    <th>Jenis Kirim</th>
                    <th>Nopol</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $row)
                <tr>
                    <td align="center">{{$loop->iteration}}</td>
                    <td align="center">{{$row->cabangid}}</td>
                    <td align="center">{{$row->gudangid}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->tglspj}}</td>
                    <td align="center">{{$row->noreff1}}</td>
                    <td align="center">{{$row->pelangganid}}</td>
                    <td align="center">{{$row->jenisjual=='1' ? 'Semen' : 'Non Semen'}}</td>
                    <td align="center">{{$row->jeniskirim}}</td>
                    <td align="center">{{$row->nopol}}</td>
                    <td align="center">{{$row->barangid}}</td>
                    <td align="right">{{number_format($row->qty,2)}}</td>
                    <td align="right">{{number_format($row->harga,2)}}</td>
                    <td align="right">{{number_format($row->jumlah,2)}}</td>
                    <td align="center">{{$row->status=='0' ? 'Penjualan' : 'Void'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection