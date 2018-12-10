@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories <small>Channels</small></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->title }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', ['category'=> $category->id]) }}" class="btn btn-xs btn-info">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('categories.destroy', ['category'=> $category->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger">Destroy</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
        
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
