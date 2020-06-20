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
                return response()->json(News::orderBy('created_at', $orderBy)->paginate((int)$request->query('max')), 200);
            }
            return response()->json(News::paginate((int)$request->query('max')), 200);
        }
        return response()->json(News::isPublished()->get(), 200);
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
        return response()->json(News::where('id', $id)->get()->first(), 200);
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = News::where('id', $id)->first();

        if (isset($request->is_published) && $request->is_published !== 'undefined')
        {
            $article->is_published = $request->is_published;
        }
        else
        {
            if (isset($request->image) && $request->image !== 'undefined')
            {
                Cloudder::destroyImage('Sneakizy/News/' . pathinfo($article->image)['filename']);
                Cloudder::delete('Sneakizy/News/' . pathinfo($article->image)['filename']);

                Cloudder::upload($request->file('image'), null, ['folder' => 'Sneakizy/News']);
                $cloundary_upload = Cloudder::getResult();
                $article->image = $cloundary_upload['url'];
            }

            if (isset($request->banner) && $request->banner !== 'undefined')
            {
                Cloudder::destroyImage('Sneakizy/News/' . pathinfo($article->banner)['filename']);
                Cloudder::delete('Sneakizy/News/' . pathinfo($article->banner)['filename']);

                Cloudder::upload($request->file('banner'), null, ['folder' => 'Sneakizy/News']);
                $cloundary_upload2 = Cloudder::getResult();
                $article->banner = $cloundary_upload2['url'];
            }

            $article->title = $request->title;
            $article->summary = $request->summary;
            $article->content = $request->content;
            $article->author = $request->author;
        }

        $article->save();

        return response()->json($article);
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
