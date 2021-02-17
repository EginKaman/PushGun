<?php

use Illuminate\Database\Seeder;
use App\Time;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Time::create([
            'title'=>'minute'
        ]);
        Time::create([
            'title'=>'hours'
        ]);
        Time::create([
            'title'=>'days'
        ]);
    }
}
