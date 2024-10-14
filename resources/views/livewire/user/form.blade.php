<div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ $page_meta['title'] }}
                    </div>
                    <form wire:submit.prevent="{{ $page_meta['form']['action'] }}">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name"><span class="text-danger">*</span> Name</label>
                                <input class="form-control {{ $errors->has('form.name') ? 'is-invalid' : '' }}" type="text" wire:model="form.name" placeholder="Name">
                                @error('form.name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email"><span class="text-danger">*</span> Email</label>
                                <input class="form-control {{ $errors->has('form.email') ? 'is-invalid' : '' }}" type="text" wire:model="form.email" placeholder="Email">
                                @error('form.email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-1">
                            <a class="btn btn-secondary" href="{{ route('users.index') }}" wire:navigate>Back</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
