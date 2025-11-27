<?php

namespace App\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $cartItems = [];
    public $total = 0;

    public $name;
    public $phone;
    public $address;
    public $type = 'takeaway'; // takeaway, inplace, delivery
    public $table_number;
    public $note;

    protected $rules = [
        'name' => 'required_if:type,delivery,takeaway',
        'phone' => 'required_if:type,delivery,takeaway',
        'address' => 'required_if:type,delivery',
        'table_number' => 'required_if:type,inplace',
        'type' => 'required|in:takeaway,inplace,delivery',
    ];

    public function mount()
    {
        $service = new \App\Services\CartService();
        $this->cartItems = $service->get();
        $this->total = $service->total();

        if (empty($this->cartItems)) {
            return redirect()->route('menu');
        }
    }

    public function placeOrder()
    {
        $this->validate();

        $trackingCode = strtoupper(uniqid('ORD-'));

        $order = \App\Models\Order::create([
            'tracking_code' => $trackingCode,
            'customer_name' => $this->name,
            'customer_phone' => $this->phone,
            'customer_address' => $this->address,
            'type' => $this->type,
            'table_number' => $this->table_number,
            'note' => $this->note,
            'total' => $this->total,
            'status' => 'pending',
        ]);

        foreach ($this->cartItems as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'options' => $item['options'] ?? [],
            ]);
        }

        (new \App\Services\CartService())->clear();

        // Add tracking code to session array
        $trackingCodes = session('order_tracking_codes', []);
        $trackingCodes[] = $trackingCode;
        session(['order_tracking_codes' => $trackingCodes]);

        return redirect()->route('order.track');
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.front');
    }
}
