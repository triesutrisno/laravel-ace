@extends('layout.main')

@push('styles')
<!-- page specific plugin style -->
@endpush

@section('breadcrumb','Koreksi Harga Jual')
@section('title','Laporan Koreksi')
@section('subTitle','Merupakan Laporan Detail Penjualan')

@section('container')
<table id="example" class="table table-striped table-bordered table-hover">
    <thead class="center">
        <tr>
            <th>No</th>
            <th class="filterhead">Cabang</th>
            <th class="filterhead">Gudang</th>
            <th class="filterhead">No SPJ</th>
            <th class="filterhead">Tgl SPJ</th>
            <th class="filterhead">No Reff</th>
            <th class="filterhead">Pelanggan</th>
            <th class="filterhead">Jenis Jual</th>
            <th class="filterhead">Jenis Kirim</th>
            <th class="filterhead">Nopol</th>
            <th class="filterhead">Barang</th>
            <th class="filterhead">Qty</th>
            <th class="filterhead">Harga</th>
            <th class="filterhead">Jumlah</th>
            <th class="filterhead">Status</th>
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
@endsection

@section('script')
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/fc-3.3.1/fh-3.1.7/r-2.2.5/sc-2.0.2/datatables.min.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/fc-3.3.1/fh-3.1.7/r-2.2.5/sc-2.0.2/datatables.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->

<script>
    // Setup - add a text input to each footer cell
    // $('#example thead tr').clone(true).appendTo('#example thead');
    // $('#example thead tr:eq(1) th').each(function(i) {
    //     var title = $(this).text();
    //     $(this).html('<input type="text" placeholder="Pilih ' + title + '" />');

    //     $('input', this).on('keyup change', function() {
    //         if (table.column(i).search() !== this.value) {
    //             table
    //                 .column(i)
    //                 .search(this.value)
    //                 .draw();
    //         }
    //     });
    // });

    // var table = $('#example').DataTable({
    //     orderCellsTop: false,
    //     fixedHeader: true
    // });

    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         "fixedHeader": true,
    //         "ordering": false,
    //         "scrollY": "500px",
    //         "scrollX": true,
    //         "scrollCollapse": true,
    //         "paging": true,
    //         "processing": true,
    //     });
    // });

    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         "fixedHeader": true,
    //         "ordering": false,
    //         "scrollY": "500px",
    //         "scrollX": true,
    //         "scrollCollapse": true,
    //         "paging": true,
    //         "processing": true,
    //         initComplete: function() {
    //             this.api().columns().every(function() {
    //                 var column = this;
    //                 var select = $('<select><option value=""></option></select> ')
    //                     .appendTo($(column.header()).empty())
    //                     .on('change', function() {
    //                         var val = $.fn.dataTable.util.escapeRegex(
    //                             $(this).val()
    //                         );

    //                         column
    //                             .search(val ? '^' + val + '$' : '', true, false)
    //                             .draw();
    //                     });

    //                 column.data().unique().sort().each(function(d, j) {
    //                     select.append('<option value="' + d + '">' + d + '</option>')
    //                 });
    //             });
    //         }
    //     });
    // })

    $(document).ready(function() { // filter yg sudah sesuai
        var table = $('#example').DataTable({
            // "bLengthChange": false,
            // "iDisplayLength": 15,
            "orderCellsTop": false,
            "fixedHeader": true,
            "ordering": false,
            "scrollY": "500px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": true,
            "processing": true,
        });

        $(".filterhead").each(function(i) {

            var title = $(this).text();
            var select = $('<select><option value="">' + title + '</option></select>')
                .appendTo($(this).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    table.column(i).search(val ? '^' + val + '$' : '', true, false).draw();
                });
            table.column(i).data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });
    });
</script>
@endsection