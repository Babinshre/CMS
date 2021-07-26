@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" id="title" class="form-control" name="title">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        Add category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection