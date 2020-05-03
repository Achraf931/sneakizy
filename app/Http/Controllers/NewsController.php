<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return response()->json(News::findOrFail($id));
    }

    public function edit(News $news)
    {
        //
    }

    public function update(Request $request, News $news)
    {
        //
    }

    public function destroy(News $news)
    {
        //
    }
}
