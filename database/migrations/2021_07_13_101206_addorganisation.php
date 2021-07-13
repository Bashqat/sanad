<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addorganisation extends Migration
{
     public function up()
    {
        Schema::create('organisation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('org_db_name');
            $table->integer('superadmin_id');
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
        Schema::dropIfExists('organisation');
    }
}
