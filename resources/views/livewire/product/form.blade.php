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
                                <label class="form-label" for="price"><span class="text-danger">*</span> Price</label>
                                <input class="form-control {{ $errors->has('form.price') ? 'is-invalid' : '' }}" type="number" wire:model="form.price" placeholder="Price">
                                @error('form.price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category_id"><span class="text-danger">*</span> Category</label>
                                <select class="form-select {{ $errors->has('form.category_id') ? 'is-invalid' : '' }}" id="category_id" wire:model="form.category_id">
                                    <option value="">Select Category</option>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('form.category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end gap-1">
                            <a class="btn btn-secondary" href="{{ route('products.index') }}" wire:navigate>Back</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
