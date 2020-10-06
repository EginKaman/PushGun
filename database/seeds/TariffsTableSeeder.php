<?php

use Illuminate\Database\Seeder;
use App\Tariff;

class TariffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tariff::create([
            'name' => 'Базовый',
            'max_followers' => 1000
        ]);
        Tariff::create([
            'name' => 'PRO 30K',
            'price_per_month' => 3900,
            'price_per_year' => 37440,
            'max_followers' => 30000
        ]);
        Tariff::create([
            'name' => 'PRO 60K',
            'price_per_month' => 6000,
            'price_per_year' => 57600,
            'max_followers' => 60000
        ]);
        Tariff::create([
            'name' => 'PRO 200K',
            'price_per_month' => 10000,
            'price_per_year' => 96000,
            'max_followers' => 200000
        ]);
        Tariff::create([
            'name' => 'PRO 200K',
            'price_per_month' => 40000,
            'price_per_year' => 384000,
            'max_followers' => 0
        ]);
    }
}
