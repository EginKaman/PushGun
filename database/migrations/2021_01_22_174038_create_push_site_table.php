<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_site', function (Blueprint $table) {
            $table->foreignId('push_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
        \App\Push::all()->each(function ($push) {
            $push->sites()->attach([
                'site_id' => $push->site_id
            ]);
        });
        Schema::table('pushes', function (Blueprint $table) {
            $table->dropForeign(['push_id']);
            $table->dropColumn('push_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pushes', function (Blueprint $table) {
            $table->foreignId('site_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate()->after('user_id');
        });
        \App\Push::with('sites')->get()->each(function ($push) {
            $push->site()->associate($push->sites->first()->id);
            $push->save();
        });
        Schema::dropIfExists('push_site');
    }
}
