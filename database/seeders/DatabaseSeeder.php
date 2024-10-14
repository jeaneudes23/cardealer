<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Make;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
      'BMW' => ['BMW 3 Series', 'BMW 5 Series', 'BMW 7 Series', 'BMW X3', 'BMW X5', 'BMW X7', 'BMW i3', 'BMW i8', 'BMW M3', 'BMW Z4'],
      'Ford' => ['Ford F-150', 'Ford Mustang', 'Ford Explorer', 'Ford Escape', 'Ford Edge', 'Ford Fusion', 'Ford Ranger', 'Ford Bronco', 'Ford Transit', 'Ford Fiesta'],
      'Toyota' => ['Toyota Camry', 'Toyota Corolla', 'Toyota RAV4', 'Toyota Hilux', 'Toyota Land Cruiser', 'Toyota Prius', 'Toyota Tacoma', 'Toyota Avalon', 'Toyota 4Runner', 'Toyota Supra'],
      'Mercedes Benz' => ['Mercedes-Benz C-Class', 'Mercedes-Benz E-Class', 'Mercedes-Benz S-Class', 'Mercedes-Benz GLE', 'Mercedes-Benz GLC', 'Mercedes-Benz A-Class', 'Mercedes-Benz CLA', 'Mercedes-Benz G-Class', 'Mercedes-Benz EQC', 'Mercedes-Benz SL'],
    ];

    foreach (array_keys($makes) as $key => $make) {
      /** @var Make $newmake */
      $newMake = Make::create(['name' => $make,'image' => Str::slug($make).'.png',]);
      foreach ($makes[$make] as $key => $model) {
        $newMake->models()->create(['name' => $model]);
      }
    }

    $categories = ['Sedans','SUVs','Hatchbacks','Coupes','Convertibles','Pickup Trucks','Minivans','Electric Vehicles','Hybrid Cars', 'Luxury Cars'];
  
    foreach ($categories as $key => $category) {
      Category::create(['name' => $category]);
    }
  }
}
