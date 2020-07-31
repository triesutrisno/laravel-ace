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
            <div class="pull-right tableTools-container"></div>
        </div>

        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Grup Barang</th>
                    <th>COA Persediaan Baik</th>
                    <th>COA Persediaan Rijek</th>
                    <th>COA COGS</th>
                    <th>COA Penjualan</th>
                    <th>COA Intransit</th>
                    <th>COA Intransit Penjualan</th>
                    <th>COA Intransit Cabang</th>
                    <th>COA Bongkar</th>
                    <th>COA Muat</th>
                    <th>COA Pok</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($datas as $row)
                <tr>
                    <td align="center">{{$loop->iteration}}</td>
                    <td align="left">{{$row->grupnama}}</td>
                    <td align="center">{{$row->coapersediaanbaik}}</td>
                    <td align="center">{{$row->coapersediaanrijek}}</td>
                    <td align="center">{{$row->coacogs}}</td>
                    <td align="center">{{$row->coapenjualan}}</td>
                    <td align="center">{{$row->coaintransit}}</td>
                    <td align="center">{{$row->coaintransitjual}}</td>
                    <td align="center">{{$row->coaintransitcabang}}</td>
                    <td align="center">{{$row->coabongkar}}</td>
                    <td align="center">{{$row->coamuat}}</td>
                    <td align="center">{{$row->coapok}}</td>
                    <td align="center">{{$row->status==0 ? 'Non Aktif' : 'Aktif'}}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Grup Barang</th>
                    <th>COA Persediaan Baik</th>
                    <th>COA Persediaan Rijek</th>
                    <th>COA COGS</th>
                    <th>COA Penjualan</th>
                    <th>COA Intransit</th>
                    <th>COA Intransit Penjualan</th>
                    <th>COA Intransit Cabang</th>
                    <th>COA Bongkar</th>
                    <th>COA Muat</th>
                    <th>COA Pok</th>
                    <th>Status</th>

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
                "scrollX": true,
                "fixedHeader": true,
                "fixedColumns": true,
                "scrollY": "500px",
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