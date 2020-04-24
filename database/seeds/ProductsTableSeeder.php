<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/sneakers.json');
        $data = json_decode($json);

        foreach ($data as $object) {
            $product = new \App\Product();
            $product->name = $object->name;
            $product->color = $object->color;
            $product->description = $object->description;
            $product->price = $object->price;
            $product->release_date = $object->release_date;
            $product->image = 'https://res.cloudinary.com/hrd7cpazc/image/upload/v1587474506/' . $object->image;
            $product->brand = $object->brand;
            $product->brand_id = $object->brand_id;
            $product->save();
        }
    }
}
