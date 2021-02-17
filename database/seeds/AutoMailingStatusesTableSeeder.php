<?php
use App\AutoMailingStatuses;
use Illuminate\Database\Seeder;

class AutoMailingStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AutoMailingStatuses::create([
            'title'=>'active',
        ]);
        AutoMailingStatuses::create([
            'title'=>'stopped',
        ]);
    }
}
