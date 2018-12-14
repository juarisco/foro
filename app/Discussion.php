<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Discussion extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'user_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function watchers()
    {
        return $this->hasMany(Watcher::class);
    }

    public function is_being_watched_by_auth_user()
    {
        $id = Auth::id();

        $watchers_ids = array();

        foreach ($this->watchers as $w) {
            array_push($watchers_ids, $w->user_id);
        }

        if (in_array($id, $watchers_ids)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasBestAnswer()
    {
        $result = false;
        foreach ($this->replies as $reply) {
            if ($reply->best_answer) {
                $result = true;
                break;
            }
        }

        return $result;
    }
}
