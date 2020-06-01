@extends('layout.main')

@push('styles')
<!-- page specific plugin style -->
@endpush

@section('breadcrumb','Detail Penjualan')
@section('title','Detail Penjualan')
@section('subTitle','Merupakan Laporan Detail Penjualan')

@section('container')
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead class="center">
        <tr>
            <th class="center">
                <label class="pos-rel">
                    <input type="checkbox" class="ace" />
                    <span class="lbl"></span>
                </label>
            </th>
            <th class="center">No</th>
            <th class="center">No SPJ</th>
            <th class="center">Tgl SPJ</th>
            <th class="center">Pelanggan</th>
            <th class="center">Jenis Jual</th>
            <!-- <th class="center">Barang</th>
            <th class="center">Qty</th>
            <th class="center">Harga</th> -->
            <th class="center">Jumlah</th>
            <th class="center">Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $row)
        <tr>
            <td class="center">
                <label class="pos-rel">
                    <input type="checkbox" class="ace" />
                    <span class="lbl"></span>
                </label>
            </td>
            <td class="center">{{$loop->iteration}}</td>
            <td class="center">{{$row->nospj}}</td>
            <td class="center">{{$row->tglspj}}</td>
            <td class="center">{{$row->pelangganid}}</td>
            <td class="center">{{$row->jenisjual=='1' ? 'Semen' : 'Non Semen'}}</td>
            <!-- <td class="center">{{$row->barangid}}</td> -->
            <!-- <td>{{number_format($row->qty,2)}}</td> -->
            <!-- <td>{{number_format($row->harga,2)}}</td> -->
            <td>{{number_format($row->jumlah,2)}}</td>
            <td class="center">{{$row->status=='0' ? 'Penjualan' : 'Void'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection