<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/news.json');
        $data = json_decode($json);

        foreach ($data as $object) {
            $article = new \App\News();
            $article->title = $object->title;
            $article->summary = $object->summary;
            $article->content = $object->content;
            $article->author = $object->author;
            $article->image = 'https://res.cloudinary.com/hrd7cpazc/image/upload/v1587474506/' . $object->image;
            $article->banner = 'https://res.cloudinary.com/hrd7cpazc/image/upload/v1587474506/' . $object->banner;
            $article->is_published = $object->is_published;
            $article->save();
        }
    }
}
