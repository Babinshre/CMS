@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
@endsection
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{-- edit and create displaying in a single page --}}
            {{ isset($post) ? 'Edit post' : 'Create post' }} 
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update',$post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data"> 
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
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                  <label for="category_id">category</label>
                  <select class="form-control" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                  </select>
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
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection