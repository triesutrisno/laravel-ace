<?php

namespace App\Http\Model\Userrole;

use Illuminate\Database\Eloquent\Model;

class Userrole extends Model
{
    protected $table = "userrole";
    protected $primaryKey = "userrole_id";
    public $incrementing = false;
    protected $fillable = ['username','role_nama', 'userrole_status'];
}
