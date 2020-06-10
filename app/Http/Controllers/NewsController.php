<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\News;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $pageQuery = $request->query('page');

        $orderBy = $request->query('orderBy');
        if (isset($pageQuery) && !empty($pageQuery) && $pageQuery > 0)
        {
            if (isset($orderBy) && !empty($orderBy))
            {
                return response()->json(News::isPublished()->orderBy('created_at', $orderBy)->paginate((int)$request->query('max')), 200);
            }
            return response()->json(News::isPublished()->paginate((int)$request->query('max')), 200);
        }
        return response()->json(News::isPublished()->get(), 200);
    }

    public function create()
    {
        //
    }

    public function store(ArticleRequest $request)
    {
        Cloudder::upload($request->file('image'), null, ['folder' => 'Sneakizy/News']);
        $cloundary_upload = Cloudder::getResult();
        Cloudder::upload($request->file('banner'), null, ['folder' => 'Sneakizy/News']);
        $cloundary_upload_banner = Cloudder::getResult();
        $article = new News();
        $article->title = $request->title;
        $article->image = $cloundary_upload['url'];
        $article->banner = $cloundary_upload_banner['url'];
        $article->author = $request->author;
        $article->summary = $request->summary;
        $article->content = $request->content;
        $article->save();
    }

    public function show($id)
    {
        return response()->json(News::isPublished()->where('id', $id)->get()->first(), 200);
    }

    public function update(ArticleRequest $request, $id)
    {
        return response()->json([
            'message' => $status ? 'Sneaker Updated!' : 'Error Updating Product'
        ]);
    }

    public function destroy($id)
    {
        $article = News::where('id', $id)->first();
        $status = News::findOrFail($id)->delete();
        Cloudder::destroyImage('Sneakizy/News/' . pathinfo($article->image)['filename']);
        Cloudder::delete('Sneakizy/News/' . pathinfo($article->image)['filename']);
        Cloudder::destroyImage('Sneakizy/News/' . pathinfo($article->banner)['filename']);
        Cloudder::delete('Sneakizy/News/' . pathinfo($article->banner)['filename']);

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
        ]);
    }
}
