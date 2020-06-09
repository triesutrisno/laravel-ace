@extends('layout.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
@endpush

@section('breadcrumb', $menu)
@section('title', $menu)
@section('subTitle', $keterangan)
@section('subsubTitle', 'update data '.$update)

@section('container')
<div class="row">
    <div class="col-xs-12 col-sm-12">

        <div class="clearfix">
            <div class="col-xs-8 col-sm-8">
                <form method="get" action="{{url('/jualkoreksiharga')}}">

                    <div class="col-xs-2 col-sm-2">
                        <select class="form-control chosen-select" name="wilayah">
                            <option value="0" default>----Pilih Wilayah-----</option>
                            @foreach($datawilayah as $wilayahs)
                            <option value="{{ $wilayahs->wilayahid }}" {{ $wilayah == $wilayahs->wilayahid ? 'selected' : '' }}>{{$wilayahs->wilayahnama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2">
                        <select class="form-control chosen-select" name="cabang">
                            <option value="0" default>----Pilih Cabang-----</option>
                            @foreach($datacabang as $cabangs)
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
                                <th>Cabang</th>
                                <th>Kode Cust</th>
                                <th>Nama Cust</th>
                                <th>Jenis</th>
                                <th>No Koreksi</th>
                                <th>Faktur Jual</th>
                                <th>FJ Baru</th>
                                <th>Faktur Pajak</th>
                                <th>No SPJ</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Tanggal Koreksi</th>
                                <th>Harga Awal</th>
                                <th>Harga Ganti</th>
                                <th>Selisih</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Status</th>


                                
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
                            <td align="center">{{$row->cabangnama}}</td>
                            <td align="center">{{$row->pelanggankode}}</td>
                            <td align="center">{{$row->pelanggannama}}</td>
                            <td align="center">{{$row->tipekoreksi}}</td>
                            <td align="center">{{$row->nokoreksi}}</td>
                            <td align="center">{{$row->nofaktur}}</td>

                            <td align="center">{{$row->nofakturbaru}}</td>
                            <td align="center">{{$row->nofakturbaru}}</td>
                            <td align="center">{{$row->nospj}}</td>

                            <td align="left">{{$row->barangkode}}</td>
                            <td align="center">{{$row->barangnama}}</td>

                            <td align="center">{{$row->qtyjual}}</td>
                            <td align="center">{{$row->tglkoreksi}}</td>

                            <td align="center">{{$row->hargaawal}}</td>
                            <td align="center">{{$row->hargaganti}}</td>
                            
                            <td align="center"></td>

                            <td align="center">{{$row->keterangan}}</td>
                            <td align="center">{{$row->jumlah}}</td>
                            <td align="center">{{$row->status}}</td>
                               
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