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
            'name' => 'Подписка 1000',
            'max_followers' => 1000
        ]);
        Tariff::create([
            'name' => 'PRO 30K',
            'price_per_month' => 5,
            'price_per_year' => 5,
            'max_followers' => 30000
        ]);
        Tariff::create([
            'name' => 'PRO 60K',
            'price_per_month' => 5,
            'price_per_year' => 5,
            'max_followers' => 60000
        ]);
        Tariff::create([
            'name' => 'PRO 200K',
            'price_per_month' => 10,
            'price_per_year' => 10,
            'max_followers' => 200000
        ]);
        Tariff::create([
            'name' => 'PRO 200K',
            'price_per_month' => 5,
            'price_per_year' => 5,
            'max_followers' => 0
        ]);
    }
}
