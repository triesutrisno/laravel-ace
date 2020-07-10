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
            <div class="col-xs-10 col-sm-10">
                <form method="get" action="{{url('/piutangsaldo')}}">

                    <div class="col-xs-2 col-sm-2">
                        <select class="form-control chosen-select" id="form-field-select-3" name="wilayah">
                            <option value="0" default>----Pilih Wilayah-----</option>
                            @foreach($datawilayah as $wilayahs)
                            <option value="{{ $wilayahs->wilayahid }}" {{ $wilayah == $wilayahs->wilayahid ? 'selected' : '' }}>{{$wilayahs->wilayahnama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2">
                        <select class="form-control chosen-select" id="form-field-select-3" name="cabang">
                            <option value="0" default>----Pilih Cabang-----</option>
                            @foreach($datacabang as $cabangs)
                            <option value="{{ $cabangs->cabangid }}" {{ $cabang == $cabangs->cabangid ? 'selected' : '' }}>{{$cabangs->cabangnama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-3 col-sm-3">
                        <select class="form-control chosen-select" id="pelanggan" name="pelanggan">
                            <option value="0" default>----Pilih Pelanggan-----</option>
                            @foreach($datapelanggan as $pelanggans)
                            <option value="{{ $pelanggans->pelangganid }}" {{ $pelanggan == $pelanggans->pelangganid ? 'selected' : '' }}>{{ $pelanggans->cabangnama. ' - '.$pelanggans->pelanggankode. ' - '.$pelanggans->pelanggannama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2">
                        <select class="form-control chosen-select" id="status" name="status">
                            <option value="1" {{ $status == 1 ? 'selected' : '' }} default>Pelanggan Aktif</option>
                            <option value="0" {{ $status == 0 ? 'selected' : '' }}>Pelanggan Non Aktif</option>
                        </select>
                    </div>

                    <div class="col-xs-1 col-sm-1">
                        <input type="text" class="form-control date-picker" placeholder="tglawal" name='tglawal' id="tglawal" value="{{ $tglawal }}">
                    </div>

                    <div class="col-xs-1 col-sm-1">
                        <input type="text" class="form-control date-picker" placeholder="tglakhir" name='tglakhir' id="tglakhir" value="{{ $tglakhir }}">
                    </div>

                    <div class="col-xs-1 col-sm-1">
                        <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="pull-right tableTools-container"></div>
        </div>
        &nbsp;
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Wilayah</th>
                    <th>Cabang</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Jenis Plafon</th>
                    <th>Limit Normal</th>
                    <th>Tempo Normal</th>
                    <th>Limit Tambahan</th>
                    <th>Tempo Tambahan</th>
                    <th>SAwal</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>SAKhir</th>
                </tr>
            </thead>

            <tbody>
                @foreach($datas as $row)
                <tr>
                    <td align="center">{{$row->wilayahnama}}</td>
                    <td align="center">{{$row->cabangnama}}</td>
                    <td align="center">{{$row->pelanggankode}}</td>
                    <td align="left">{{$row->pelanggannama}}</td>
                    <td align="center">{{$row->jenisplafon}}</td>
                    <td align="right">{{number_format($row->limitpkb,2)}}</td>
                    <td align="right">{{number_format($row->temponormal,2)}}</td>
                    <td align="right">{{number_format($row->limitpkc,2)}}</td>
                    <td align="right">{{number_format($row->tempotambahan,2)}}</td>
                    <td align="right">{{number_format($row->sawal,2)}}</td>
                    <td align="right">{{number_format($row->debet,2)}}</td>
                    <td align="right">{{number_format($row->kredit,2)}}</td>
                    <td align="right">{{number_format($row->sakhir,2)}}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th>Wilayah</th>
                    <th>Cabang</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Jenis Plafon</th>
                    <th>Limit Normal</th>
                    <th>Tempo Normal</th>
                    <th>Limit Tambahan</th>
                    <th>Tempo Tambahan</th>
                    <th>SAwal</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>SAKhir</th>
                </tr>
            </tfoot>
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
        $('#dynamic-table tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" size="10" />');
        });

        var table =
            $('#dynamic-table').DataTable({
                "scrollY": "500px",
                "ordering": false,
                "scrollX": true,
                "scrollCollapse": true,
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;

                        $('input', this.footer()).on('keyup change clear', function() {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });
                }
            });

        new $.fn.dataTable.Buttons(table, {
            buttons: [{
                    "extend": "copy",
                    "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "csv",
                    "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "excel",
                    "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "pdf",
                    "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "print",
                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    autoPrint: false,
                    message: 'This print was produced using the Print button for DataTables'
                }
            ]
        });
        table.buttons().container().appendTo($('.tableTools-container'));
    });
</script>
@endpush