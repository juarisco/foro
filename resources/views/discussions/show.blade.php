@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
        <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>
        <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-link float-right">view</a>
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h4 class="text-center">
            {{ $d->title }}
        </h4>
        <hr>
        <p class="text-center">
            {{ $d->content }}
        </p>
    </div>
    <div class="card-footer">
        <p>{{ $d->replies->count() }} Replies</p>
    </div>
</div>
<br>

@foreach ($d->replies as $r)
    <div class="card">
        <div class="card-header">
            <img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
            <span>{{ $r->user->name }}, <b>{{ $r->created_at->diffForHumans() }}</b></span>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-center">
                {{ $r->content }}
            </p>
        </div>
        <div class="card-footer">
            <p>Like</p>
        </div>
    </div>
    <br>
@endforeach

<div class="card">
    {{-- <div class="card-header">
    </div> --}}

    <div class="card-body">
        <form action="{{ route('discussion.reply', ['id' => $d->id]) }}" method="POST" role="form">
            @csrf
            {{-- <legend>Form title</legend> --}}
        
            <div class="form-group">
                <label for="content">Leave a reply...</label>
                <textarea name="content" cols="30" rows="10" class="form-control" id="content"></textarea>
            </div>
        
            
        
            <button type="submit" class="btn btn-primary float-right">Leave a reply</button>
        </form>
    </div>

    {{-- <div class="card-footer">
    </div> --}}
</div>
<br>

@endsection