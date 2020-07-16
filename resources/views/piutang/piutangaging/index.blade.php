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
    <div class="col-lg-12 col-sm-12">

        <div class="clearfix">
            <div class="col-lg-10 col-sm-10">
                <form method="get" action="{{url('/piutangaging')}}">

                    <div class="col-lg-12 col-sm-12">
                        <div class="col-lg-3 col-sm-12">
                            <select class="form-control deepdrop chosen-select" id="form-field-select-3" name="wilayah" data-dependent="cabang">
                                <option value="0" default>----Pilih Wilayah-----</option>
                                @foreach($datawilayah as $wilayahs)
                                <option value="{{ $wilayahs->wilayahid }}" {{ $wilayah == $wilayahs->wilayahid ? 'selected' : '' }}>{{$wilayahs->wilayahnama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-sm-12">
                            <select name="cabang" id="cabang" class="form-control deepdrop chosen-select" data-dependent="pelanggan">
                                <option value="" default>Pilih Cabang</option>
                                @foreach($datacabang as $cabangs)
                                <option value="{{ $cabangs->cabangid }}" {{ $cabang == $cabangs->cabangid ? 'selected' : '' }}>{{$cabangs->cabangnama}}</option>
                                @endforeach
                            </select>
                            @error('cabang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <select name="pelanggan" id="pelanggan" class="form-control">
                                <option value="0">----Pilih Pelanggan-----</option>
                                @foreach($datapelanggan as $pelanggans)
                                <option value="{{ $pelanggans->pelangganid }}" {{ $pelanggan == $pelanggans->pelangganid ? 'selected' : '' }}>{{ $pelanggans->cabangnama. ' - '.$pelanggans->pelanggankode. ' - '.$pelanggans->pelanggannama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-2 col-sm-2">
                            <select class="form-control chosen-select" id="status" name="status">
                                <option value="1" {{ $status == 1 ? 'selected' : '' }}>Pelanggan Aktif</option>
                                <option value="0" {{ $status == 0 ? 'selected' : '' }}>Pelanggan Non Aktif</option>
                            </select>
                        </div>

                    </div>
                    <br>&nbsp;
                    <div class="col-lg-12 col-sm-12">
                        <div class="col-lg-2 col-sm-2">
                            <input type="text" class="form-control date-picker" placeholder="tanggal" name='tanggal' id="tanggal" value="{{ $tanggal }}">
                        </div>

                        <div class="col-xs-1 col-sm-1">
                            <input type="text" class="form-controlr" size="5" placeholder="range1" name='range1' id="range1" value="{{ $range1 }}">
                        </div>
                        <div class="col-xs-1 col-sm-1">
                            <input type="text" class="form-controlr" size="5" placeholder="range2" name='range2' id="range2" value="{{ $range2 }}">
                        </div>
                        <div class="col-xs-1 col-sm-1">
                            <input type="text" class="form-controlr" size="5" placeholder="range3" name='range3' id="range3" value="{{ $range3 }}">
                        </div>
                        <div class="col-xs-1 col-sm-1">
                            <input type="text" class="form-controlr" size="5" placeholder="range4" name='range4' id="range4" value="{{ $range4 }}">
                        </div>
                        <div class="col-xs-1 col-sm-1">
                            <input type="text" class="form-controlr" size="5" placeholder="range5" name='range5' id="range5" value="{{ $range5 }}">
                        </div>

                        <div class="col-xs-1 col-sm-1">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pull-right tableTools-container"></div>
        </div>
        &nbsp;
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Wilayah</th>
                    <th>Cabang</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>No Faktur</th>
                    <th>No SPJ</th>
                    <th>Tgl Faktur</th>
                    <th>Tgl Tempo</th>
                    <th>Jenis</th>
                    <th>Tempo</th>
                    <th>Umur</th>
                    <th>Sisa Piutang</th>
                    <th>Belum Tempo</th>
                    <th>{{ 'JT 1 - '.$range1 }}</th>
                    <th>{{ 'JT '.($range1+1).' - '.$range2 }}</th>
                    <th>{{ 'JT '.($range2+1).' - '.$range3 }}</th>
                    <th>{{ 'JT '.($range3+1).' - '.$range4 }}</th>
                    <th>{{ 'JT '.($range4+1).' - '.$range5 }}</th>
                    <th>{{ 'JT > '.$range5 }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($datas as $row)
                <tr>
                    <td align="center">{{$row->wilayahnama}}</td>
                    <td align="center">{{$row->cabangnama}}</td>
                    <td align="center">{{$row->pelanggankode}}</td>
                    <td align="left">{{$row->pelanggannama}}</td>
                    <td align="center">{{$row->nofaktur}}</td>
                    <td align="center">{{$row->nospj}}</td>
                    <td align="center">{{$row->tglfaktur}}</td>
                    <td align="center">{{$row->tgltempo}}</td>
                    <td align="center">{{$row->jenisplafon}}</td>
                    <td align="center">{{$row->temponormal}}</td>
                    <td align="center">{{$row->umur}}</td>
                    <td align="right">{{number_format($row->sisapiutang,2)}}</td>
                    <td align="right">{{number_format($row->belum,2)}}</td>
                    <td align="right">{{number_format($row->jumlah1,2)}}</td>
                    <td align="right">{{number_format($row->jumlah2,2)}}</td>
                    <td align="right">{{number_format($row->jumlah3,2)}}</td>
                    <td align="right">{{number_format($row->jumlah4,2)}}</td>
                    <td align="right">{{number_format($row->jumlah5,2)}}</td>
                    <td align="right">{{number_format($row->jumlah6,2)}}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th>Wilayah</th>
                    <th>Cabang</th>
                    <th>Kode Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>No Faktur</th>
                    <th>No SPJ</th>
                    <th>Tgl Faktur</th>
                    <th>Tgl Tempo</th>
                    <th>Jenis</th>
                    <th>Tempo</th>
                    <th>Umur</th>
                    <th>Sisa Piutang</th>
                    <th>Belum Tempo</th>
                    <th>{{ 'JT 1 - '.$range1 }}</th>
                    <th>{{ 'JT '.($range1+1).' - '.$range2 }}</th>
                    <th>{{ 'JT '.($range2+1).' - '.$range3 }}</th>
                    <th>{{ 'JT '.($range3+1).' - '.$range4 }}</th>
                    <th>{{ 'JT '.($range4+1).' - '.$range5 }}</th>
                    <th>{{ 'JT > '.$range5 }}</th>
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
        $(".deepdrop").change(function() {
            //alert('Alhamdulillah');
            if ($(this).val() != '') {
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                //var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/') }}/" + dependent,
                    method: "GET",
                    data: {
                        value: value
                    },
                    success: function(result) {
                        //alert(dependent);
                        $('#' + dependent).html(result);
                    }
                })
            }
        });

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