@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header text-center">Create a new discussion</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    <form action="{{ route('discussions.store') }}" method="POST" role="form">
                        @csrf

                        {{-- <legend>Form title</legend> --}}

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" autofocus>
                        </div>
                    
                        <div class="form-group">
                            <label for="category">Pick a category <small>*channel*</small></label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="content">Ask a question</label>
                            <textarea name="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                        </div>
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right">Create discussion</button>
                        </div>
                    </form>

                </div>
            </div>
@endsection
