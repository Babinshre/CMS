@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">Post</div>
    <div class="card-body">
        @if ($posts->count()>0)
        <table class="table">
            <thead>
                <th>image</th>
                <th>title</th>
                <th>category</th>
                <th>action</th>               
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <img src="{{asset('storage/'.$post->image)}}" width="120px" alt="img">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->title }}</td>
                            @if ($post->trashed())
                                <td>
                                    <form action="{{ route('restore-post',$post->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-info" type="submit">Restore</button>
                                    </form>
                                </td>
                            @else
                                <td><a type="button" href="{{ route('posts.edit',$post->id) }}" class="btn btn-sm btn-info" type="submit">Edit</a></td>
                            @endif

                        <td>
                            <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    {{ $post->trashed() ? 'delete' : 'trash' }}
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
            </tbody>
        </table>
        @else
            <h3 class="textcenter">No post yet</h3>
        @endif
    </div>
</div>
@endsection