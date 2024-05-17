<nav>
    <x-nav-link href="/">Home</x-nav-link>
    <x-nav-link href="/create">Create</x-nav-link>
    <x-nav-link href="/profile">
        @auth
            {{ auth()->user()->name }}
        @endauth
        @guest
            Log in
        @endguest
    </x-nav-link>
</nav>