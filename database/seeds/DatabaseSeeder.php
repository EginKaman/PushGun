<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(TariffsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(AutoMailingStatusesTableSeeder::class);
        $this->call(TimeSeeder::class);
        $this->call(BonusPercentSeeder::class);
    }
}
