<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/brands.json');
        $data = json_decode($json);
        foreach ($data as $object)
        {
            $brand = new \App\Brand();
            $brand->name = $object->name;
            $brand->image = 'https://res.cloudinary.com/hrd7cpazc/image/upload/v1587474506/' . $object->image;
            $brand->banner = $object->banner;
            $brand->save();
        }
    }
}
