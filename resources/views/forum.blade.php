@extends('layouts.app')

@section('content')
    
    @foreach ($discussions as $d)
    
        <div class="card">
            <div class="card-header">
                <img src="{{ $d->user->avatar }}" alt="" width="70px" height="70px">
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ $d->content }}
            </div>
        </div>
        <br>
        
    @endforeach

    <div class="pagination justify-content-center">{{ $discussions->links() }}</div>

@endsection
