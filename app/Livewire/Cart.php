<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;

    protected $listeners = ['cart-updated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $service = new \App\Services\CartService();
        $this->cartItems = $service->get();
        $this->total = $service->total();
    }

    public function removeItem($productId)
    {
        (new \App\Services\CartService())->remove($productId);
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function updateQuantity($productId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeItem($productId);
            return;
        }
        (new \App\Services\CartService())->update($productId, $quantity);
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.cart')->layout('layouts.front');
    }
}
