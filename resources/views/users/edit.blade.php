@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My profile</div>

    <div class="card-body">
        <form action="{{ route('user.update-profile') }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="about">About</label>
              <textarea class="form-control" name="about" id="about" rows="3">{{ $user->about }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Profile</button>
        </form>
    </div>
</div>
</div>
@endsection
