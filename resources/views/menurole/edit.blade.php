@extends('layout.main')

@push('styles')
 
@endpush

@section('breadcrumb','Menu Role')
@section('subBreadcrumb','Ubah Menu Role')
@section('link','menurole')
@section('title','Ubah Menu Role')
@section('subTitle','Merupakan halaman ubah menu role dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
                
            <form method="post" action="{{url('/menurole')}}/{{$menurole->menurole_id}}">
                        @method('patch')
                        @csrf
                        <div class="form-group @error('role_nama') has-error @enderror">
                                <label for="form-role_nama">Nama Role *</label>
                                <!--<input type="text" class="form-control" name='role_nama' id="form-role_nama" value="{{$menurole->role_nama}}">-->
                                <select class="form-control" name='role_nama' id="form-role_nama">
                                    <option value="">Silakan Pilih</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->role_nama}}" @if($role->role_nama == $menurole->role_nama) Selected @endif>{{$role->role_nama}}</option>
                                    @endforeach                                     
                                </select>
                                @error('role_nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group @error('menu_id') has-error @enderror">
                                <label for="form-role_nama">Nama Menu *</label>
                                <!--<input type="text" class="form-control" name='menu_id' id="form-role_nama" value="{{old('menu_id')}}">-->
                                <select class="form-control" name='menu_id' id="form-menu_parent">
                                    <option value="">Silakan Pilih</option>
                                    @foreach($menus as $menu)
                                        <option value="{{$menu->menu_id}}" @if($menu->menu_id == $menurole->menu_id) Selected @endif>{{$menu->menu_nama}}</option>
                                    @endforeach                                     
                                </select>
                                @error('menu_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="form-role_status">Status</label>
                                <!--<input type="text" class="form-control" name='menu_status' id="form-menu_status" value="{{old('menu_status')}}">-->
                                <select class="form-control" name='menurole_status' id="form-menurole_status">
                                    <option  value="">Silakan Pilih</option>
                                    <option value="1" @if($menurole->menurole_status == "1") Selected @endif>Aktif</option>
                                    <option value="2" @if($menurole->menurole_status == "2") Selected @endif>Tidak Aktif</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Ubah</button>
                            <a href="{{ url('/menurole') }}" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                </form>
        </div> <!-- end col -->
</div> <!-- end row -->
@endsection


@push('scripts') 
<!-- page specific plugin scripts -->
@endpush