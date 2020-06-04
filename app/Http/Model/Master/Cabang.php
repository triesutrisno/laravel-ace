<?php

namespace App\http\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = "ms_cabang";
    protected $primaryKey = "cabangid";
    public $incrementing = false;

    public function detailpenjualan(){
        return $this->belongTo('Detailpenjualan');
    }
}
