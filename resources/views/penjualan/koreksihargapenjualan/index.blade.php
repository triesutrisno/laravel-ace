@extends('layout.main')

@push('styles')
<!-- page specific plugin style -->
@endpush

@section('breadcrumb','Koreksi Harga Jual')
@section('title','Laporan Koreksi')
@section('subTitle','Merupakan Laporan Koreksi Harga Penjualan')

@section('container')
{{$data}}
@endsection