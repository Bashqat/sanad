<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddnullableMasterSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('master_admin_setting', function($table) {
                $table->string('business_name')->nullable()->change();
                $table->string('email')->nullable()->change();
                $table->string('currency')->nullable()->change();
                $table->string('address')->nullable()->change();
                $table->string('application_name')->nullable()->change();
                $table->string('application_title')->nullable()->change();
                $table->string('application_default_language')->nullable()->change();
                $table->string('smtp_email')->nullable()->change();
                $table->string('smtp_username')->nullable()->change();
                $table->string('smtp_password')->nullable()->change();
                $table->string('smtp_host')->nullable()->change();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('master_admin_setting', function($table) {
                $table->dropColumn('application_name');
                $table->dropColumn('application_title');
                $table->dropColumn('application_default_language');
                $table->dropColumn('smtp_email');
                $table->dropColumn('smtp_username');
                $table->dropColumn('smtp_password');
                $table->dropColumn('smtp_host');
             });
        
    }
}
