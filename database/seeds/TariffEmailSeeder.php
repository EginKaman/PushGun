<?php

use App\TariffEmail;
use Illuminate\Database\Seeder;

class TariffEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TariffEmail::create([
            'name' => 'Подписка 1000',
            'price_per_month' => 0,
            'price_per_year' => 0,
            'max_contacts' => 1000
        ]);
        TariffEmail::create([
            'name' => 'PRO 2500',
            'price_per_month' => 1000,
            'price_per_year' => 9600,
            'max_contacts' => 2500
        ]);
        TariffEmail::create([
            'name' => 'PRO 10K',
            'price_per_month' => 2500,
            'price_per_year' => 24000,
            'max_contacts' => 10000
        ]);
    }
}
