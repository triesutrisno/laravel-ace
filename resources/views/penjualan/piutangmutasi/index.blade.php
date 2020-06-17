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
                <form method="get" action="{{url('/piutangmutasi/show')}}">

                    <div class="col-xs-3 col-sm-3">
                        <select class="form-control chosen-select" id="berdasarkan" name="berdasarkan">
                            <option value="" default>----Pilih Berdasarkan-----</option>
                            <option value="dasarnospj" {{$berdasarkan == "dasarnospj" ? 'selected' : ''}}> Cari Berdasarkan No SPJ </option>
                            <option value="dasarnofaktur" {{$berdasarkan == "dasarnofaktur" ? 'selected' : ''}}> Cari Berdasarkan No Faktur </option>
                            <option value="dasarpelanggan" {{$berdasarkan == "dasarpelanggan" ? 'selected' : ''}}> Cari Berdasarkan Pelanggan </option>
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2" id="dasarnospj">
                        <input type="text" class="form-control" placeholder="nospj" name='nospj' id="nospj" value="{{ $nospj }}">
                    </div>

                    <div class="col-xs-2 col-sm-2" id="dasarnofaktur">
                        <input type="text" class="form-control" placeholder="nofaktur" name='nofaktur' id="nofaktur" value="{{ $nofaktur }}">
                    </div>

                    <div class="col-xs-4 col-sm-4" id="pelanggan">
                        <select class="form-control chosen-select" id="pelanggan" name="pelanggan">
                            <option value="0" default>----Pilih Pelanggan-----</option>
                            @foreach($datapelanggan as $pelanggans)
                            <option value="{{ $pelanggans->pelangganid }}" {{ $pelanggan == $pelanggans->pelangganid ? 'selected' : '' }}>{{ $pelanggans->cabangnama. ' - '.$pelanggans->pelanggankode. ' - '.$pelanggans->pelanggannama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2" id="tgl_awal">
                        <input type="text" class="form-control date-picker" placeholder="tanggal awal" name='tgl_awal' id="tgl_awal" value="{{ $tgl_awal }}">
                    </div>
                    <div class="col-xs-2 col-sm-2" id="tgl_akhir">
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
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>No SPJ</th>
                    <th>No Faktur</th>
                    <th>No Reff</th>
                    <th>Tanggal</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                </tr>
            </thead>

            <tbody>
                @foreach($datas as $row)
                <tr>
                    <td align="center">{{$row->pelanggankode}}</td>
                    <td align="center">{{$row->pelanggannama}}</td>
                    <td align="center">{{$row->keterangan}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->nofaktur}}</td>
                    <td align="center">{{$row->noreff}}</td>
                    <td align="center">{{$row->tglfaktur}}</td>
                    <td align="right">{{number_format($row->debet,2)}}</td>
                    <td align="right">{{number_format($row->kredit,2)}}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>No SPJ</th>
                    <th>No Faktur</th>
                    <th>No Reff</th>
                    <th>Tanggal</th>
                    <th>Debet</th>
                    <th>Kredit</th>
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
    $(function() {
        $('#dasarnospj').hide();
        $('#dasarnofaktur').hide();
        $('#pelanggan').hide();
        $('#tgl_awal').hide();
        $('#tgl_akhir').hide();

        $('#berdasarkan').change(function() {
            if ($('#berdasarkan').val() == 'dasarnospj') {
                $('#dasarnospj').show();
                $('#nospj').show();

                $('#dasarnofaktur').hide();
                $('#nofaktur').val(null);

                $('#pelanggan').hide();
                $('#pelanggan').val(null);

                $('#tgl_awal').hide();
                $('#tgl_awal').val(null);

                $('#tgl_akhir').hide();
                $('#tgl_akhir').val(null);
            }
            if ($('#berdasarkan').val() == 'dasarnofaktur') {
                $('#dasarnofaktur').show();
                $('#nofaktur').show();

                $('#dasarnospj').hide();
                $('#nospj').val(null);

                $('#pelanggan').hide();
                $('#pelanggan').val(null);

                $('#tgl_awal').hide();
                $('#tgl_awal').val(null);

                $('#tgl_akhir').hide();
                $('#tgl_akhir').val(null);
            }
            if ($('#berdasarkan').val() == 'dasarpelanggan') {
                $('#pelanggan').show();
                $('#tgl_awal').show();
                $('#tgl_akhir').show();

                $('#dasarnospj').hide();
                $('#nospj').val(null);

                $('#dasarnofaktur').hide();
                $('#nofaktur').val(null);

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
        $('#dynamic-table tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" size="10" />');
        });

        var table =
            $('#dynamic-table').DataTable({
                "ordering": false,
                // "scrollX": true,
                // "fixedHeader": true,
                // "fixedColumns": true,
                // "scrollY": "500px",
                // "scrollX": true,
                // "scrollCollapse": true,
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