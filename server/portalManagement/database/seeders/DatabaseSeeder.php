<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // CompanyTypes::createMany([
        //     ['name' => 'Main'],
        //     ['name' => 'Sub'],
        // ]);

        Company::factory(1)->create();
    }
}
