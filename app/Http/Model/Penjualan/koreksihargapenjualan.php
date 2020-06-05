<?php

namespace App\http\Model\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class koreksihargapenjualan extends Model
{
    protected $table = "tr_jual_koreksi_harga";
    protected $primaryKey = "koharid";
    public $incrementing = false;

    public function cabang(){
        return $this->hasMany('Cabang');
    }
}
