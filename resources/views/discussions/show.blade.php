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

@endsection
