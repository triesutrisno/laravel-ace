<?php

namespace App\http\Model\Penjualan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detailpenjualan extends Model
{
    // use SoftDeletes;
    protected $table = "tr_jual";
    protected $primaryKey = "jualid";
    public $incrementing = false;
}
