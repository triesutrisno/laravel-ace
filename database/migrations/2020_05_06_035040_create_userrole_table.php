<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userrole', function (Blueprint $table) {
            $table->bigIncrements('userrole_id');
            $table->string('username',50);
            $table->string('role_nama',50);
            $table->string('userrole_status',2)->nullable();
            $table->timestamps();
        });
        
        /**
         * 
        Schema::table('userrole', function(Blueprint $table)
        {
            //$table->foreign('user_id', 'addresses_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('userid')->references('id')->on('users');
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
        Schema::dropIfExists('userrole');
    }
}
