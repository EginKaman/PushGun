<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Department::create([
            'title' => 'Техническая поддержка'
        ]);
        \App\Department::create([
            'title' => 'Отдел продаж'
        ]);
    }
}
