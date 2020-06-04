<?php

namespace App\http\Model\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detailpenjualan extends Model
{
    protected $table = "tr_jual";
    protected $primaryKey = "jualid";
    public $incrementing = false;

    public function cabang(){
        return $this->hasMany('Cabang');
    }
}
