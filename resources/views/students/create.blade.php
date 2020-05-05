@extends('layout.main')

@section('breadcrumb','Students')

@section('title','Add Student')
@section('subTitle','This is add student menu')

@section('container')
	<div class="container">
		<div class="row">
				
				<form method="post" action="{{url('/students')}}">
					@csrf
					<div class="form-group">
						<label for="form-mhs_nim">NIM</label>
						<input type="text" class="form-control @error('mhs_nim') is-invalid @enderror" name='mhs_nim' id="form-mhs_nim" value="{{old('mhs_nim')}}" placeholder="NIM">
						@error('mhs_nim')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label for="form-mhs_nama">Nama Mahasiswa</label>
						<input type="text" class="form-control @error('mhs_nama') is-invalid @enderror" name='mhs_nama' id="form-mhs_nama" value="{{old('mhs_nama')}}" placeholder="Nama Mahasiswa">
						@error('mhs_nama')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>					
					<div class="form-group">
						<label for="form-mhs_email">Email</label>
						<input type="text" class="form-control" name='mhs_email' id="form-mhs_email" value="{{old('mhs_email')}}" placeholder="Email">
					</div>					
					<div class="form-group">
						<label for="form-mhs_jurusan">Jurusan</label>
						<input type="text" class="form-control" name='mhs_jurusan' id="form-mhs_jurusan" value="{{old('mhs_jurusan')}}" placeholder="Jurusan">
					</div>	
					<button type="submit" class="btn btn-primary">Simpan</button>
				</form>
				
			<div>
		</div>
	</div>
@endsection