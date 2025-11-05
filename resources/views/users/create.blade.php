@extends('layouts.admin')

@section('title', 'Create user')

@section('content')
    <h1>Create user</h1>

    @include('users._form', [
        'action' => route('users.store'),
        'method' => 'post',
        'user' => null, 
        'roles' => $roles ?? [],
        'selected' => old('roles', []),
        'buttonText' => 'Create'
    ])

    <div style="margin-top:12px">
        <a href="{{ route('users.index') }}" style="color:#0366d6;text-decoration:none">Back to list</a>
    </div>
@endsection