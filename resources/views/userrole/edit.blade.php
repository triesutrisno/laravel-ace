@extends('layout.main')

@push('styles')
 
@endpush

@section('breadcrumb','User Role')
@section('subBreadcrumb','Ubah User Role')
@section('link','userrole')
@section('title','Ubah User Role')
@section('subTitle','Merupakan halaman ubah user role dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
                
            <form method="post" action="{{url('/userrole')}}/{{$userroles->userrole_id}}">
                        @method('patch')
                        @csrf
                        <div class="form-group @error('username') has-error @enderror">
                                <label for="form-username">Username *</label>
                                <input type="hidden" class="form-control" name='username' id="form-role_nama" value="{{$userroles->username}}">
                                <select class="form-control" name='username2' id="form-username2" disabled="true">
                                    <option value="">Silakan Pilih</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->username}}" @if($user->username == $userroles->username) Selected @endif>{{$user->name}}</option>
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
                                        <option value="{{$role->role_nama}}" @if($role->role_nama == $userroles->role_nama) Selected @endif>{{$role->role_nama}}</option>
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
                                    <option value="1" @if($userroles->userrole_status == "1") Selected @endif>Aktif</option>
                                    <option value="2" @if($userroles->userrole_status == "2") Selected @endif>Tidak Aktif</option>
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