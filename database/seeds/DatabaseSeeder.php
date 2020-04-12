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
        $this->call(SneakersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
