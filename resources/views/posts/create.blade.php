@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{-- edit and create displaying in a single page --}}
            {{ isset($post) ? 'Edit post' : 'Create post' }} 
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update',$post->id) : route('posts.store') }}" method="POST"> 
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ isset($post) ? $post->title : ' ' }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="content">content</label>
                  <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="image">Upload image</label>
                  <input type="file" class="form-control-file" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($post) ? 'Update' : 'Add post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection