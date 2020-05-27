<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menurole', function (Blueprint $table) {
            $table->bigIncrements('menurole_id');
            $table->smallInteger('menu_id');
            $table->string('role_nama',50);
            $table->string('menurole_status',2)->nullable();
            $table->timestamps();
            
            
        });
        
        /**
         * 
        Schema::table('menurole', function(Blueprint $table)
        {
            //$table->foreign('user_id', 'addresses_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('menuid')->references('menuid')->on('menu');
            $table->foreign('role_nama')->references('role_nama')->on('role');
        });
         * 
         */
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menurole');
    }
}
