@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
        <h1>Users</h1>
        <a href="{{ route('users.create') }}" style="background:#0366d6;color:#fff;padding:8px 12px;border-radius:4px;text-decoration:none">Create User</a>
    </div>

    @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:12px;border-radius:4px;margin-bottom:16px">
            {{ session('success') }}
        </div>
    @endif

    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="background:#f1f3f5">
                <th style="padding:12px;text-align:left;border-bottom:2px solid #dee2e6">ID</th>
                <th style="padding:12px;text-align:left;border-bottom:2px solid #dee2e6">Name</th>
                <th style="padding:12px;text-align:left;border-bottom:2px solid #dee2e6">Email</th>
                <th style="padding:12px;text-align:left;border-bottom:2px solid #dee2e6">Roles</th>
                <th style="padding:12px;text-align:left;border-bottom:2px solid #dee2e6">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr style="border-bottom:1px solid #dee2e6">
                    <td style="padding:12px">{{ $user->id }}</td>
                    <td style="padding:12px">{{ $user->name }}</td>
                    <td style="padding:12px">{{ $user->email }}</td>
                    <td style="padding:12px">
                        @if($user->roles->isNotEmpty())
                            {{ $user->roles->pluck('name')->join(', ') }}
                        @else
                            <span style="color:#6c757d">No roles</span>
                        @endif
                    </td>
                    <td style="padding:12px">
                        <a href="{{ route('users.edit', $user) }}" style="color:#0366d6;text-decoration:none;margin-right:8px">Edit</a>
                        <a href="{{ route('users.show', $user) }}" style="color:#28a745;text-decoration:none">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding:12px;text-align:center;color:#6c757d">No users found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection