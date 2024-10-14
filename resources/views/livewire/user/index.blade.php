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
                            <button class="btn btn-success" type="button" wire:click="create">Create User</button>
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
                                    <label class="form-label" for="search">Search</label>
                                    <input class="form-control" type="search" wire:model.live="search" placeholder="Example : John Doe">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table-striped table-hover text-nowrap table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $users->firstItem() + $loop->index }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-warning btn-sm" type="button" wire:click="edit({{ $user->id }})">Edit</button>
                                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $user->id }})">Delete</button>
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
                    @if ($users->hasPages())
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModal" aria-labelledby="userModalLabel" aria-hidden="true" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userModalLabel">{{ $titleMode }}</h1>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="{{ $mode }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="name"><span class="text-danger">*</span> Name</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" wire:model="name" placeholder="Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email"><span class="text-danger">*</span> Email</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" wire:model="email" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('openUserModal', () => bootstrap.Modal.getOrCreateInstance(document.querySelector("#userModal")).show());

        $wire.on('closeUserModal', () => {
            const modalObj = bootstrap.Modal.getInstance(document.querySelector("#userModal"));
            modalObj.hide();
        })
    </script>
@endscript
