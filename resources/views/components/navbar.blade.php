<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" type="button" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="{{ route('dashboard') }}" aria-current="page" wire:navigate>Home</a>
                <a class="nav-link" href="{{ route('products.index') }}" wire:navigate>Products</a>
                <a class="nav-link" href="{{ route('users.index') }}" wire:navigate>Users</a>
            </div>
        </div>
    </div>
</nav>
