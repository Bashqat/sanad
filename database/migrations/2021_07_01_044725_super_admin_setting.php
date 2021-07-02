<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuperAdminSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admin_setting', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('superadmin_id');
            $table->string('pin');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidß
     */
    public function down()
    {
        Schema::dropIfExists('super_admin_setting');
    }
}
