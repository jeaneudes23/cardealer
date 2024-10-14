<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Make;
use App\Models\CarModel;
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

    User::create([
      'name' => 'Admin',
      'email' => 'admin@test.com',
      'password' => Hash::make('password'),
      'role' => 'admin'
    ]);


    $makes = [
      'BMW' => ['BMW 3 Series', 'BMW 5 Series', 'BMW 7 Series'],
      'Ford' => ['Ford F-150', 'Ford Mustang', 'Ford Explorer'],
      'Toyota' => ['Toyota Camry', 'Toyota Corolla', 'Toyota RAV4', 'Toyota Hilux', 'Toyota Land Cruiser'],
      'Mercedes Benz' => ['Mercedes Benz C-Class', 'Mercedes Benz E-Class'],
    ];

    foreach (array_keys($makes) as $key => $make) {
      /** @var Make $newmake */
      $newMake = Make::create(['name' => $make, 'image' => Str::slug($make) . '.png', 'is_featured' => fake()->boolean(60)]);
      foreach ($makes[$make] as $key => $model) {
        /** @var CarModel $model */
        $model = $newMake->models()->create(['name' => $model]);
        $year = fake()->year();
        $model->cars()->create([
          'name' => $year.' '.$model->make->name.' '.$model->name,
          'make_id' => $model->make_id,
          'year' => $year,
          'image' => $model->make->slug.'.jpg',
        ]);
      }
    }

    $categories = ['Sedans', 'SUVs', 'Hatchbacks', 'Coupes', 'Convertibles', 'Pickup Trucks', 'Minivans', 'Electric Vehicles', 'Hybrid Cars', 'Luxury Cars'];

    foreach ($categories as $key => $category) {
      Category::create(['name' => $category]);
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
