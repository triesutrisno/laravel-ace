@extends('layout.main')

@push('styles')
 <!-- page specific plugin style -->
@endpush

@section('breadcrumb','Menu User')
@section('subBreadcrumb','Tambah Menu User')
@section('link','user')
@section('title','Tambah Menu User')
@section('subTitle','Merupakan halaman tambah menu user dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
                
            <form method="post" action="{{url('/user')}}">
                        @csrf
                        <div class="form-group @error('username') has-error @enderror">
                                <label for="form-username">Username *</label>
                                <input type="text" class="form-control" name='username' id="form-username" value="{{old('username')}}">
                                @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group @error('name') has-error @enderror">
                                <label for="form-name">Nama *</label>
                                <input type="text" class="form-control" name='name' id="form-name" value="{{old('name')}}">
                                @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                                <label for="form-email">Email *</label>
                                <input type="text" class="form-control" name='email' id="form-email" value="{{old('email')}}">
                                @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Simpan</button>
                            <button class="btn btn-sm btn-primary" type="reset" class="btn btn-primary">Reset</button>
                            <a href="{{ url('/user') }}" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                </form>
        </div> <!-- end col -->
</div> <!-- end row -->
@endsection


@push('scripts') 
<!-- page specific plugin scripts -->
@endpush