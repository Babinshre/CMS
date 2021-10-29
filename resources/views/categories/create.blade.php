@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{-- edit and create displaying in a single page --}}
            {{ isset($category) ? 'Edit category' : 'Create category' }} 
        </div>
        <div class="card-body">
            <form action="{{ isset($category) ? route('categories.update',$category->id) : route('categories.store') }}" method="POST"> 
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ isset($category) ? $category->title : ' ' }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($category) ? 'Update' : 'Add category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection