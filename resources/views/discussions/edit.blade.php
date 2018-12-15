@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header text-center">Update a discussion</div>

                <div class="card-body">

                    <form action="{{ route('discussion.update', $discussion->id) }}" method="POST" role="form">
                        @csrf
                    
                        <div class="form-group">
                            <label for="content">Ask a question</label>
                            <textarea name="content" cols="30" rows="10" class="form-control">{{ $discussion->content }}</textarea>
                        </div>
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right">Save discussion changes</button>
                        </div>
                    </form>

                </div>
            </div>
@endsection
