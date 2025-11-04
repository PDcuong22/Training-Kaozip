<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'App')</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body{font-family:Arial,Helvetica,sans-serif;margin:0;padding:16px;background:#f5f5f5}
        .nav{background:#fff;padding:8px 12px;border-bottom:1px solid #ddd}
        .nav a{margin-right:12px;color:#0366d6;text-decoration:none}
        .box{background:#fff;padding:16px;margin-top:12px;border:1px solid #eee}
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ url('/') }}">{{ config('app.name','App') }}</a>
        <a href="{{ route('users.index') }}">Users</a>
        <a href="{{ route('users.create') }}">Create</a>
    </div>

    <div class="box">
        @if(session('success')) <div style="color:green;margin-bottom:8px">{{ session('success') }}</div> @endif
        @yield('content')
    </div>
</body>
</html>