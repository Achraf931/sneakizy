<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ImageTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
    }
}
