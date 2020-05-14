@extends('layout.main')

@section('breadcrumb','Master Menu')
@section('subBreadcrumb','Detail Master Menu')
@section('link','menu')
@section('title','Detail Master Menu')
@section('subTitle','Merupakan halaman detail menu dalam sistem')

@section('container')
<div class="row">
	<div class="col-xs-12 col-sm-12">
                <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                                <div class="profile-info-name"> Nama Menu </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $menu->menu_nama }}</span>
                                </div>
                        </div>

                        <div class="profile-info-row">
                                <div class="profile-info-name"> Link </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $menu->menu_link }}</span>
                                </div>
                        </div>

                        <div class="profile-info-row">
                                <div class="profile-info-name"> Keterangan </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $menu->menu_keterangan }}</span>
                                </div>
                        </div>
                    
                        <div class="profile-info-row">
                                <div class="profile-info-name"> Parent </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $parentDesc }}</span>
                                </div>
                        </div>

                        <div class="profile-info-row">
                                <div class="profile-info-name"> Jenis </div>

                                <div class="profile-info-value">
                                        <span class="editable">
                                            @if ($menu->menu_type=='1')
                                                Root
                                            @elseif($menu->menu_type=='2')
                                                Level 1
                                            @else 
                                                Level 2
                                            @endif
                                       </span>
                                </div>
                        </div>
                    
                        <div class="profile-info-row">
                                <div class="profile-info-name"> Status </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $menu->menu_status=='1' ? "Aktif" : "Tidak Aktif" }}</span>
                                </div>
                        </div>

                        <div class="profile-info-row">
                                <div class="profile-info-name"> Urut </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $menu->menu_sort }}</span>
                                </div>
                        </div>
                    
                        <div class="profile-info-row">
                                <div class="profile-info-name"> Crated At </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $menu->created_at }}</span>
                                </div>
                        </div>

                        <div class="profile-info-row">
                                <div class="profile-info-name"> Last Update </div>

                                <div class="profile-info-value">
                                        <span class="editable">{{ $menu->updated_at }}</span>
                                </div>
                        </div>
                </div>
	</div> <!-- end col -->
</div> <!-- end row -->	
@endsection