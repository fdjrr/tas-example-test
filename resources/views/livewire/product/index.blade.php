<div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ $page_meta['title'] }}
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class="btn btn-success" href="{{ route('products.create') }}" wire:navigate>Create Product</a>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" for="per_page">Per Page</label>
                                    <select class="form-select" id="per_page" wire:model.live="per_page">
                                        @forelse ($per_pages as $per_page)
                                            <option value="{{ $per_page->item }}">{{ $per_page->item }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" for="category_id">Category</label>
                                    <select class="form-select" id="category_id" wire:model.live="category_id">
                                        <option value="">Choose Category</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" for="search">Search</label>
                                    <input class="form-control" type="search" wire:model.live="search" placeholder="Example : Laptop">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table-striped table-hover table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody wire:scroll="loadMore">
                                        @forelse ($products as $product)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price_formatted }}</td>
                                                <td><span class="badge bg-info">{{ $product->category?->name }}</span></td>
                                                <td class="d-flex justify-content-center gap-1">
                                                    <a class="btn btn-warning btn-sm" href="{{ route('products.edit', $product) }}">Edit</a>
                                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $product->id }})">Delete</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">Data not found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($products) > 0)
                <div class="col-12">
                    <div x-intersect.full="$wire.loadMore()"></div>
                </div>
            @endif
        </div>
    </div>
</div>
