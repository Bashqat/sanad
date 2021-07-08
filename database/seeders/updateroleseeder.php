<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class updateroleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('role', 'master')->update(['role' => '1']);
        DB::table('users')->where('role', 'superadmin')->update(['role' => '2']);
    }
}
