<?php

use Illuminate\Database\Seeder;

class SneakersTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/sneakers.json');
        $data = json_decode($json);
        foreach ($data as $object)
        {
            $sneaker = new \App\Sneaker();
            $sneaker->name = $object->name;
            $sneaker->color = $object->color;
            $sneaker->description = $object->description;
            $sneaker->price = $object->price;
            $sneaker->release_date = $object->release_date;
            $sneaker->image = $object->image;
            $sneaker->brand = $object->brand;
            $sneaker->brand_id = $object->brand_id;
            $sneaker->save();
        }
    }
}
