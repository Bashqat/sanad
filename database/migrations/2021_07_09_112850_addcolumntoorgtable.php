<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addcolumntoorgtable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisations', function($table) {
            $table->string('email');
            $table->string('display_name');
            $table->string('legal_name');
            $table->string('type_of_organization');
            $table->string('type_of_business');
            $table->string('business_registration_number');
            $table->string('location');
            $table->string('address');
            $table->string('phone');
            $table->string('fax');
            $table->string('mobile');
            $table->string('website');
            $table->string('currency');
            $table->string('user_defined');
            $table->string('current_date_utc_format');
            $table->enum('status', ['active', 'not-active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisations', function($table) {
            $table->dropColumn('email');
            $table->dropColumn('display_name');
            $table->dropColumn('legal_name');
            $table->dropColumn('type_of_organization');
            $table->dropColumn('type_of_business');
            $table->dropColumn('business_registration_number');
            $table->dropColumn('location');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('fax');
            $table->dropColumn('mobile');
            $table->dropColumn('website');
            $table->dropColumn('currency');
            $table->dropColumn('user_defined');
            $table->dropColumn('status');
            $table->dropColumn('current_date_utc_format');
        });
    }
}
