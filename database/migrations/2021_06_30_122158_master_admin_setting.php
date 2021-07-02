<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterAdminSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_admin_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name');
            $table->string('email');
            $table->string('currency');
            $table->string('address');
            $table->string('application_name');
            $table->string('application_title');
            $table->string('application_default_language');
            $table->string('smtp_email');
            $table->string('smtp_username');
            $table->string('smtp_password');
            $table->string('smtp_host');
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
        Schema::dropIfExists('master_admin_setting');
    }
}
