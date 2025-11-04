@extends('layouts.admin')

@section('title', 'Create user')

@section('content')
    <h1>Create user</h1>

    @include('users._form', [
        'action' => route('users.store'),
        'method' => 'post',
        'roles' => $roles ?? [],      
        'selected' => $selected ?? [],
        'buttonText' => 'Create'
    ])
@endsection