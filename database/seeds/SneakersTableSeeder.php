<?php

use Illuminate\Database\Seeder;

class SneakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++)
        {
            $sneaker = new \App\Sneaker();
            $sneaker->name = $faker->streetName;
            $sneaker->description = $faker->realText(150);
            $sneaker->price = 199;
            $sneaker->release_date = '2020-02-01';
            $sneaker->image = $faker->imageUrl();
            $sneaker->brand_id = mt_rand(1, 5);
            $sneaker->save();
        }
    }
}
