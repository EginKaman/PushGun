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
            'name' => 'PRO',
            'price' => 1000,
            'max_followers' => 5000
        ]);
    }
}
