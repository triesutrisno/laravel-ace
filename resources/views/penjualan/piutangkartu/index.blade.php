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
                <form method="get" action="{{url('/piutangkartu')}}">

                    <div class="col-xs-4 col-sm-4">
                        <select class="form-control chosen-select" id="pelanggan" name="pelanggan">
                            <option value="0" default>----Pilih Pelanggan-----</option>
                            @foreach($datapelanggan as $pelanggans)
                            <option value="{{ $pelanggans->pelangganid }}" {{ $pelanggan == $pelanggans->pelangganid ? 'selected' : '' }}>{{ $pelanggans->cabangnama. ' - '.$pelanggans->pelanggankode. ' - '.$pelanggans->pelanggannama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-1 col-sm-1">
                        <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="pull-right tableTools-container"></div>
        </div>

        <div class="clearfix">
            <div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
                <div class="widget-box" id="widget-box-5">
                    <div class="widget-header">
                        <h5 class="widget-title smaller">Semen</h5>

                        <div class="widget-toolbar">
                            <span class="label label-success">
                                16%
                                <i class="ace-icon fa fa-arrow-up"></i>
                            </span>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-success"> Plafon </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-danger"> Piutang </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-info"> Proses SPJ </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-warning"> Proses SPJ </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
                <div class="widget-box" id="widget-box-5">
                    <div class="widget-header">
                        <h5 class="widget-title smaller">Semen</h5>

                        <div class="widget-toolbar">
                            <span class="label label-success">
                                16%
                                <i class="ace-icon fa fa-arrow-up"></i>
                            </span>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-success"> Plafon </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-danger"> Piutang </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-info"> Proses SPJ </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-warning"> Proses SPJ </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
                <div class="widget-box" id="widget-box-5">
                    <div class="widget-header">
                        <h5 class="widget-title smaller">Semen</h5>

                        <div class="widget-toolbar">
                            <span class="label label-success">
                                16%
                                <i class="ace-icon fa fa-arrow-up"></i>
                            </span>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-success"> Plafon </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-danger"> Piutang </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-info"> Proses SPJ </div>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6">
                            <div class="alert alert-warning"> Proses SPJ </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        &nbsp;
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th rowspan="2">No Faktur</th>
                    <th rowspan="2">No SPJ</th>
                    <th rowspan="2">Tgl Faktur</th>
                    <th rowspan="2">Umur</th>
                    <th colspan="3">Total Piutang</th>
                </tr>
                <tr>
                    <th>Semen</th>
                    <th>Non Semen</th>
                    <th>Curah</th>
                </tr>
            </thead>

            <tbody>
                @foreach($datas as $row)
                <tr>
                    <td align="center">{{$row->nofaktur}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->tglfaktur}}</td>
                    <td align="center">{{$row->umur}}</td>
                    <td align="right">{{number_format($row->piutangsemen,2)}}</td>
                    <td align="right">{{number_format($row->piutangnonsemen,2)}}</td>
                    <td align="right">{{number_format($row->piutangcurah,2)}}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th>No Faktur</th>
                    <th>No SPJ</th>
                    <th>Tgl Faktur</th>
                    <th>Umur</th>
                    <th>Semen</th>
                    <th>Non Semen</th>
                    <th>Curah</th>
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