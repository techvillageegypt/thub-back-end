<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ([
            [
                'en' => ['name' => 'Abu Dhabi'],
                'ar' => ['name' => 'Abu Dhabi'],
            ],
            [
                'en' => ['name' => 'Ajman'],
                'ar' => ['name' => 'Ajman'],
            ],
            [
                'en' => ['name' => 'Dubai'],
                'ar' => ['name' => 'Dubai'],
            ],
            [
                'en' => ['name' => 'Fujairah'],
                'ar' => ['name' => 'Fujairah'],
            ],
            [
                'en' => ['name' => 'Ras al-Khaimah'],
                'ar' => ['name' => 'Ras al-Khaimah'],
            ],
            [
                'en' => ['name' => 'Sharjah'],
                'ar' => ['name' => 'Sharjah'],
            ],
            [
                'en' => ['name' => 'Umm al-Quwain'],
                'ar' => ['name' => 'Umm al-Quwain'],
            ],
        ]);


        foreach ($states as $state) {
            State::create($state);
        }
    }
}
