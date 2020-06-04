<?php

namespace App\http\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = "ms_pelanggan";
    protected $primaryKey = "pelangganid";
    public $incrementing = false;
}
