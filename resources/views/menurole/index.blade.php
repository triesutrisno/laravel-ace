@extends('layout.main')

@push('styles')
 <!-- page specific plugin style -->
@endpush

@section('breadcrumb','Menu Role')
@section('title','Daftar Menu Role')
@section('subTitle','Merupakan halaman daftar menu role dalam sistem')

@section('container')
<div class="row">
	<div class="col-xs-12 col-sm-12">

		<div class="clearfix">
                        
                        <a href="{{url('/menurole/create')}}" class="btn btn-white btn-info btn-bold">
                                <i class="ace-icon glyphicon glyphicon-plus bigger-120 blue"></i>
                                Tambah Data
                        </a>
			<div class="pull-right tableTools-container"></div>
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
                
                @if (session('pesan'))
                    @if (session('kode')=='99')
                        <div class="alert alert-success">
                            <i class="ace-icon fa  fa-info-circle bigger-120 blue"></i>
                            {{ session('pesan') }}
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <i class="ace-icon fa  fa-info-circle bigger-120 red"></i>
                            {{ session('pesan') }}
                        </div>
                    @endif
                @endif
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                                <tr>
                                        <th class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th class="center">No</th>
                                        <th>Nama Role</th>
                                        <th>Nama Menu</th>
                                        <th class="center">Status</th>
                                        <th>Created</th>
                                        <th colspan="3">Action</th>
                                </tr>
                        </thead>

                        <tbody>
                        @foreach($menuroles as $menurole)
                                <tr>
                                        <td class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </td>
                                        
                                        <td class="center">{{$loop->iteration}}</td>
                                        <td>{{$menurole->role_nama}}</td>
                                        <td>{{$menurole->menu_id}}</td>
                                        <td class="center">{{$menurole->menurole_status=='1' ? 'Aktif' : 'Tidak Aktif'}}</td>
                                        <td>{{$menurole->created_at}}</td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="green" href="{{ url('/menurole')}}/{{$menurole->menurole_id}}/edit"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                                                                               
                                                <form action="{{ url('/menurole')}}/{{$menurole->menurole_id}}" method="post" class="inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="red btn-link" >
                                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                    </button>
                                                </form>
                                                
                                            </div>                                                
                                        </td>
                                </tr>
                                @endforeach
                        </tbody>
                </table>
	</div> <!-- end col -->
</div> <!-- end row -->	
@endsection


@push('scripts')
<!-- ace scripts -->
<!-- page specific plugin scripts -->
<script>
jQuery(function($) {
    $("#hapus-data").on(ace.click_event, function() {
        bootbox.confirm("Are you sure?", function(result) {
            if(result) {
                    //
            }
        });
    });
    
    //$( "#hapus-data" ).click(function() {
    //    alert( "Handler for .click() called." );
    //});
});
</script>
@endpush