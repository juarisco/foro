@extends('layouts.app')

@section('content')
    
    @foreach ($discussions as $d)
    
        <div class="card">
            <div class="card-header">
                <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;
                <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>
                <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-link btn-sm float-right" style="margin-right:8px;">view</a>
                @if ($d->hasBestAnswer())
                    <span class="btn btn-success btn-sm float-right">closed</span>
                @else
                    <span class="btn btn-danger btn-sm float-right">open</span>
                @endif

            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h5 class="text-center">
                    {{ $d->title }}
                </h5>
                <p class="text-center">
                    {{ str_limit($d->content, 50) }}
                </p>
            </div>
            <div class="card-footer">
                <span>{{ $d->replies->count() }} Replies</span>
                <a href="{{ route('category', ['slug' => $d->category->slug]) }}" class="btn btn-secondary btn-sm float-right">{{ $d->category->title }}</a>
            </div>
        </div>
        <br>
        
    @endforeach

    <div class="pagination justify-content-center">{{ $discussions->links() }}</div>

@endsection
