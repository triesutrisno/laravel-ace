@extends('layout.main')

@push('styles')
<!-- page specific plugin style -->
@endpush

@section('breadcrumb','Koreksi Harga Penjualan')
@section('title','Koreksi Harga Penjualan')
@section('subTitle','Merupakan Laporan Koreksi Harga Penjualan')

@section('container')
<div class="row">
    <div class="col-xs-12 col-sm-12">

        <div class="clearfix">
            <div class="col-xs-8 col-sm-8">
                <form method="get" action="{{url('/koreksihargapenjualan')}}">

                    <div class="col-xs-3 col-sm-3">
                        <select class="form-control chosen-select" id="form-field-select-3" name="wilayah">
                            <option value="0" default>----Pilih Wilayah-----</option>
                            @foreach($dataswilayah as $wilayahs)
                            <option value="{{ $wilayahs->wilayahid }}" {{ $wilayah == $wilayahs->wilayahid ? 'selected' : '' }}>{{$wilayahs->wilayahnama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xs-3 col-sm-3">
                        <select class="form-control chosen-select" id="form-field-select-3" name="cabang">
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

        <table id="example" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>nokoreksi</th>
                    <th>tglkoreksi</th>
                    <th>nospj</th>
                    <th>nofaktur</th>
                    <th>nofakturbaru</th>
                    <th>cabangid</th>
                    <th>qtyjual</th>
                    <th>hargaawal</th>
                    <th>jumlahawal</th>
                    <th>hargaganti</th>
                    <th>jumlahganti</th>
                    <th>jumlah</th>
           
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $row)
                <tr>
                    <td align="center">{{$loop->iteration}}</td>
                    <td align="center">{{$row->nokoreksi}}</td>
                    <td align="center">{{$row->tglkoreksi}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->nofaktur}}</td>
                    <td align="center">{{$row->nofakturbaru}}</td>
                    <td align="center">{{$row->cabangid}}</td>
                    <td align="center">{{$row->qtyjual}}</td>
                    <td align="center">{{$row->hargaawal}}</td>
                    <td align="center">{{$row->jumlahawal}}</td>
                    <td align="center">{{$row->hargaganti}}</td>
                    <td align="center">{{$row->jumlahganti}}</td>
                    <td align="center">{{$row->jumlah}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>nokoreksi</th>
                    <th>tglkoreksi</th>
                    <th>nospj</th>
                    <th>nofaktur</th>
                    <th>nofakturbaru</th>
                    <th>cabangid</th>
                    <th>qtyjual</th>
                    <th>hargaawal</th>
                    <th>jumlahawal</th>
                    <th>hargaganti</th>
                    <th>jumlahganti</th>
                    <th>jumlah</th>                  
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@section('script')

<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
<script src="assets/js/bootstrap-datepicker.min.js"></script>


<link rel="stylesheet" href="assets/css/chosen.min.css" />
<script src="assets/js/chosen.jquery.min.js"></script>
<script>
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
        //resize the chosen on window resize

        // $(window)
        //     .off('resize.chosen')
        //     .on('resize.chosen', function() {
        //         $('.chosen-select').each(function() {
        //             var $this = $(this);
        //             $this.next().css({
        //                 'width': $this.parent().width()
        //             });
        //         })
        //     }).trigger('resize.chosen');
        // //resize chosen on sidebar collapse/expand
        // $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
        //     if (event_name != 'sidebar_collapsed') return;
        //     $('.chosen-select').each(function() {
        //         var $this = $(this);
        //         $this.next().css({
        //             'width': $this.parent().width()
        //         });
        //     })
        // });


        // $('#chosen-multiple-style .btn').on('click', function(e) {
        //     var target = $(this).find('input[type=radio]');
        //     var which = parseInt(target.val());
        //     if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
        //     else $('#form-field-select-4').removeClass('tag-input-style');
        // });
    }

    $(document).ready(function() {

        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" size="10" />');
        });

        var table = $('#example').DataTable({
            // "orderCellsTop": true,
            "fixedHeader": true,
            "fixedColumns": true,
            "ordering": false,
            "scrollY": "500px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": true,
            "processing": true,
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
                    "extend": "colvis",
                    "text": "<i class='fa  fa-check-square-o bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    // columns: ':not(:first):not(:last)'
                },
                {
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
@endsection