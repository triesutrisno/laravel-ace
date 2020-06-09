@extends('layout.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@endpush

@section('breadcrumb', $menu ?? '')
@section('title', $menu ?? '')
@section('subTitle', $keterangan ?? '')
@section('subsubTitle', 'update data '.$datas)

@section('container')
<div class="row">
    <div class="col-xs-12 col-sm-12">

        <div class="clearfix">
            <div class="col-xs-8 col-sm-8">
                <form method="get" action="{{url('/jualkoreksiharga')}}">

                    <div class="col-xs-2 col-sm-2">
                        <select class="form-control chosen-select" name="wilayah">
                            <option value="0" default>----Pilih Wilayah-----</option>
                            @foreach($dataswilayah as $wilayahs)
                            <option value="{{ $wilayahs->wilayahid }}" {{ $wilayah == $wilayahs->wilayahid ? 'selected' : '' }}>{{$wilayahs->wilayahnama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2">
                        <select class="form-control chosen-select" name="cabang">
                            <option value="0" default>----Pilih Cabang-----</option>
                            @foreach($datascabang as $cabangs)
                            <option value="{{ $cabangs->cabangid }}" {{ $cabang == $cabangs->cabangid ? 'selected' : '' }}>{{$cabangs->cabangnama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2">
                        <input type="text" class="form-control date-picker" placeholder="tanggal awal" name='tgl_awal' id="tgl_awal" value="{{ $tgl_awal }}">
                    </div>
                    <div class="col-xs-2 col-sm-2">
                        <input type="text" class="form-control date-picker" placeholder="tanggal akhir" name='tgl_akhir' id="tgl_akhir" value="{{ $tgl_akhir }}">
                    </div>

                    <div class="col-xs-1 col-sm-1">
                        <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="pull-right tableTools-container"></div>
        </div>
        
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                        <tr>
                                <th class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>No</th>
                                <th>Wilayah</th>
                                <th>Cabang</th>
                                <th>Gudang</th>
                                <th>Tgl SPJ</th>
                                <th>No SPJ</th>
                                <th>No Reff</th>
                                <th>Jenis Kirim</th>
                                <th>Nopol</th>
                                <th>Kode Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Pelanggan Shipto</th>
                                <th>Jenis Jual</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Berat</th>
                                <th>Qty Awal</th>
                                <th>Harga Harga</th>
                                <th>Qty</th>
                                <th>Berat (Kg)</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Dpp</th>
                                <th>Hpp</th>
                                <th>NiHpp</th>
                                <th>Status</th>
                                <th>No Faktur</th>
                                <th>Tgl Faktur</th>
                                <th>No Faktur Pajak</th>
                        </tr>
                </thead>

                <tbody>
                @foreach($datas as $row)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td align="center">{{$loop->iteration}}</td>
                            <td align="center">{{$row->wilayahnama}}</td>
                            <td align="center">{{$row->cabangnama}}</td>
                            <td align="center">{{$row->gudangnama}}</td>
                            <td align="center">{{$row->tglspj}}</td>
                            <td align="center">{{$row->nospj}}</td>
                            <td align="center">{{$row->noreff1}}</td>
                            <td align="center">{{$row->jeniskirim}}</td>
                            <td align="center">{{$row->nopol}}</td>
                            <td align="center">{{$row->pelanggankode}}</td>
                            <td align="left">{{$row->pelanggannama}}</td>
                            <td align="left">{{$row->pelangganshipto}}</td>
                            <td align="center">{{ ($row->jenisjual=='1' ? 'Semen' : ($row->jenisjual=='2' ? 'Non Semen' : 'Curah')) }}</td>
                            <td align="center">{{$row->barangkode}}</td>
                            <td align="left">{{$row->barangnama}}</td>
                            <td align="right">{{number_format($row->berat,2)}}</td>
                            <td align="right">{{number_format($row->qtyawal,2)}}</td>
                            <td align="right">{{number_format($row->hargaawal,2)}}</td>
                            <td align="right">{{number_format($row->qty,2)}}</td>
                            <td align="right">{{number_format($row->qty * $row->berat,2)}}</td>
                            <td align="right">{{number_format($row->harga,2)}}</td>
                            <td align="right">{{number_format($row->jumlah,2)}}</td>
                            <td align="right">{{number_format($row->dpp,2)}}</td>
                            <td align="right">{{number_format($row->hpp,2)}}</td>
                            <td align="right">{{number_format($row->nihpp,2)}}</td>
                            <td align="center">{{ ($row->status=='0' ? 'Penjualan' : ($row->status=='3' ? 'Void' : 'Belum SPJ Kembali')) }}</td>
                            <td align="center">{{$row->nofaktur}}</td>
                            <td align="center">{{$row->tglfaktur}}</td>
                            <td align="center">{{$row->nofakturpajak}}</td>
                               
                        </tr>
                        @endforeach
                </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>

<script type="text/javascript">
    //datepicker plugin
    //link
    $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "yyyy-mm-dd"
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function() {
            $(this).prev().focus();
        });

    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({
            allow_single_deselect: true
        });
    }
    $(document).ready(function() {
        $('#dynamic-table').DataTable({
            "scrollX": true
        });
    } );
            
</script>              
@endpush