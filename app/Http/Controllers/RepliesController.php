<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Reply;

class RepliesController extends Controller
{
    public function like($id)
    {
        Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'You like the reply.');

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        Session::flash('success', 'You unliked the reply.');

        return redirect()->back();
    }

    public function best_answer($id)
    {
        $reply = Reply::find($id);

        $reply->best_answer = 1;
        $reply->save();

        Session::flash('success', 'Reply marked as the best answer.');

        return redirect()->back();
    }
}
