@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v3.7.min.css" rel="stylesheet" type="text/css"/>
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
                  <textarea class="form-control" name="description" id="description" rows="3">{{ isset($post) ? $post->description : ' ' }}</textarea>
                </div>
                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select class="form-control" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        @if (isset($post))
                        <option  {{ $post->category_id == $category->id ? 'selected' : '' }}  value="{{$category->id}}">{{ $category->title }}</option>
                        @else
                        <option value="{{$category->id}}">{{ $category->title }}</option>
                        @endif
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                  <label for="content">content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : ' ' }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                @if ($tags->count()>0)
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select class="form-control tags-selector" name="tags[]" id="tags" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if (isset($post))
                                    @if ($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                               >
                                {{ $tag->title }}
                            </option>
                        @endforeach
                        </select>
                  </div>
                @endif
                <div class="form-group">
                  <label for="image">Upload image</label>
                  @if(isset($post))
                      <div class="form-group">
                      <img src="{{ asset('storage/'.$post->image) }}" alt="kan" style="width: 20%">
                      </div>
                  @endif
                  <input type="file" class="form-control-file" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                </div>
                <div class="form-group">
                  <label for="published_at">published_at</label>
                  <input type="text" name="published_at" id="published_at" class="form-control" placeholder="" aria-describedby="helpId" value="{{ isset($post) ? $post->published_at : ' ' }}">
                </div>
                {{-- this is nepali date picker demo --}}
                {{-- <p>
                    <input type="text" id="nepali-datepicker" placeholder="Select Nepali Date"/>
                </p>
          
                <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js" type="text/javascript"></script>
                <script type="text/javascript">
                    window.onload = function() {
                        var mainInput = document.getElementById("nepali-datepicker");
                        mainInput.nepaliDatePicker();
                    };
                </script> --}}

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
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at');
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>

@endsection