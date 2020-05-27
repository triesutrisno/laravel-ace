<?php

namespace App\Http\Model\aksesuser;

use Illuminate\Database\Eloquent\Model;

class Aksesuser extends Model
{
    protected $table = "aksesuser";
    protected $primaryKey = "aksesuser_id";
    public $incrementing = false;
    protected $fillable = ['username','role_nama', 'menu_id', 'aksesuser_status'];
}
