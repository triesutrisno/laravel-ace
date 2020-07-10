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
                <form method="get" action="{{url('/piutangcek')}}">

                    <div class="col-xs-3 col-sm-3">
                        <select class="form-control chosen-select" id="pelanggan" name="pelanggan">
                            <option value="0" default>----Pilih Pelanggan-----</option>
                            @foreach($datapelanggan as $pelanggans)
                            <option value="{{ $pelanggans->pelangganid }}" {{ $pelanggan == $pelanggans->pelangganid ? 'selected' : '' }}>{{ $pelanggans->cabangnama. ' - '.$pelanggans->pelanggankode. ' - '.$pelanggans->pelanggannama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-2 col-sm-2">
                        <input type="text" class="form-control date-picker" placeholder="tanggal" name='tanggal' id="tanggal" value="{{ $tanggal }}">
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
                    <th>No Faktur</th>
                    <th>No SPJ</th>
                    <th>Tgl Faktur</th>
                    <th>Jenis</th>
                    <th>Tempo</th>
                    <th>Umur</th>
                    <th>Jml Piutang</th>
                    <th>Jml Retur</th>
                    <th>Jml KorHar 1</th>
                    <th>Jml KorHar 2</th>
                    <th>Jml KorPiu</th>
                    <th>Jml Bayar</th>
                    <th>Jml Bayar Batal</th>
                    <th>Jml Bayar Lebih</th>
                    <th>Sisa Piutang</th>
                </tr>
            </thead>

            <tbody>
                @foreach($datas as $row)
                <tr>
                    <td align="center">{{$row->pelanggankode}}</td>
                    <td align="left">{{$row->pelanggannama}}</td>
                    <td align="center">{{$row->nofaktur}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->tglfaktur}}</td>
                    <td align="center">{{$row->jenisplafon}}</td>
                    <td align="center">{{$row->temponormal}}</td>
                    <td align="center">{{$row->umur}}</td>
                    <td align="right">{{$row->jumlah,2}}</td>
                    <td align="right">{{$row->jmlretur,2}}</td>
                    <td align="right">{{$row->jmlkorhar1,2}}</td>
                    <td align="right">{{$row->jmlkorhar2,2}}</td>
                    <td align="right">{{$row->jmlkorpiu,2}}</td>
                    <td align="right">{{$row->jmlbayar,2}}</td>
                    <td align="right">{{$row->jmlbatal,2}}</td>
                    <td align="right">{{$row->jmllebih,2}}</td>
                    <td align="right">{{$row->sisapiutang,2}}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>No Faktur</th>
                    <th>No SPJ</th>
                    <th>Tgl Faktur</th>
                    <th>Jenis</th>
                    <th>Tempo</th>
                    <th>Umur</th>
                    <th>Jml Piutang</th>
                    <th>Jml Retur</th>
                    <th>Jml KorHar 1</th>
                    <th>Jml KorHar 2</th>
                    <th>Jml KorPiu</th>
                    <th>Jml Bayar</th>
                    <th>Jml Bayar Batal</th>
                    <th>Jml Bayar Lebih</th>
                    <th>Sisa Piutang</th>
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