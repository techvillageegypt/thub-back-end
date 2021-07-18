<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\DonationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donationTypes = ([
            [
                'icon' => 'icon.png',
                'en' => ['name' => 'Furniture'],
                'ar' => ['name' => 'Furniture'],
            ],
            [
                'icon' => 'icon.png',
                'en' => ['name' => 'Cars'],
                'ar' => ['name' => 'Cars'],
            ],
            [
                'icon' => 'icon.png',
                'en' => ['name' => 'Clothes'],
                'ar' => ['name' => 'Clothes'],
            ],
            [
                'icon' => 'icon.png',
                'en' => ['name' => 'Jewelry'],
                'ar' => ['name' => 'Jewelry'],
            ],
            [
                'icon' => 'icon.png',
                'en' => ['name' => 'Watches'],
                'ar' => ['name' => 'Watches'],
            ],

        ]);


        foreach ($donationTypes as $donationTypes) {
            DonationType::create($donationTypes);
        }
    }
}
