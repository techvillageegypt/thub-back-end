<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->e164PhoneNumber,
            'photo' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'medical_report' => $this->faker->imageUrl(),
            'front_identity_card' => $this->faker->imageUrl(),
            'back_identity_card' => $this->faker->imageUrl(),
            'police_clearance_certificate' => $this->faker->imageUrl(),
            'front_driver_licence' => $this->faker->imageUrl(),
            'back_driver_licence' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
        ];
    }
}
