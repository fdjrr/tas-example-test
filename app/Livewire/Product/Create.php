<?php

namespace App\Livewire\Product;

use App\Helpers\StringHelper;
use App\Livewire\Forms\Product\StoreProductForm;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public StoreProductForm $form;

    public function save()
    {
        $product = $this->form->store();

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
                'title' => 'Create Product',
                'form'  => [
                    'action' => 'save',
                ],
            ],
            'categories' => Category::all(),
        ]);
    }
}
