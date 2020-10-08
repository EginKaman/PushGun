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
            $table->foreignId('tariff_id')->constrained();
            $table->unsignedBigInteger('transaction_id');
            $table->string('invoice_id')->nullable();
            $table->float('amount');
            $table->string('currency')->default('RUB');
            $table->string('operation_type')->nullable();
            $table->unsignedInteger('card_first_six');
            $table->unsignedInteger('card_last_four');
            $table->string('card_exp_date');
            $table->string('card_type');
            $table->string('status');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('description')->nullable();
            $table->json('data')->nullable();
            $table->string('token');
            $table->string('total_fee')->nullable();
            $table->string('card_product')->nullable();
            $table->string('payment_method')->nullable();
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
