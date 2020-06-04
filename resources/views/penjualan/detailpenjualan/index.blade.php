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
            <div class="col-xs-5 col-sm-5">
                <form method="get" action="{{url('/detailpenjualan/search')}}">
                    <div class="col-xs-4 col-sm-4">
                        <input type="text" class="form-control datepicker" name='tanggal_awal' placeholder="tanggal awal" id="form-tanggal_awal" value="{{old('tanggal_awal')}}">
                    </div>
                    <div class="col-xs-4 col-sm-4">
                        <input type="text" class="form-control datepicker" name='tanggal_akhir' placeholder="tanggal akhir" id="form-tanggal_akhir" value="{{old('tanggal_akhir')}}">
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
                    <th>Wilayah</th>
                    <th>Cabang</th>
                    <th>Gudang</th>
                    <th>Tgl SPJ</th>
                    <th>No SPJ</th>
                    <th>No Reff</th>
                    <th>Jenis Kirim</th>
                    <th>Nopol</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Pelanggan Shipto</th>
                    <th>Jenis Jual</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Berat</th>
                    <th>Qty Awal</th>
                    <th>Harga Harga</th>
                    <th>Qty</th>
                    <th>Berat (Kg)</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Dpp</th>
                    <th>Hpp</th>
                    <th>NiHpp</th>
                    <th>Status</th>
                    <th>No Faktur</th>
                    <th>Tgl Faktur</th>
                    <th>No Faktur Pajak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td align="center">{{$loop->iteration}}</td>
                    <td align="center">{{$row->wilayahnama}}</td>
                    <td align="center">{{$row->cabangnama}}</td>
                    <td align="center">{{$row->gudangnama}}</td>
                    <td align="center">{{$row->tglspj}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->noreff1}}</td>
                    <td align="center">{{$row->jeniskirim}}</td>
                    <td align="center">{{$row->nopol}}</td>
                    <td align="center">{{$row->pelanggankode}}</td>
                    <td align="left">{{$row->pelanggannama}}</td>
                    <td align="left">{{$row->pelangganshipto}}</td>
                    <td align="center">{{ ($row->jenisjual=='1' ? 'Semen' : ($row->jenisjual=='2' ? 'Non Semen' : 'Curah')) }}</td>
                    <td align="center">{{$row->barangkode}}</td>
                    <td align="left">{{$row->barangnama}}</td>
                    <td align="right">{{number_format($row->berat,2)}}</td>
                    <td align="right">{{number_format($row->qtyawal,2)}}</td>
                    <td align="right">{{number_format($row->hargaawal,2)}}</td>
                    <td align="right">{{number_format($row->qty,2)}}</td>
                    <td align="right">{{number_format($row->qty * $row->berat,2)}}</td>
                    <td align="right">{{number_format($row->harga,2)}}</td>
                    <td align="right">{{number_format($row->jumlah,2)}}</td>
                    <td align="right">{{number_format($row->dpp,2)}}</td>
                    <td align="right">{{number_format($row->hpp,2)}}</td>
                    <td align="right">{{number_format($row->nihpp,2)}}</td>
                    <td align="center">{{ ($row->status=='0' ? 'Penjualan' : ($row->status=='3' ? 'Void' : 'Belum SPJ Kembali')) }}</td>
                    <td align="center">{{$row->nofaktur}}</td>
                    <td align="center">{{$row->tglfaktur}}</td>
                    <td align="center">{{$row->nofakturpajak}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th className="select-filter">Wilayah</th>
                    <th>Cabang</th>
                    <th>Gudang</th>
                    <th>Tgl SPJ</th>
                    <th>No SPJ</th>
                    <th>No Reff</th>
                    <th>Jenis Kirim</th>
                    <th>Nopol</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Pelanggan Shipto</th>
                    <th>Jenis Jual</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Berat</th>
                    <th>Qty Awal</th>
                    <th>Harga Harga</th>
                    <th>Qty</th>
                    <th>Berat (Kg)</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Dpp</th>
                    <th>Hpp</th>
                    <th>NiHpp</th>
                    <th>Status</th>
                    <th>No Faktur</th>
                    <th>Tgl Faktur</th>
                    <th>No Faktur Pajak</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

@section('script')
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->


<script>
    // jQuery.noConflict();
    // $('#form-tanggal_awal").datepicker({
    //     dateFormat: "yy-mm-dd"
    // });
    // $("#form-tanggal_akhir").datepicker({
    //     dateFormat: "yy-mm-dd"
    // });


    $(document).ready(function() {

        $('#example tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Cari '+title+'" size="10" />' );
        } );
 
        // Setup - add a text input to each footer cell

        // $('#example thead tr').clone(true).appendTo('#example thead');
        // $('#example thead tr:eq(1) th').each(function(i) {
        //     var title = $(this).text();
        //     $(this).html('<input type="text" class="form-control" placeholder="Cari ' + title + '" />');

        //     $('input', this).on('keyup change', function() {
        //         if (table.column(i).search() !== this.value) {
        //             table
        //                 .column(i)
        //                 .search(this.value)
        //                 .draw();
        //         }
        //     });
        // });

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
            initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;
    
                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
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