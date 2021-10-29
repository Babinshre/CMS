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
                <th>action</th>               
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <img src="{{asset('storage/'.$post->image)}}" width="120px" alt="img">
                            {{-- {{ $post->image }} --}}
                        </td>
                        <td>{{ $post->title }}</td>
                            {{-- @if (!$post->trashed())
                                <td><button class="btn btn-sm btn-info" type="submit">Edit</button></td>
                            @endif --}}
                        <td>
                            <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">delete
                                    {{-- {{ $post->trashed() ? 'delete' : 'trash' }} --}}
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