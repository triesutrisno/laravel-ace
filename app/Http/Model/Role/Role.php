<?php

namespace App\Http\Model\Role;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = "role";
    protected $primaryKey = "role_nama";
    public $incrementing = false;
    protected $fillable = ['role_nama', 'role_keterangan', 'role_status'];
}
