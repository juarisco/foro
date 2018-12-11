<?php

namespace App\Http\Controllers;

use Session;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionsController extends Controller
{
    public function create()
    {
        return view('discussions.discuss');
    }

    public function store()
    {
        // dd($request);
        $r = request();

        $this->validate($r, [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        $discussion = Discussion::create([
            'title' => $r->title,
            'slug' => str_slug($r->title),
            'category_id' => $r->category_id,
            'content' => $r->content,
            'user_id' => Auth::id(),
        ]);

        Session::flash('success', 'Discussion successfully created.');

        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    public function show($slug)
    {
        return view('discussions.show')->with('discussion', Discussion::where('slug', $slug)->first());
    }
}
