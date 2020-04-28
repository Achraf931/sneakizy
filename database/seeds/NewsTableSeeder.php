<?php

use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/news.json');
        $data = json_decode($json);

        foreach ($data as $object) {
            Cloudder::upload(storage_path('img/' . $object->image), null, ['folder' => 'Sneakizy/News']);
            $image = Cloudder::getResult();
            Cloudder::upload(storage_path('img/' . $object->banner), null, ['folder' => 'Sneakizy/News']);
            $banner = Cloudder::getResult();
            $article = new \App\News();
            $article->title = $object->title;
            $article->summary = $object->summary;
            $article->content = $object->content;
            $article->author = $object->author;
            $article->image = $image['url'];
            $article->banner = $banner['url'];
            $article->is_published = $object->is_published;
            $article->save();
        }
    }
}
