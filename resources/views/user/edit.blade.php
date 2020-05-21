@extends('layout.main')

@push('styles')
 
@endpush

@section('breadcrumb','Menu User')
@section('subBreadcrumb','Ubah Menu User')
@section('link','user')
@section('title','Ubah Menu User')
@section('subTitle','Merupakan halaman ubah menu user dalam sistem')

@section('container')
<div class="row">
        <div class="col-xs-9 col-sm-9">
                
            <form method="post" action="{{url('/user')}}/{{$users->id}}">
                        @method('patch')
                        @csrf
                        <div class="form-group @error('username') has-error @enderror">
                                <label for="form-username">Username *</label>
                                <input type="text" class="form-control" name='username' id="form-username" value="{{$users->username}}">
                                @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group @error('name') has-error @enderror">
                                <label for="form-name">Nama *</label>
                                <input type="text" class="form-control" name='name' id="form-name" value="{{$users->name}}">
                                @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                                <label for="form-email">Email *</label>
                                <input type="text" class="form-control" name='email' id="form-email" value="{{$users->email}}">
                                @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" class="btn btn-primary">Ubah</button>
                            <a href="{{ url('/user') }}" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                </form>
        </div> <!-- end col -->
</div> <!-- end row -->
@endsection


@push('scripts') 
<!-- page specific plugin scripts -->
@endpush