@extends('layout.main')

@push('styles')
 
@endpush

@section('breadcrumb','Master Menu')
@section('subBreadcrumb','Ubah Master Menu')
@section('link','menu')
@section('title','Ubah Master Menu')
@section('subTitle','Merupakan halaman ubah menu dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
                
            <form method="post" action="{{url('/menu')}}/{{$menu->menu_id}}">
                        @method('patch')
                        @csrf
                        <div class="form-group @error('menu_nama') has-error @enderror">
                                <label for="form-menu_nama">Nama Menu *</label>
                                <input type="text" class="form-control" name='menu_nama' id="form-menu_nama" value="{{$menu->menu_nama}}">
                                @error('menu_nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                                <label for="form-menu_link">Link</label>
                                <input type="text" class="form-control" name='menu_link' id="form-menu_link" value="{{$menu->menu_link}}">                                        
                        </div>					
                        <div class="form-group">
                                <label for="form-menu_keterangan">Keterangan</label>
                                <input type="text" class="form-control" name='menu_keterangan' id="form-menu_keterangan" value="{{$menu->menu_keterangan}}">
                        </div>					
                        <div class="form-group">
                                <label for="form-menu_parent">Parent</label>
                                <!--<input type="text" class="form-control" name='menu_parent' id="form-menu_parent" value="{{old('menu_parent')}}">-->
                                <select class="form-control" name='menu_parent' id="form-menu_parent">
                                    <option value="">Silakan Pilih</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->menu_id}}" @if($menu->menu_parent == $parent->menu_id) Selected @endif>{{$parent->menu_nama}}</option>
                                    @endforeach                                    
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="form-menu_type">Jenis</label>
                                <select class="form-control" name='menu_type' id="form-menu_type">
                                    <option  value="">Silakan Pilih</option>
                                    <option value="1" @if($menu->menu_type == "1") Selected @endif>Root</option>
                                    <option value="2" @if($menu->menu_type == "2") Selected @endif>Level 1</option>
                                    <option value="3" @if($menu->menu_type == "3") Selected @endif>Level 2</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="form-menu_status">Status</label>
                                <!--<input type="text" class="form-control" name='menu_status' id="form-menu_status" value="{{old('menu_status')}}">-->
                                <select class="form-control" name='menu_status' id="form-menu_status">
                                    <option  value="">Silakan Pilih</option>
                                    <option value="1" @if($menu->menu_status == "1") Selected @endif>Aktif</option>
                                    <option value="2" @if($menu->menu_status == "2") Selected @endif>Tidak Aktif</option>
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="form-menu_sort">Urutan</label>
                                <input type="text" class="form-control" name='menu_sort' id="form-menu_sort" value="{{$menu->menu_sort}}">
                        </div>	

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Ubah</button>
                            <a href="{{ url('/menu') }}" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                </form>
        </div> <!-- end col -->
</div> <!-- end row -->
@endsection


@push('scripts') 
<!-- page specific plugin scripts -->
@endpush