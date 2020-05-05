@extends('layout.main')

@section('container')
	<div class="container">
		<div class="row">
			<div class="col-6">
				<h1 class="mt-3">Detail Students</h1>

				<div class="card" style="width: 18rem;">
				  <div class="card-body">
					<h5 class="card-title">{{$mahasiswa->mhs_nama}}</h5>
					<h6 class="card-subtitle mb-2 text-muted">{{$mahasiswa->mhs_nim}}</h6>
					<p class="card-text">{{$mahasiswa->mhs_email}}</p>
					<p class="card-text">{{$mahasiswa->mhs_jurusan}}</p>
					<button type="submit" class="btn btn-primary">Ubah</button>
					<form action="{{$mahasiswa->mhs_id}}" method="post" class="d-inline">
						@method('delete')
						@csrf
						<button type="submit" class="btn btn-danger">Hapus</button>
					</form>
					<a href="{{url('/students')}}" class="btn btn-info">Kembali</a>
				  </div>
				</div>
			<div>
		</div>
	</div>
@endsection