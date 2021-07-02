<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id');
            $table->integer('superadmin_id');
            $table->integer('package_price');
            $table->longtext('package_detail');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('trial_end_date');
            $table->string('payment_transaction_id');
            $table->string('status');
            $table->timestamps();
            $table->date('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
