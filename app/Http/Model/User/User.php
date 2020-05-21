<?php

namespace App\Http\Model\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $table = "users";
    protected $fillable = ['username', 'name', 'email'];
}
