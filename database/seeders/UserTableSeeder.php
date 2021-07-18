<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('customers')->insert([
            [
                'name'              => 'Ahmed',
            ],
            [
                'name'              => 'Nabil',
            ],
        ]);
        DB::table('users')->insert([
            [
                'phone'                     => '01077777777',
                'userable_id'               => 1,
                'userable_type'             => '\App\Models\Customer',
                'type'                      => 'customer',
            ],
            [
                'phone'             => '01055555555',
                'userable_id'               => 2,
                'userable_type'             => '\App\Models\Customer',
                'type'                      => 'customer',
            ],
        ]);
    }
}
