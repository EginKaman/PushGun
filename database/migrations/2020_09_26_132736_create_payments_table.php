<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transaction_id');
            $table->float('amount', '8', '5');
            $table->string('currency')->default('RUB');
            $table->unsignedInteger('currency_code')->default(0);
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->json('json_data')->nullable();
            $table->ipAddress('ip_address');
            $table->string('name');
            $table->unsignedInteger('card_first_six');
            $table->unsignedInteger('card_last_four');
            $table->string('card_exp_date');
            $table->string('card_type');
            $table->unsignedInteger('card_type_code');
            $table->string('status');
            $table->unsignedInteger('status_code');
            $table->string('reason');
            $table->unsignedInteger('reason_code');
            $table->string('card_holder_message');

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
