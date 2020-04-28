<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;

class ImageTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/images.json');
        $data = json_decode($json);
        foreach ($data as $object)
        {
            Cloudder::upload(storage_path('img/' . $object->image), null, ['folder' => 'Sneakizy/Images']);
            $img = Cloudder::getResult();
            $image = new \App\Image();
            $image->image = $img['url'];
            $image->product_id = $object->sneaker_id;
            $image->save();
        }
    }
}
