@extends('layouts.app')

@section('title', 'Edit user')

@section('content')
    <h1>Edit user</h1>

    @include('users._form', [
        'action' => route('users.update', $user),
        'method' => 'patch',
        'user' => $user,
        'roles' => $roles ?? [],
        'selected' => $selected ?? ($user->roles->pluck('id')->toArray() ?? []),
        'buttonText' => 'Update'
    ])

    <div style="margin-top:12px">
        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:#ff4d4f;color:#fff;border:none;padding:8px 10px;border-radius:4px;cursor:pointer">Delete</button>
            <a href="{{ route('users.index') }}" style="margin-left:12px;color:#0366d6;text-decoration:none">Back to list</a>
        </form>
    </div>
@endsection