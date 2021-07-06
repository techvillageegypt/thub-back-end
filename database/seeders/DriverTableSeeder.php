<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Driver::create([
            'name'                          => 'Abbas',
            'company_id'                    => 1,
            'phone'                         => '01077777777',
            'address'                       => 'Egypt, Cairo',
            'photo'                         => 'avatar.png',
            'email'                         => 'driver@email.com',
            'email_verified_at'             => now(),
            'medical_report'                => 'medical_report.jpg',
            'front_identity_card'           => 'front_identity_card.jpg',
            'back_identity_card'            => 'back_identity_card.jpg',
            'police_clearance_certificate'  => 'police_clearance_certificate.jpg',
            'front_driver_licence'          => 'front_driver_licence.jpg',
            'back_driver_licence'           => 'back_driver_licence.jpg',
            'status'                        => 2,

        ]);

        Driver::create([
            'name'                          => 'Mohsen',
            'phone'                         => '01055555555',
            'address'                       => 'Egypt, Cairo',
            'photo'                         => 'avatar.png',
            'email'                         => 'driver2@email.com',
            'email_verified_at'             => now(),
            'medical_report'                => 'medical_report.jpg',
            'front_identity_card'           => 'front_identity_card.jpg',
            'back_identity_card'            => 'back_identity_card.jpg',
            'police_clearance_certificate'  => 'police_clearance_certificate.jpg',
            'front_driver_licence'          => 'front_driver_licence.jpg',
            'back_driver_licence'           => 'back_driver_licence.jpg',
            'status'                        => 2,

        ]);
    }
}
