<div class="clearfix">
    <div class="col-xs-12 col-sm-12">
        <div class="pull-right tableTools-container-1"></div>
    </div>
</div>
<table id="dynamic-table-1" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </thead>

    <tbody>
        @foreach($datas1 as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="left">{{ $row->wilayahnama }}</td>
            <td align="right">{{ number_format($row->qtyberat,2) }}</td>
            <td align="right">{{ number_format($row->jumlah,2) }}</td>
            <td align="right">{{ number_format($row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->jumlah - $row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->nihpp,2) }}</td>
            <td align="right">{{ number_format($row->gcm,2) }}</td>
            <td align="right">{{ number_format($row->nihpp == 0 ? 0 : $row->gcm / $row->nihpp * 100 ,2).' %' }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </tfoot>
</table>
<br>
<div class="clearfix">
    <div class="col-xs-12 col-sm-12">
        <div class="pull-right tableTools-container-2"></div>
    </div>
</div>
<table id="dynamic-table-2" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Jenis Barang</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </thead>

    <tbody>
        @foreach($datas2 as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="left">{{ $row->wilayahnama }}</td>
            <td align="left">{{ ($row->kategoriid=='1' ? 'Semen' : ($row->kategoriid=='2' ? 'Non Semen' : 'Curah')) }}</td>
            <td align="right">{{ number_format($row->qtyberat,2) }}</td>
            <td align="right">{{ number_format($row->jumlah,2) }}</td>
            <td align="right">{{ number_format($row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->jumlah - $row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->nihpp,2) }}</td>
            <td align="right">{{ number_format($row->gcm,2) }}</td>
            <td align="right">{{ number_format($row->nihpp == 0 ? 0 : $row->gcm / $row->nihpp * 100 ,2).' %' }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Jenis Barang</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </tfoot>
</table>
<br>
<div class="clearfix">
    <div class="col-xs-12 col-sm-12">
        <div class="pull-right tableTools-container-3"></div>
    </div>
</div>
<table id="dynamic-table-3" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Jenis Barang</th>
            <th>Grup Barang</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </thead>

    <tbody>
        @foreach($datas3 as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="left">{{ $row->wilayahnama }}</td>
            <td align="left">{{ ($row->kategoriid=='1' ? 'Semen' : ($row->kategoriid=='2' ? 'Non Semen' : 'Curah')) }}</td>
            <td align="left">{{ $row->grupnama }}</td>
            <td align="right">{{ number_format($row->qtyberat,2) }}</td>
            <td align="right">{{ number_format($row->jumlah,2) }}</td>
            <td align="right">{{ number_format($row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->jumlah - $row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->nihpp,2) }}</td>
            <td align="right">{{ number_format($row->gcm,2) }}</td>
            <td align="right">{{ number_format($row->nihpp == 0 ? 0 : $row->gcm / $row->nihpp * 100 ,2).' %' }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Jenis Barang</th>
            <th>Grup Barang</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </tfoot>
</table>
<br>
<div class="clearfix">
    <div class="col-xs-12 col-sm-12">
        <div class="pull-right tableTools-container-4"></div>
    </div>
</div>
<table id="dynamic-table-4" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Jenis Barang</th>
            <th>Grup Barang</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Qty Total</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </thead>

    <tbody>
        @foreach($datas4 as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="left">{{ $row->wilayahnama }}</td>
            <td align="left">{{ ($row->kategoriid=='1' ? 'Semen' : ($row->kategoriid=='2' ? 'Non Semen' : 'Curah')) }}</td>
            <td align="left">{{ $row->grupnama }}</td>
            <td align="left">{{ $row->barangkode }}</td>
            <td align="left">{{ $row->barangnama }}</td>
            <td align="right">{{ number_format($row->qty,2) }}</td>
            <td align="right">{{ number_format($row->qtyberat,2) }}</td>
            <td align="right">{{ number_format($row->jumlah,2) }}</td>
            <td align="right">{{ number_format($row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->jumlah - $row->dpp,2) }}</td>
            <td align="right">{{ number_format($row->nihpp,2) }}</td>
            <td align="right">{{ number_format($row->gcm,2) }}</td>
            <td align="right">{{ number_format($row->nihpp == 0 ? 0 : $row->gcm / $row->nihpp * 100 ,2).' %' }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Wilayah</th>
            <th>Jenis Barang</th>
            <th>Grup Barang</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Qty Total</th>
            <th>Qty Berat (KG)</th>
            <th>Jumlah</th>
            <th>Dpp</th>
            <th>PPn</th>
            <th>NiHpp</th>
            <th>GCM</th>
            <th>GCM %</th>
        </tr>
    </tfoot>
</table>