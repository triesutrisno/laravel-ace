<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAksesuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aksesuser', function (Blueprint $table) {
            $table->bigIncrements('akses_id');
            $table->smallInteger('menu_id');
            $table->string('username',50);
            $table->string('role_nama',50);
            $table->string('aksesuser_status',2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aksesuser');
    }
}
