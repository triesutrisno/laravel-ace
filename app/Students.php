<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = "mahasiswa";
	protected $primaryKey = "mhs_id";
	protected $fillable = ['mhs_nama', 'mhs_nim', 'mhs_email', 'mhs_jurusan'];

	/*
	public function attributes()
	{
		return [
			'mhs_nama' => 'Nama Mahasiswa',
		];
	}

	public function messages()
	{
		return [
			'mhs_nim.required' => 'NIM tidak boleh kosong !',
			'mhs_nama.required'  => 'Nama tidak boleh kosong',
		];
	}
	*/
}
