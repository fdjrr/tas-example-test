<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" type="button" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <x-nav.link href="{{ route('dashboard') }}" :active="Route::is('dashboard')" wire:navigate>Dashboard</x-nav.link>
                <x-nav.link href="{{ route('products.index') }}" :active="Route::is('products.*')" wire:navigate>Products</x-nav.link>
                <x-nav.link href="{{ route('users.index') }}" :active="Route::is('users.*')" wire:navigate>Users</x-nav.link>
            </div>
        </div>
    </div>
</nav>
