<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/brands.json');
        $data = json_decode($json);
        foreach ($data as $object)
        {
            Cloudder::upload(storage_path('img/' . $object->image), null, ['folder' => 'Sneakizy/Brands']);
            $image = Cloudder::getResult();
            Cloudder::upload(storage_path('img/' . $object->banner), null, ['folder' => 'Sneakizy/Brands']);
            $banner = Cloudder::getResult();
            $brand = new \App\Brand();
            $brand->name = $object->name;
            $brand->image = $image['url'];
            $brand->banner = $banner['url'];
            $brand->save();
        }
    }
}
