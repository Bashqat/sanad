<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentGateway extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateway', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('payment_mode');
            $table->string('sandbox_api_username');
            $table->string('sandbox_api_password');
            $table->string('sandbox_api_secret');
            $table->string('live_api_username');
            $table->string('live_api_password');
            $table->string('live_api_secret');
            $table->enum('status', [ 'active','unactive']);
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
        Schema::dropIfExists('payment_gateway');
    }
}
