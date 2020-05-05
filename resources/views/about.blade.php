@extends('layout/main')

@section('breadcrumb','About')

@section('title','About')
@section('subTitle','Merupakan halaman about')

@section('container')
	<div class="row">
		<div class="col-xs-12">
			<h1 class="mt-3">Hallo, {{$nama}} !</h1>
		</div>
	</div>
@endsection