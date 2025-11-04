@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<h1>Users</h1>

<p><a href="{{ route('users.create') }}">Create new user</a></p>

@forelse($users as $user)
    <div style="padding:8px;border-bottom:1px solid #eee; display:flex; align-items:center;">
        <div style="flex:1">
            <strong>#{{ $user->id }}</strong> — <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
            <div style="color:#666;font-size:0.9em">{{ $user->email }}</div>
        </div>

        <div>
            <a href="{{ route('users.edit', $user) }}" style="margin-right:8px">Edit</a>

            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this user?')">Delete</button>
            </form>
        </div>
    </div>
@empty
    <p>No users found.</p>
@endforelse

<!-- {{-- nếu $users là paginator --}}
@if(method_exists($users, 'links'))
    <div style="margin-top:12px">
        {{ $users->links() }}
    </div>
@endif -->
@endsection