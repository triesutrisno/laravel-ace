<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = "users";
    # $primaryKey = "userId";
    protected $fillable = ['username', 'password'];
}
