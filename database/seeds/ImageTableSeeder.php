<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/images.json');
        $data = json_decode($json);
        foreach ($data as $object)
        {
            $image = new \App\Image();
            $image->image = 'https://res.cloudinary.com/hrd7cpazc/image/upload/v1587474506/' . $object->image;
            $image->product_id = $object->sneaker_id;
            $image->save();
        }
    }
}
