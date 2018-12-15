<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Reply;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewReplyAdded;

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
        $discussion = Discussion::where('slug', $slug)->first();

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();

        return view('discussions.show')
            ->with('d', $discussion)
            ->with('best_answer', $best_answer);
    }

    public function reply($id)
    {
        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->content
        ]);

        $reply->user->points += 25;
        $reply->user->save();

        $watchers = array();

        foreach ($d->watchers as $watcher) {
            array_push($watchers, User::find($watcher->user_id));
        }

        // dd($watchers);
        Notification::send($watchers, new NewReplyAdded($d));

        Session::flash('success', 'Replied to discussion.');

        return redirect()->back();
    }

    public function edit($slug)
    {
        return view('discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first()]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);

        $d->content = request()->content;
        $d->save();

        Session::flash('success', 'Discussion updated');

        return redirect()->route('discussion', ['slug' => $d->slug]);

    }
}
