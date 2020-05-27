@extends('layout.main')

@push('styles')
 <!-- page specific plugin style -->
@endpush

@section('breadcrumb','User Role')
@section('subBreadcrumb','Tambah User Role')
@section('link','userrole')
@section('title','Tambah User Role')
@section('subTitle','Merupakan halaman tambah user role dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
            <form method="post" action="{{url('/userrole')}}">
                        @csrf                        
                        <div class="form-group @error('username') has-error @enderror">
                                <label for="form-username">Username *</label>
                                <!--<input type="text" class="form-control" name='menu_id' id="form-role_nama" value="{{old('menu_id')}}">-->
                                <select class="form-control" name='username' id="form-username">
                                    <option value="">Silakan Pilih</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->username}}">{{$user->name}}</option>
                                    @endforeach                                    
                                </select>
                                @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group @error('role_nama') has-error @enderror">
                                <label for="form-role_nama">Nama Role *</label>
                                <!--<input type="text" class="form-control" name='role_nama' id="form-role_nama" value="{{old('role_nama')}}">-->
                                <select class="form-control" name='role_nama' id="form-role_nama">
                                    <option value="">Silakan Pilih</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->role_nama}}">{{$role->role_nama}}</option>
                                    @endforeach                                    
                                </select>
                                @error('role_nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="form-role_status">Status</label>
                                <!--<input type="text" class="form-control" name='menu_status' id="form-menu_status" value="{{old('menu_status')}}">-->
                                <select class="form-control" name='userrole_status' id="form-userrole_status">
                                    <option  value="">Silakan Pilih</option>
                                    <option value="1">Aktif</option>
                                    <option value="2" >Tidak Aktif</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Simpan</button>
                            <button class="btn btn-sm btn-primary" type="reset" class="btn btn-primary">Reset</button>
                            <a href="{{ url('/userrole') }}" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                </form>
        </div> <!-- end col -->
</div> <!-- end row -->
@endsection


@push('scripts') 
<!-- page specific plugin scripts -->
@endpush