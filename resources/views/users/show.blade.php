@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
    <h1>User Details</h1>

    <div style="background:#f8f9fa;padding:16px;border-radius:4px;margin-bottom:16px">
        <div style="margin-bottom:8px">
            <strong>ID:</strong> {{ $user->id }}
        </div>
        <div style="margin-bottom:8px">
            <strong>Name:</strong> {{ $user->name }}
        </div>
        <div style="margin-bottom:8px">
            <strong>Email:</strong> {{ $user->email }}
        </div>
        <div style="margin-bottom:8px">
            <strong>Roles:</strong>
            @if($user->roles->isNotEmpty())
                {{ $user->roles->pluck('name')->join(', ') }}
            @else
                <span style="color:#6c757d">No roles assigned</span>
            @endif
        </div>
        <div style="margin-bottom:8px">
            <strong>Created:</strong> 
            {{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : 'N/A' }}
        </div>
        <div>
            <strong>Updated:</strong> 
            {{ $user->updated_at ? $user->updated_at->format('Y-m-d H:i') : 'N/A' }}
        </div>
    </div>

    <div style="display:flex;gap:8px">
        <a href="{{ route('users.edit', $user) }}" style="background:#0366d6;color:#fff;padding:8px 12px;border-radius:4px;text-decoration:none">Edit</a>
        <a href="{{ route('users.index') }}" style="color:#0366d6;text-decoration:none;padding:8px 12px">Back to list</a>
    </div>
@endsection