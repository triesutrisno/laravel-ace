<?php

namespace App\Http\Model\Menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = "menu";
    protected $primaryKey = "menu_id";
    protected $fillable = ['menu_nama', 'menu_link', 'menu_keterangan', 'menu_parent', 'menu_status', 'menu_type', 'menu_sort'];
}
