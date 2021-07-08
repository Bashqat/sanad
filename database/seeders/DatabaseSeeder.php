<?php

namespace Database\Seeders;

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
        //$this->call(CurrenciesTableSeeder::class);
        $this->call(masteradmindata::class);
        $this->call(updateroleseeder::class);
        $this->call(roleSeeder::class);
    }
}
