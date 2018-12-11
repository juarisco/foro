@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">Edit category: {{ $category->title }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
        
                        <div class="form-group">
                            <input type="text" name="title" value="{{ $category->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update category</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

@endsection
