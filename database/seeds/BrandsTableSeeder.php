<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++)
        {
            $brand = new \App\Brand();
            $brand->name = $faker->firstName();
            $brand->image = $faker->imageUrl();
            $brand->save();
        }
    }
}
