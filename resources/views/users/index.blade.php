@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">Users</div>
    <div class="card-body">
        @if ($users->count()>0)
        <table class="table">
            <thead>
                <th>image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
                              
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::src($user->email) }}" alt="" srcset="">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!$user->isAdmin())
                            <form action="{{ route('user.make-admin',$user->id) }}" method="post">
                                @csrf
                                <button type="submit" href="#" class="btn btn-sm btn-primary">Make admin</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        @else
            <h3 class="textcenter">No Users yet</h3>
        @endif
    </div>
</div>
@endsection
