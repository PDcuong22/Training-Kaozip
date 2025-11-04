@extends('layouts.admin')

@section('title', 'User details')

@section('content')
    <h1>User #{{ $user->id }} — {{ $user->name }}</h1>

    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Created:</strong> {{ $user->created_at ?? 'N/A' }}</p>
    <p><strong>Updated:</strong> {{ $user->updated_at ?? 'N/A' }}</p>

    @if(isset($user->roles) && $user->roles->isNotEmpty())
        <p><strong>Roles:</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>
    @endif

    @if(isset($user->posts) && $user->posts->isNotEmpty())
        <h3>Posts</h3>
        <ul>
            @foreach($user->posts as $post)
                <li>
                    {{ $post->title ?? 'Untitled' }}
                    <small style="color:#666">({{ $post->created_at ?? '' }})</small>
                </li>
            @endforeach
        </ul>
    @endif

    <div style="margin-top:12px">
        <a href="{{ route('users.edit', $user) }}" style="margin-right:8px">Edit</a>

        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this user?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:#ff4d4f;color:#fff;border:none;padding:6px 10px;border-radius:4px;cursor:pointer">Delete</button>
        </form>

        <a href="{{ route('users.index') }}" style="margin-left:12px">Back to list</a>
    </div>
@endsection