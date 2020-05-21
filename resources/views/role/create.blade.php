@extends('layout.main')

@push('styles')
 <!-- page specific plugin style -->
@endpush

@section('breadcrumb','Master Role')
@section('subBreadcrumb','Tambah Master Role')
@section('link','role')
@section('title','Tambah Master Role')
@section('subTitle','Merupakan halaman tambah role dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
                
            <form method="post" action="{{url('/role')}}">
                        @csrf
                        <div class="form-group @error('role_nama') has-error @enderror">
                                <label for="form-role_nama">Nama Role *</label>
                                <input type="text" class="form-control" name='role_nama' id="form-role_nama" value="{{old('role_nama')}}">
                                @error('role_nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group">
                                <label for="form-role_keterangan">Keterangan</label>
                                <input type="text" class="form-control" name='role_keterangan' id="form-role_keterangan" value="{{old('role_keterangan')}}">
                        </div>
                        <div class="form-group">
                            <label for="form-menu_status">Status</label>
                                <!--<input type="text" class="form-control" name='menu_status' id="form-menu_status" value="{{old('menu_status')}}">-->
                                <select class="form-control" name='role_status' id="form-role_status">
                                    <option  value="">Silakan Pilih</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Simpan</button>
                            <button class="btn btn-sm btn-primary" type="reset" class="btn btn-primary">Reset</button>
                            <a href="{{ url('/role') }}" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                </form>
        </div> <!-- end col -->
</div> <!-- end row -->
@endsection


@push('scripts') 
<!-- page specific plugin scripts -->
@endpush