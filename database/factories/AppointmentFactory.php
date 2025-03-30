<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Customer;
use App\Models\SalesPerson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'customer_id' => Customer::first()->id,
            'car_id' => Car::inRandomOrder()->first()->id,
            'sales_person_id' => SalesPerson::inRandomOrder()->first()->id,
            'date' => fake()->dateTimeBetween('-6 months', '+2 weeks'),
            'status' => fake()->randomElement(['pending','scheduled', 'cancelled','completed'])
        ];
    }
}
