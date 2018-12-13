<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Reply;
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
        return view('discussions.show')->with('d', Discussion::where('slug', $slug)->first());
    }

    public function reply($id)
    {
        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->content
        ]);

        $watchers = array();

        foreach ($d->watchers as $watcher) {
            array_push($watchers, User::find($watcher->user_id));
        }

        // dd($watchers);

        Session::flash('success', 'Replied to discussion.');

        return redirect()->back();
    }
}
