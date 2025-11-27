<?php

namespace App\Livewire;

use Livewire\Component;

class Menu extends Component
{
    public $activeCategory = null;

    public function filterCategory($categoryId)
    {
        $this->activeCategory = $categoryId;
    }

    public function addToCart($productId)
    {
        (new \App\Services\CartService())->add($productId);
        $this->dispatch('cart-updated');
        session()->flash('message', 'Item added to cart!');
    }

    public function render()
    {
        $categories = \App\Models\Category::where('is_active', true)->get();
        $products = \App\Models\Product::where('is_active', true)
            ->when($this->activeCategory, function ($query) {
                $query->where('category_id', $this->activeCategory);
            })
            ->get();

        return view('livewire.menu', [
            'categories' => $categories,
            'products' => $products,
        ])->layout('layouts.front');
    }
}
