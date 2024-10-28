<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
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

    User::create([
      'name' => 'Admin',
      'email' => 'admin@test.com',
      'password' => Hash::make('password'),
      'role' => 'admin'
    ]);

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
        $car = $model->cars()->create([
          'name' => $year.' '.$model->name,
          'summary' => fake()->paragraph(5),
          'overview' => <<<HTML
          <p>In the lineup of Audi sedans, the A6 sits in the middle as something of a happy medium. It’s larger than the <a href="https://www.truecar.com/audi/a4/">Audi A4</a> so there's more passenger space, but it's a bit smaller than the <a href="https://www.truecar.com/audi/a8/">Audi A8</a> and therefore more affordable. The A6 comes with a choice of an efficient turbocharged four-cylinder engine or a more powerful V6. Standard all-wheel drive makes the A6 well-suited to areas of inclement weather. Inside, it’s pure luxury with an elegant, refined design, plush seats, and a smooth, quiet ride. The Audi's standard infotainment features include a dual touchscreen system with a 10.1-inch primary display, and a 10-speaker audio system with Apple CarPlay and Android Auto smartphone integration. Standard advanced safety systems include a surround-view parking camera, adaptive cruise control, and lane-keeping assist.</p><p>Though both A6 engines provide plenty of power, the midsize Audi sedan is not as sporty as the <a href="https://www.truecar.com/bmw/5-series/">BMW 5 Series</a>, which has sharper steering for a more engaging and responsive feel. However, it’s right on par with other competitors including the <a href="https://www.truecar.com/lexus/es/">Lexus ES 350</a> and <a href="https://www.truecar.com/genesis/g80/">Genesis G80</a>. Both of those models carry a lower price than the A6, but the Lexus doesn’t provide the same level of cabin refinement. Also on the list of competitors is the <a href="https://www.truecar.com/cadillac/ct5-v/">Cadillac CT5-V</a>. It has a lower starting price and similarly upscale interior.</p><p>Positives</p><p>Beautiful and elegant interior. Two available engines. Ample safety features.</p><p>Considerations</p><p>Bland exterior design. Low cargo room. Challenging infotainment system.</p><p>Verdict</p><p>The Audi A6 is a luxury sedan with a beautiful interior, smooth ride, and abundance of advanced technologies. However it doesn’t have an especially sporty drive, which may be disappointing to drivers seeking a performance sedan.</p><h2>What's New for 2024</h2><p>The Audi A6 gets a minor refresh this year that includes a redesigned front grille and rear diffuser along with four new paint colors, four fresh wheel designs, and two dashboard inlay options. Matrix-design LED headlights are now standard, and remote start is available through the Audi connect app. Adaptive cruise assist is added to the Convenience package on the entry-level Premium model, and is standard on the rest of the lineup.</p><h2>Trims and Pricing</h2><p>The 2024 Audi A6 is available in three trims: Premium, Premium Plus, and Prestige. The Premium and Premium Plus models can be upgraded from the standard turbocharged four-cylinder engine to a V6 turbo.</p><p>The Premium Plus is the most popular among buyers, but we recommend the Premium. We'll explain why.</p><h3>Premium</h3><p>Starting at $58,395 (including a $1,095 destination fee), the Premium comes standard with a turbocharged four-cylinder engine, all-wheel drive, 19-inch wheels, LED headlights, S line exterior, three-zone climate control, leather upholstery, heated power-adjustable front seats, a panoramic sunroof, Audi's virtual cockpit display, and a dual touchscreen infotainment system with 10.1-inch primary display, navigation, Apple CarPlay and Android Auto smartphone integration, and a 10-speaker audio system.</p><p>Driver-assistance features include automatic emergency braking, lane-departure warning, and front and rear parking sensors.</p><p>The optional Convenience package adds a heated steering wheel, wireless charging pad, and a 360-degree camera, along with extra driver assists. Blind-spot warning watches for vehicles alongside, while lane-keeping assist will steer the A6 back into its lane if it detects a potential collision. Rear cross-traffic alert is also included. Adaptive cruise assist enhances adaptive cruise control by keeping the A6 centered in its lane and allowing limited intervals (up to 15 seconds) of hands-free driving in slow traffic conditions.</p><p>We recommend the Premium model since it includes enough features to make the A6 feel luxurious yet retains the four-cylinder engine for good fuel economy. You get more frills with the two upper trims, but the Premium is hardly a compromise.</p><h3>Premium Plus</h3><p>The Premium Plus starts at $61,895 and adds the Convenience package features along with a premium 16-speaker Bang &amp; Olufsen sound system. The optional Executive package adds a power trunk release, ventilated front seats, heated rear seats, four-zone climate control, and customizable cabin lighting.</p><h3>Prestige</h3><p>The Prestige trim starts at $71,995 and comes with a V6 engine, the Executive package, Audi-exclusive leather upholstery, and power soft-closing doors. Adaptive LED headlights (microscopic mirrors are used for more precise, focused micro-beams), a head-up display, and front cross-traffic alert expand the safety features. Also included is remote parking assist, a self-parking system for parallel or perpendicular spaces. The driver can initiate the action from inside the car, or outside using a smartphone app.</p><p>An optional Luxury package adds upgraded leather seating and leather-wrapped surfaces and massaging front seats.</p><p>A Black Optic package, available for all trims, adds 20-inch wheels, a sport suspension, and, on V6 models, gloss black trim.</p><h2>Engine and Performance</h2><p>The base engine in the 2024 Audi A6 is a 2.0-liter, turbocharged four-cylinder rated at 248 horsepower. It pairs with a seven-speed automatic transmission and Audi's Quattro all-wheel-drive system. The four-cylinder is smooth and satisfying, if not particularly eager. The 335-hp 3.0-liter V6 — standard on Prestige, optional on other trims — offers a more engaging experience. Audi says the six-cylinder-equipped A6 can dash from zero to 60 mph in 5.1 seconds.</p><p>There are faster sedans out there, but the A6 is quick and responsive with the V6. The suspension is precisely tuned yet never feels overly aggressive. It makes for a pleasant daily driver that can still hustle when pushed hard on a twisty road. The <a href="https://www.truecar.com/mercedes-benz/e-class/">Mercedes-Benz E-Class</a> sedan has a little more punch and an equally comfortable ride, while the <a href="https://www.truecar.com/genesis/g80/">Genesis G80</a> leans toward a softer overall feel.</p><h2>Fuel Economy</h2><p>The 2024 Audi A6 has not yet been rated for fuel economy by the Environmental Protection Agency, but should post numbers similar to the prior model year. The 2023 A6 was rated 24 mpg during city driving and 31 mpg on the highway. Equipped with the optional V6, estimates fall to 21/30 mpg city/highway. These ratings are similar to the all-wheel-drive <a href="https://www.truecar.com/genesis/g80/">Genesis G80</a> and lower than the <a href="https://www.truecar.com/bmw/5-series/">BMW 5 Series</a>, but better than the <a href="https://www.truecar.com/cadillac/ct5-v/">Cadillac CT5-V</a>.</p><h2>Interior</h2><p>The Audi A6's five-passenger cabin features comfortable seating and high-quality materials throughout. Passengers get plenty of elbow space, as well as leather upholstery and power-adjustable, heated front seats. A heated steering wheel, ventilated front seats, and heated rear seats are also available.</p><p>Rear-seat passenger space is typical of the segment: Comfortable for two adults and tight for three. The car's trunk, with 13.7 cubic feet of space, is average but better than the <a href="https://www.truecar.com/cadillac/ct5-v/">Cadillac CT5-V's</a> meager 11.9 cubic feet. The <a href="https://www.truecar.com/lexus/es/">Lexus ES 350</a> leads the segment with 17 cubic feet.</p><p>The Audi A6 is one of the few in its class to offer genuine leather upholstery in the base model. Some cars, such as the <a href="https://www.truecar.com/genesis/g80/">Genesis G80</a>, have more passenger space, but Audi's interior design feels more premium.</p><h2>Infotainment and Connectivity</h2><p>All 2024 Audi A6 models feature a 10.1-inch touchscreen infotainment display and Audi's virtual cockpit digital instrument panel. There's also a smaller 8.6-inch touchscreen situated below the infotainment display for controlling climate and assorted car functions. It's a bit of overkill, especially when some functions simply work better as buttons, but altogether, it gives the A6 the look and feel of a car ahead of its time. A 10-speaker audio system is standard on the entry-level Premium model, while the upper trims get a 16-speaker Bang &amp; Olufsen sound system. All models come with Apple CarPlay, Android Auto, satellite radio, HD Radio, navigation, wireless device charging, and a Wi-Fi hotspot.</p><p>The rival <a href="https://www.truecar.com/genesis/g80/">Genesis G80</a> comes with a 14.5-inch infotainment display that includes Apple CarPlay and Android Auto. The <a href="https://www.truecar.com/lexus/es/">Lexus ES 250</a> gets a standard 8-inch touchscreen or an optional 12.3-inch display with wireless Apple CarPlay and Android Auto.</p><h2>Safety</h2><p>The 2024 Audi A6 sedan received an overall five-star rating from the National Highway Traffic Safety Administration (<a href="https://www.nhtsa.gov/vehicle/2024/AUDI/A6%252520SEDAN/4%252520DR/AWD">NHTSA</a>) The Insurance Institute for Highway Safety (<a href="https://www.iihs.org/ratings/vehicle/audi/a6-4-door-sedan/2023">IIHS</a> has not yet officially rated the 2024 model year, but the 2023 Audi A6 received the agency's highest rating of Good in all six crash tests conducted.</p><p>All A6 models come with a long list of standard advanced safety features, including automatic emergency braking, lane-keeping assist, adaptive cruise control, parking sensors, and a surround-view parking camera. Traffic sign recognition and intersection assist are optional.</p><h2>Audi A6 vs. the Competition</h2><p>The 2024 A6 hits the sweet spot in Audi's car lineup. It's more practical than the compact <a href="https://www.truecar.com/audi/a4/">A4</a> and less expensive than the luxury-laden <a href="https://www.truecar.com/audi/a8/">A8</a>. It gets high marks in the competitive midsize luxury sedan market for its performance, refined cabin, and technology and safety features. If the A6's $58K starting price is too high, the <a href="https://www.truecar.com/genesis/g80/">Genesis G80</a> offers similar performance and features at a slightly lower price.</p><p>If price is less of a concern, the <a href="https://www.truecar.com/mercedes-benz/e-class/">Mercedes-Benz E-Class</a> offers an equally luxurious cabin and strong performance along with a long list of options. The <a href="https://www.truecar.com/cadillac/ct5-v/">Cadillac CT5-V</a> is another compelling option. It costs less than the A6 and features a powerful V6 and agile handling, although its cabin, while nice, isn't quite as refined as the Audi's.</p><p><a href="https://www.truecar.com/compare/audi-a6-vs-audi-a4/">Audi A6 vs. Audi A4</a></p><p><a href="https://www.truecar.com/compare/audi-a6-vs-audi-a8/">Audi A6 vs. Audi A8</a></p><p><a href="https://www.truecar.com/compare/audi-a6-vs-cadillac-ct5-v/">Audi A6 vs. Cadillac CT5-V</a></p><p><a href="https://www.truecar.com/compare/audi-a6-vs-genesis-g80/">Audi A6 vs. Genesis G80</a></p><p><a href="https://www.truecar.com/compare/audi-a6-vs-mercedes-benz-e-class/">Audi A6 vs. Mercedes-Benz E-Class</a></p><h2>TrueCar Expert Review Methodology</h2><p>TrueCar works with a select group of automotive industry experts who test-drive nearly 300 vehicles per year. TrueCar's experts grade the vehicles on key attributes including driving dynamics, comfort, interior design, technology, storage, and efficiency. Our experts also judge recent model updates, pricing and value, trims, options, comparable vehicles, and safety assessments (as provided by the NHTSA and IIHS) to inform their recommendations and help car shoppers choose a vehicle that is right for them.<br><br>TrueCar also ranks the best vehicles in each category based on a data-driven methodology. Each vehicle is carefully scored using our in-house rating system, which systematically evaluates every car, SUV, truck, and van. Utilizing ALG industry research, consumer surveys, a team of data scientists and vehicle experts, TrueCar provides a unique and useful outlook to help you find the best vehicle for your driving needs.</p><p><br></p>
          HTML
          ,
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
