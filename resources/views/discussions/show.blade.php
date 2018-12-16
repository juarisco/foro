@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
        <span>{{ $d->user->name }}, <b>( {{ $d->user->points }} )</b></span>

        @if ($d->hasBestAnswer())
            <span class="btn btn-success btn-sm float-right">closed</span>
        @else
            <span class="btn btn-danger btn-sm float-right">open</span>
        @endif
        
        @if (Auth::id()==$d->user->id)
            @if (!$d->hasBestAnswer())
                <a href="{{ route('discussion.edit', ['slug' => $d->slug]) }}" class="btn btn-info btn-sm float-right" style="margin-right:8px;">Edit</a>
            @endif
        @endif

        @if ($d->is_being_watched_by_auth_user())
            <a href="{{ route('discussion.unwatch', ['id' => $d->id]) }}" class="btn btn-light btn-sm float-right" style="margin-right:8px;">unwatch</a>
        @else
            <a href="{{ route('discussion.watch', ['id' => $d->id]) }}" class="btn btn-light btn-sm float-right" style="margin-right:8px;">watch</a>
        @endif
    </div>

    <div class="card-body">

        <h4 class="text-center">
            {{ $d->title }}
        </h4>
        <hr>
        <p class="text-center">
            {!! Markdown::convertToHtml($d->content) !!}
        </p>
        
        <hr>

        @if ($best_answer)
        <div class="text-center" style="padding:40px;">
            <h3>BEST ANSWER</h3>
            <div class="card border-success mb-3">
                <div class="card-header">
                    <img src="{{ $best_answer->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
                    <span>{{ $best_answer->user->name }} <b>( {{ $best_answer->user->points }} )</b></span>
                </div>
                <div class="card-body text-success">
                    {!! Markdown::convertToHtml($best_answer->content) !!}
                </div>
            </div>
        </div>
        @endif
        
    </div>
    <div class="card-footer">
        <span>{{ $d->replies->count() }} Replies</span>
        <a href="{{ route('category', ['slug' => $d->category->slug]) }}" class="btn btn-secondary btn-sm float-right">{{ $d->category->title }}</a>
    </div>
</div>
<br>

@foreach ($d->replies as $r)
    <div class="card">
        <div class="card-header">
            <img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
            <span>{{ $r->user->name }} <b>( {{ $r->user->points }} )</b></span>

            @if (!$best_answer)
                @if (Auth::id()==$d->user->id)
                    <a href="{{ route('discussion.best.answer', ['id' => $r->id]) }}" class="btn btn-primary btn-sm float-right">Mark as best answer</a>
                @endif

                
            @endif

            @if (Auth::id()==$r->user->id)
                    @if (!$r->best_answer)
                        <a href="{{ route('reply.edit', ['id' => $r->id]) }}" class="btn btn-info btn-sm float-right" style="margin-right:8px;">Edit answer</a>
                    @endif
                @endif

        </div>

        <div class="card-body">
            <p class="text-center">
                {!! Markdown::convertToHtml($r->content) !!}
            </p>
        </div>
        <div class="card-footer">
            @if ($r->is_liked_by_auth_user())
                <a href="{{ route('reply.unlike', ['id' => $r->id]) }}" class="btn btn-danger btn-sm">Unlike <span class="badge badge-light">{{ $r->likes->count() }}</span></a>
            @else
                <a href="{{ route('reply.like', ['id' => $r->id]) }}" class="btn btn-success btn-sm">Like <span class="badge badge-light">{{ $r->likes->count() }}</span></a>
            @endif
        </div>
    </div>
    <br>
@endforeach

<div class="card">
    {{-- <div class="card-header">
    </div> --}}

    <div class="card-body">
        @if (Auth::check())
            <form action="{{ route('discussion.reply', ['id' => $d->id]) }}" method="POST" role="form">
                @csrf
                {{-- <legend>Form title</legend> --}}
            
                <div class="form-group">
                    <label for="content">Leave a reply...</label>
                    <textarea name="content" cols="30" rows="10" class="form-control" id="content"></textarea>
                </div>
            
                
            
                <button type="submit" class="btn btn-primary float-right">Leave a reply</button>
            </form>
        @else
            <div class="text-center">
                <h2>Sign in to leave a reply</h2>
            </div>            
        @endif
    </div>

    {{-- <div class="card-footer">
    </div> --}}
</div>
<br>

@endsection
