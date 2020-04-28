<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/sneakers.json');
        $data = json_decode($json);

        foreach ($data as $object) {
            Cloudder::upload(storage_path('img/' . $object->image), null, ['folder' => 'Sneakizy/Products']);
            $image = Cloudder::getResult();
            $product = new \App\Product();
            $product->name = $object->name;
            $product->color = $object->color;
            $product->description = $object->description;
            $product->price = $object->price;
            $product->release_date = $object->release_date;
            $product->image = $image['url'];
            $product->brand = $object->brand;
            $product->brand_id = $object->brand_id;
            $product->save();
        }
    }
}
