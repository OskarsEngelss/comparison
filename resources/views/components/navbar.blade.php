<nav>
    <a class="navbar-a" href="/">Home</a>
    <a class="navbar-a" href="/create">Create</a>
    <a class="navbar-a" href="/profile">
        @auth
            {{ auth()->user()->name }}
        @endauth
        @guest
            Log in
        @endguest
    </a>
</nav>