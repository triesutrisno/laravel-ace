<div class="clearfix">
    <div class="col-xs-12 col-sm-12">
        <div class="pull-right tableTools-container-1"></div>
    </div>
</div>
<table id="dynamic-table-1" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Barang</th>
            <th>Jumlah</th>
        </tr>
    </thead>

    <tbody>
        @foreach($datas1 as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="left">{{ ($row->kategoriid=='1' ? 'Semen' : ($row->kategoriid=='2' ? 'Non Semen' : 'Curah')) }}</td>
            <td align="right">{{ number_format($row->jumlah,2) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>No</th>
            <th>Jenis Barang</th>
            <th>Jumlah</th>
        </tr>
    </tfoot>
</table>