<?php

namespace App\Livewire\Forms\Product;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StoreProductForm extends Form
{
    #[Validate('required', as: 'Name')]
    public $name;

    #[Validate('required|numeric', as: 'Price')]
    public $price;

    #[Validate('required|exists:categories,id', as: 'Category')]
    public $category_id;

    public function store()
    {
        $this->validate();

        $product = Product::create([
            'name'        => $this->name,
            'price'       => $this->price,
            'category_id' => $this->category_id,
        ]);

        return $product;
    }
}
