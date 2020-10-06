<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('link');
            $table->string('image')->nullable();
            $table->boolean('installed')->default(false);
            $table->enum('request', ['visit', 'click', 'intermediate'])->default('visit');
            $table->boolean('hint')->default(false);
            $table->unsignedSmallInteger('delay')->default(0);
            $table->boolean('mobile')->default(false);
            $table->string('script');
            $table->softDeletes();
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
        Schema::dropIfExists('sites');
    }
}
