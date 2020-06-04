@extends('layout.main')

@push('styles')
<!-- page specific plugin style -->
@endpush

@section('breadcrumb','Detail Penjualan')
@section('title','Detail Penjualan')
@section('subTitle','Merupakan Laporan Detail Penjualan')

@section('container')
<div class="row">
    <div class="col-xs-12 col-sm-12">

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <table id="example" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Gudang</th>
                    <th>No SPJ</th>
                    <th>Tgl SPJ</th>
                    <th>No Reff</th>
                    <th>Pelanggan</th>
                    <th>Jenis Jual</th>
                    <th>Jenis Kirim</th>
                    <th>Nopol</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $row)
                <tr>
                    <td align="center">{{$loop->iteration}}</td>
                    <td align="center">{{$row->cabangid}}</td>
                    <td align="center">{{$row->gudangid}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->tglspj}}</td>
                    <td align="center">{{$row->noreff1}}</td>
                    <td align="center">{{$row->pelangganid}}</td>
                    <td align="center">{{$row->jenisjual=='1' ? 'Semen' : 'Non Semen'}}</td>
                    <td align="center">{{$row->jeniskirim}}</td>
                    <td align="center">{{$row->nopol}}</td>
                    <td align="center">{{$row->barangid}}</td>
                    <td align="right">{{number_format($row->qty,2)}}</td>
                    <td align="right">{{number_format($row->harga,2)}}</td>
                    <td align="right">{{number_format($row->jumlah,2)}}</td>
                    <td align="center">{{$row->status=='0' ? 'Penjualan' : 'Void'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')

<script>
    // $(document).ready(function() {
    //     // Setup - add a text input to each footer cell
    //     $('#example thead th').each(function() {
    //         var title = $(this).text();
    //         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    //     });

    //     // DataTable
    //     var table = $('#example').DataTable({
    //         "ordering": false,
    //         initComplete: function() {
    //             // Apply the search
    //             this.api().columns().every(function() {
    //                 var that = this;

    //                 $('input', this.footer()).on('keyup change clear', function() {
    //                     if (that.search() !== this.value) {
    //                         that
    //                             .search(this.value)
    //                             .draw();
    //                     }
    //                 });
    //             });
    //         }
    //     });

    // });

    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example thead tr').clone(true).appendTo('#example thead');
        $('#example thead tr:eq(1) th').each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Cari ' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
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

    // $(document).ready(function() {
    //     // Setup - add a text input to each footer cell
    //     $('#example thead th').each(function() {
    //         var title = $(this).text();
    //         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    //     });

    //     // DataTable
    //     var table = $('#example').DataTable({
    //         initComplete: function() {
    //             // Apply the search
    //             this.api().columns().every(function() {
    //                 var that = this;

    //                 $('input', this.footer()).on('keyup change clear', function() {
    //                     if (that.search() !== this.value) {
    //                         that
    //                             .search(this.value)
    //                             .draw();
    //                     }
    //                 });
    //             });
    //         }
    //     });
    // });
</script>
@endsection