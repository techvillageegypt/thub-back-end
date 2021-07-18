<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'en'  => ['name' => 'Black'],
                'ar'  => ['name' => 'Black'],
                'hex' => '#000000'
            ],
            [
                'en'  => ['name' => 'Red'],
                'ar'  => ['name' => 'Red'],
                'hex' => '#FF0000'
            ],
            [
                'en'  => ['name' => 'White'],
                'ar'  => ['name' => 'White'],
                'hex' => '#FFFFFF'
            ],
            [
                'en'  => ['name' => 'Green'],
                'ar'  => ['name' => 'Green'],
                'hex' => '#00FF00'
            ],
            [
                'en'  => ['name' => 'Blue'],
                'ar'  => ['name' => 'Blue'],
                'hex' => '#0000FF'
            ],
            [
                'en'  => ['name' => 'Yellow'],
                'ar'  => ['name' => 'Yellow'],
                'hex' => '#FFFF00'
            ],
        ];
        $sizes = [
            [
                'en'  => ['name' => 'XS'],
                'ar'  => ['name' => 'XS'],
            ],
            [
                'en'  => ['name' => 'S'],
                'ar'  => ['name' => 'S'],
            ],
            [
                'en'  => ['name' => 'M'],
                'ar'  => ['name' => 'M'],
            ],
            [
                'en'  => ['name' => 'L'],
                'ar'  => ['name' => 'L'],
            ],
            [
                'en'  => ['name' => 'XL'],
                'ar'  => ['name' => 'XL'],
            ],
            [
                'en'  => ['name' => 'XXL'],
                'ar'  => ['name' => 'XXL'],
            ],
        ];


        foreach ($colors as $color) {
            Color::create($color);
        }
        foreach ($sizes as $size) {
            Size::create($size);
        }
    }
}
