<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $images = ['1','2','3','4'];
    return [
      //
      'cover_image' => fake()->randomElement($images) . '.webp',
      'title' => fake()->sentence(),
      'quality' => fake()->randomElement(['new', 'used']),
      'mileage' => fn(array $attributes) => $attributes['quality'] == 'used' ? fake()->numberBetween(5000, 200000) : 0,
      'vin' => strtoupper(Str::random(17)),
      'price' => fake()->numberBetween(10000, 50000),
      'currency' => 'rwf',
      'images' => array_map(fn($image) => $image . '.webp', $images),
      'quantity' => 1, 
      'is_negotiable' => fake()->boolean(), 
      'is_available' => 1,
    ];
  }
}
