<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class masteradmindata extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "MasterAdmin",
            'email' => 'masteradmin@gmail.com',
            'password' => bcrypt('password'),
            'role'=>'master',
            ]);
    }
}
