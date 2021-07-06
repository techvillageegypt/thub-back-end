<?php

namespace Database\Seeders;


use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'logo' => 'logo.jpg',
                'en' => [
                    'text' => 'brand 1',
                ],
                'ar' => [
                    'text' => 'brand 1',
                ],
            ],
            [
                'logo' => 'logo.jpg',
                'en' => [
                    'text' => 'brand 2',
                ],
                'ar' => [
                    'text' => 'brand 2',
                ],
            ],
            [
                'logo' => 'logo.jpg',
                'en' => [
                    'text' => 'brand 3',
                ],
                'ar' => [
                    'text' => 'brand 3',
                ],
            ],

        ];


        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
