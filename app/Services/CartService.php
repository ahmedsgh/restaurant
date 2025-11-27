<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartService
{
    public function add($productId, $quantity = 1, $options = [])
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Product::find($productId);
            if (!$product)
                return;
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name, // This will be the translated name if accessed via model accessor, but here we might store raw or array. 
                // Actually, storing the model instance or just ID is better, but for session simplicity we store basic data.
                // If name is translatable, accessing $product->name returns the string in current locale.
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
                'options' => $options,
            ];
        }
        Session::put('cart', $cart);
    }

    public function remove($productId)
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    public function update($productId, $quantity)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }
    }

    public function clear()
    {
        Session::forget('cart');
    }

    public function get()
    {
        return Session::get('cart', []);
    }

    public function total()
    {
        $cart = Session::get('cart', []);
        return array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }
}
