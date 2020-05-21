@extends('layout.main')

@push('styles')
 <!-- page specific plugin style -->
@endpush

@section('breadcrumb','Master Menu')
@section('subBreadcrumb','Tambah Master Menu')
@section('link','menu')
@section('title','Tambah Master Menu')
@section('subTitle','Merupakan halaman tambah menu dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
                
            <form method="post" action="{{url('/menu')}}">
                        @csrf
                        <div class="form-group @error('menu_nama') has-error @enderror">
                                <label for="form-menu_nama">Nama Menu *</label>
                                <input type="text" class="form-control" name='menu_nama' id="form-menu_nama" value="{{old('menu_nama')}}">
                                @error('menu_nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                                <label for="form-menu_link">Link</label>
                                <input type="text" class="form-control" name='menu_link' id="form-menu_link" value="{{old('menu_link')}}">                                        
                        </div>					
                        <div class="form-group">
                                <label for="form-menu_keterangan">Keterangan</label>
                                <input type="text" class="form-control" name='menu_keterangan' id="form-menu_keterangan" value="{{old('menu_keterangan')}}">
                        </div>					
                        <div class="form-group">
                                <label for="form-menu_parent">Parent</label>
                                <!--<input type="text" class="form-control" name='menu_parent' id="form-menu_parent" value="{{old('menu_parent')}}">-->
                                <select class="form-control" name='menu_parent' id="form-menu_parent">
                                    <option value="">Silakan Pilih</option>
                                    @foreach($menus as $menu)
                                        <option value="{{$menu->menu_id}}">{{$menu->menu_nama}}</option>
                                    @endforeach                                    
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="form-menu_type">Jenis</label>
                                <select class="form-control" name='menu_type' id="form-menu_type">
                                    <option  value="">Silakan Pilih</option>
                                    <option value="1">Root</option>
                                    <option value="2">Level 1</option>
                                    <option value="3">Level 2</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="form-menu_status">Status</label>
                                <!--<input type="text" class="form-control" name='menu_status' id="form-menu_status" value="{{old('menu_status')}}">-->
                                <select class="form-control" name='menu_status' id="form-menu_status">
                                    <option  value="">Silakan Pilih</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="form-menu_sort">Urutan</label>
                                <input type="text" class="form-control" name='menu_sort' id="form-menu_sort" value="{{old('menu_sort')}}">
                        </div>	

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Simpan</button>
                            <button class="btn btn-sm btn-primary" type="reset" class="btn btn-primary">Reset</button>
                            <a href="{{ url('/menu') }}" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                </form>
        </div> <!-- end col -->
</div> <!-- end row -->
@endsection


@push('scripts') 
<!-- page specific plugin scripts -->
@endpush