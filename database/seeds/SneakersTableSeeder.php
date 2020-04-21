<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

class SneakersTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/sneakers.json');
        $data = json_decode($json);

        foreach ($data as $object) {
            $sneaker = new \App\Sneaker();
            $sneaker->name = $object->name;
            $sneaker->color = $object->color;
            $sneaker->description = $object->description;
            $sneaker->price = $object->price;
            $sneaker->release_date = $object->release_date;
            $sneaker->image = 'https://res.cloudinary.com/hrd7cpazc/image/upload/v1587474506/' . $object->image;
            $sneaker->brand = $object->brand;
            $sneaker->brand_id = $object->brand_id;
            $sneaker->save();
        }
    }
}
