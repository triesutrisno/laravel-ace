@extends('layout.main')

@section('breadcrumb','Students')

@section('title','Student List')
@section('subTitle','This is student list menu')

@section('container')
	<div class="container">
		<div class="row">
		<div class="col-6">

			<a href="{{url('/students/create')}}" class="btn btn-primary">Tambah Data</a>
			<p></p>
			@if (session('pesan'))
				<div class="alert alert-success">
					{{ session('pesan') }}
				</div>
			@endif
			
			<ul class="list-group">
				@foreach($students as $stud)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						{{$stud->mhs_nama}}
						<a href="{{url('/students')}}/{{$stud->mhs_id}}" class="badge badge-info">Detail</a>
					</li>
				@endforeach
			</ul>

		</div>
	</div>
@endsection