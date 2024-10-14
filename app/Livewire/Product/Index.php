<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\PerPage;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;

    #[Url]
    public $search;

    #[Url]
    public $category_id;

    #[Url]
    public $per_page = 25;

    public $amount = 10;

    public $listeners = [
        'confirmedDelete',
    ];

    public $id;

    public function delete($id)
    {
        $this->id = $id;

        $this->confirm('Are you sure?', [
            'text'        => 'Data Product will be deleted!',
            'onConfirmed' => 'confirmedDelete',
        ]);
    }

    public function confirmedDelete()
    {
        $product = Product::find($this->id);

        if ($product) {
            $product->delete();

            return $this->alert('success', 'Berhasil', [
                'text' => 'Data Product deleted successfully!',
            ]);
        } else {
            return $this->alert('error', 'Gagal', [
                'text' => 'Data Product not found!',
            ]);
        }
    }

    public function loadMore()
    {
        $this->amount += $this->per_page;
    }

    public function render()
    {
        $products = Product::query()
            ->with([
                'category',
            ])
            ->filter([
                'search'      => $this->search,
                'category_id' => $this->category_id,
            ])->take($this->amount)->orderBy('name')->get();

        return view('livewire.product.index', [
            'page_meta'  => [
                'title' => 'Data Products',
            ],
            'products'   => $products,
            'per_pages'  => PerPage::all(),
            'categories' => Category::all(),
        ]);
    }
}
