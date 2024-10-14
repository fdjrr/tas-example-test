<?php

namespace App\Livewire\Product;

use App\Helpers\StringHelper;
use App\Livewire\Forms\Product\UpdateProductForm;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public ?Product $product;
    public UpdateProductForm $form;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->form->fill($product);
    }

    public function save()
    {
        $product = $this->form->update($this->product);

        $search = StringHelper::first($product->name);

        return $this->flash('success', 'Berhasil', [
            'text' => 'Data Product created successfully!',
        ], route('products.index', [
                'search' => $search,
            ]));
    }

    public function render()
    {
        return view('livewire.product.form', [
            'page_meta'  => [
                'title' => 'Edit Product',
                'form'  => [
                    'action' => 'save',
                ],
            ],
            'categories' => Category::all(),
        ]);
    }
}
