<h1>About Us</h1>
<p>This is the about page!</p>
<!-- <pre>@json($users, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)</pre> -->
<ul>
    @foreach ($users as $user)
        <li>{{ $user->name }} - {{ $user->title }}</li>
    @endforeach
</ul>
<h2>Categories</h2>
<ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }} - {{ $category->created_at }}</li>
    @endforeach
</ul>