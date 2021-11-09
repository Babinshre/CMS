@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{-- edit and create displaying in a single page --}}
            {{ isset($tag) ? 'Edit tag' : 'Create tag' }} 
        </div>
        <div class="card-body">
            <form action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store') }}" method="POST"> 
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ isset($tag) ? $tag->title : ' ' }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($tag) ? 'Update' : 'Add tag' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection