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
                <form method="get" action="{{url('/jualbayar')}}">

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
                    <<<<<<< HEAD <!-- <th class="center">
                        =======
                        <th class="center">
                            >>>>>>> 8fe9fe9131de5c21ace0702fcc6bcd993bdf6a12
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                            <<<<<<< HEAD </th> -->
                                =======
                        </th>
                        >>>>>>> 8fe9fe9131de5c21ace0702fcc6bcd993bdf6a12
                        <th>No</th>
                        <th>Wilayah</th>
                        <th>Cabang</th>
                        <th>Kode Customer</th>
                        <th>Customer</th>
                        <th>No Faktur</th>
                        <th>No Tagihan</th>

                        <th>No Invoice</th>
                        <th>No Buku</th>
                        <th>Jenis Bayar</th>
                        <th>No Seri BG</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah Bayar</th>

                </tr>
            </thead>

            <tbody>
                @foreach($datas as $row)
                <tr>
                    <<<<<<< HEAD <!-- <td class="center">
                        =======
                        <td class="center">
                            >>>>>>> 8fe9fe9131de5c21ace0702fcc6bcd993bdf6a12
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                            <<<<<<< HEAD </td> -->
                                =======
                        </td>
                        >>>>>>> 8fe9fe9131de5c21ace0702fcc6bcd993bdf6a12
                        <td align="center">{{$loop->iteration}}</td>
                        <td align="center">{{$row->wilayahnama}}</td>
                        <td align="center">{{$row->cabangnama}}</td>
                        <td align="center">{{$row->pelanggankode}}</td>
                        <td align="center">{{$row->pelanggannama}}</td>
                        <td align="center">{{$row->nofaktur}}</td>
                        <td align="center">{{$row->nobayar}}</td>

                        <td align="center">{{$row->noseribg}}</td>
                        <td align="center">{{$row->jumlah}}</td>
                        <td align="center">{{$row->jumlah}}</td>
                        <td align="center">{{$row->jumlah}}</td>
                        <td align="center">{{$row->tglbayar}}</td>
                        <td align="center">{{$row->jumlah}}</td>

                </tr>
                @endforeach
            </tbody>
            <<<<<<< HEAD <tfoot>
                <tr>
                    <th>No</th>
                    <th>Wilayah</th>
                    <th>Cabang</th>
                    <th>Kode Customer</th>
                    <th>Customer</th>
                    <th>No Faktur</th>
                    <th>No Tagihan</th>

                    <th>No Invoice</th>
                    <th>No Buku</th>
                    <th>Jenis Bayar</th>
                    <th>No Seri BG</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Bayar</th>
                </tr>
                <tfoot>
                    =======
                    >>>>>>> 8fe9fe9131de5c21ace0702fcc6bcd993bdf6a12
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
        <<
        << << < HEAD
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
=======
$('#dynamic-table').DataTable({
"scrollX": true
});
} );

</script>
>>>>>>> 8fe9fe9131de5c21ace0702fcc6bcd993bdf6a12
@endpush