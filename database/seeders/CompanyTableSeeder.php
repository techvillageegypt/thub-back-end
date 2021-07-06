<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'company_name'          => 'Company',
            'name'                  => 'Company',
            'phone'                 => '01077777777',
            'email'                 => 'company@email.com',
            'email_verified_at'     => now(),
            'address'               => 'Egypt, Cairo',
            'logo'                  => 'logo.png',
            'commercial_register'   => 'commercial_register.jpg',
            'tax_identification'    => 'tax_identification.jpg',
            'identity_card'         => 'identity_card.jpg',
            'establishment_card'    => 'establishment_card.jpg',
            'status'                => 2,
        ]);

        Company::create([
            'company_name'          => 'Company 2',
            'name'                  => 'Company2',
            'phone'                 => '01055555555',
            'email'                 => 'company2@email.com',
            'email_verified_at'     => now(),
            'address'               => 'Egypt, Cairo',
            'logo'                  => 'logo.png',
            'commercial_register'   => 'commercial_register.jpg',
            'tax_identification'    => 'tax_identification.jpg',
            'identity_card'         => 'identity_card.jpg',
            'establishment_card'    => 'establishment_card.jpg',
            'status'                => 2,
        ]);
    }
}
