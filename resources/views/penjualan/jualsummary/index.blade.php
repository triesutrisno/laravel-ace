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
                <form method="get" action="{{url('/jualsummary')}}">

                    <div class="col-lg-12 col-sm-12">
                        <div class="col-xs-3 col-sm-3">
                            <select class="form-control chosen-select" id="berdasarkan" name="berdasarkan">
                                <option value="" default>----Pilih Berdasarkan-----</option>
                                <option value="dasar_wilayah" {{$berdasarkan == "dasar_wilayah" ? 'selected' : ''}}> Per Wilayah </option>
                                <option value="dasar_cabang" {{$berdasarkan == "dasar_cabang" ? 'selected' : ''}}> Per Cabang </option>
                                <option value="dasar_pelanggan" {{$berdasarkan == "dasar_pelanggan" ? 'selected' : ''}}> Per Pelanggan </option>

                            </select>
                        </div>

                        <div class="col-xs-2 col-sm-2" id="wilayah">
                            <select class="form-control chosen-select" name="wilayah">
                                <option value="0" default>----Pilih Wilayah-----</option>
                                @foreach($datawilayah as $wilayahs)
                                <option value="{{ $wilayahs->wilayahid }}" {{ $wilayah == $wilayahs->wilayahid ? 'selected' : '' }}>{{$wilayahs->wilayahnama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xs-2 col-sm-2" id="cabang">
                            <select class="form-control chosen-select" name="cabang">
                                <option value="0" default>----Pilih Cabang-----</option>
                                @foreach($datacabang as $cabangs)
                                <option value="{{ $cabangs->cabangid }}" {{ $cabang == $cabangs->cabangid ? 'selected' : '' }}>{{$cabangs->cabangnama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xs-4 col-sm-4" id="pelanggan">
                            <select class="form-control chosen-select" id="pelanggan" name="pelanggan">
                                <option value="0" default>----Pilih Pelanggan-----</option>
                                @foreach($datapelanggan as $pelanggans)
                                <option value="{{ $pelanggans->pelangganid }}" {{ $pelanggan == $pelanggans->pelangganid ? 'selected' : '' }}>{{ $pelanggans->cabangnama. ' - '.$pelanggans->pelanggankode. ' - '.$pelanggans->pelanggannama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>&nbsp;
                    <div class="col-lg-12 col-sm-12">
                        <div class="col-xs-2 col-sm-2">
                            <input type="text" class="form-control date-picker" placeholder="tanggal awal" name='tgl_awal' id="tgl_awal" value="{{ $tgl_awal }}">
                        </div>
                        <div class="col-xs-2 col-sm-2">
                            <input type="text" class="form-control date-picker" placeholder="tanggal akhir" name='tgl_akhir' id="tgl_akhir" value="{{ $tgl_akhir }}">
                        </div>

                        <div class="col-xs-1 col-sm-1">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="pull-right tableTools-container"></div> -->
        </div>

        @if ($berdasarkan === 'dasar_wilayah')
        <!-- untuk dasar_wilayah -->
        @include('penjualan.jualsummary.dasar_wilayah')

        @elseif ($berdasarkan === 'dasar_cabang')
        <!-- untuk dasar_cabang -->
        @include('penjualan.jualsummary.dasar_cabang')

        @elseif ($berdasarkan === 'dasar_pelanggan')
        <!-- untuk dasar_pelanggan -->
        @include('penjualan.jualsummary.dasar_pelanggan')

        @else
        <!-- Jika Belum dipilih filternya -->
        @endif
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
    $(function() {
        $('#wilayah').hide();
        $('#cabang').hide();
        $('#pelanggan').hide();

        $('#berdasarkan').change(function() {
            if ($('#berdasarkan').val() == 'dasar_wilayah') {
                $('#wilayah').hide();
                $('#cabang').hide();
                $('#pelanggan').hide();

            }
            if ($('#berdasarkan').val() == 'dasar_cabang') {
                $('#wilayah').show();
                $('#cabang').show();

                $('#pelanggan').hide();

            }
            if ($('#berdasarkan').val() == 'dasar_pelanggan') {
                $('#wilayah').show();
                $('#cabang').show();
                $('#pelanggan').show();


            }

        }).trigger('change');
    });
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
        $('#dynamic-table-1 tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" size="10" />');
        });

        var table =
            $('#dynamic-table-1').DataTable({
                "scrollX": true,
                "fixedHeader": true,
                "fixedColumns": true,
                "scrollY": "500px",
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
        table.buttons().container().appendTo($('.tableTools-container-1'));
    });

    $(document).ready(function() {
        $('#dynamic-table-2 tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" size="10" />');
        });

        var table =
            $('#dynamic-table-2').DataTable({
                "scrollX": true,
                "fixedHeader": true,
                "fixedColumns": true,
                "scrollY": "500px",
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
        table.buttons().container().appendTo($('.tableTools-container-2'));
    });

    $(document).ready(function() {
        $('#dynamic-table-3 tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" size="10" />');
        });

        var table =
            $('#dynamic-table-3').DataTable({
                "scrollX": true,
                "fixedHeader": true,
                "fixedColumns": true,
                "scrollY": "500px",
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
        table.buttons().container().appendTo($('.tableTools-container-3'));
    });

    $(document).ready(function() {
        $('#dynamic-table-4 tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" size="10" />');
        });

        var table =
            $('#dynamic-table-4').DataTable({
                "scrollX": true,
                "fixedHeader": true,
                "fixedColumns": true,
                "scrollY": "500px",
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
        table.buttons().container().appendTo($('.tableTools-container-4'));
    });
</script>
@endpush