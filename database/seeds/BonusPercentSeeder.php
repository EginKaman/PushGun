<?php

use App\BonusPercent;
use Illuminate\Database\Seeder;

class BonusPercentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BonusPercent::create([
            'percent'=>5
        ]);
    }
}
