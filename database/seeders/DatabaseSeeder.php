<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Content;
use App\Models\Listing;
use App\Models\Type;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    Content::create([
      'hero_section_image' => 'hero.jpg',
      'hero_section_badge' => 'Modern car design',
      'hero_section_title' => 'Find your modern car',
      'hero_section_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, accusantium? Lorem
      ipsum, dolor sit amet consectetur adipisicing elit. Officiis veniam magni beatae animi distinctio
      nihil.',
    ]);

    User::create([
      'name' => 'Admin',
      'email' => 'admin@test.com',
      'password' => Hash::make('password'),
      'role' => 'admin'
    ]);


    User::factory()->count(50)->create();

    $types = ['Sedans', 'SUVs', 'Hatchbacks', 'Coupes', 'Convertibles', 'Pickup Trucks', 'Minivans', 'Electric Vehicles', 'Hybrid Cars', 'Luxury Cars'];

    foreach ($types as $key => $type) {
      Type::create(['name' => $type]);
    }


    $brands = [
      'BMW' => ['BMW 3 Series', 'BMW 5 Series', 'BMW 7 Series'],
      'Ford' => ['Ford F-150', 'Ford Mustang', 'Ford Explorer'],
      'Toyota' => ['Toyota Camry', 'Toyota Corolla', 'Toyota RAV4', 'Toyota Hilux', 'Toyota Land Cruiser'],
      'Mercedes Benz' => ['Mercedes Benz C-Class', 'Mercedes Benz E-Class'],
    ];

    foreach (array_keys($brands) as $key => $name) {
      /** @var Brand $brand */
      $brand = Brand::create(['name' => $name, 'image' => Str::slug($name) . '.png', 'is_featured' => fake()->boolean(60)]);
      foreach ($brands[$name] as $key => $model) {
        /** @var CarModel $model */
        $model = $brand->models()->create(['name' => $model]);
        $year = fake()->year();
        $car = Car::factory()->create([
          'car_model_id' => $model->id,
          'name' => $year.' '.$model->name,
          'brand_id' => $model->brand_id,
          'year' => $year,
          'image' => $model->brand->slug.'.jpg',
        ]);

        $car->types()->attach([1,2]);

        Listing::factory()->create(['car_id' => $car->id]);
      }
    }

    $features = [
      [
          'title' => 'Advanced Car Search',
          'description' => 'Easily search for cars by make, model, price range, mileage, and other customizable filters for a personalized browsing experience.'
      ],
      [
          'title' => 'Car Comparison Tool',
          'description' => 'Compare multiple cars side by side based on specifications, features, and prices to help buyers make informed decisions.'
      ],
      [
          'title' => 'Appointements',
          'description' => 'View dealership profiles, contact details, and customer reviews to find trustworthy dealerships and streamline the buying process.'
      ],
    ];  

    DB::table('features')->insert($features);
  }
}
