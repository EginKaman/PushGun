<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailMailingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_mailings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('email_message_id')->constrained('email_messages');
            $table->foreignId('address_book_id')->constrained('address_books');
            $table->foreignId('email_sender_id')->constrained('email_senders');
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_confirmed')->default(false);
            $table->unsignedBigInteger('number_of_sent')->default(0);
            $table->unsignedBigInteger('number_of_not_sent')->default(0);
            $table->unsignedBigInteger('number_of_delivered')->default(0);
            $table->string('subject');
            $table->timestamp('date_send')->nullable();
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
        Schema::dropIfExists('email_mailings');
    }
}
