<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;
use App\Category;

class ForumsController extends Controller
{
    public function index()
    {
        $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);

        return view('forum', ['discussions' => $discussions]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();

        return view('category')->with('discussions', $category->discussions()->paginate(5));
    }
}
