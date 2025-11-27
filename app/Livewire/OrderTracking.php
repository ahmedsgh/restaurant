<?php

namespace App\Livewire;

use Livewire\Component;

class OrderTracking extends Component
{
    public $trackingCode = '';
    public $orders = [];
    public $filteredOrders = [];

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        // Get all tracking codes from session
        $trackingCodes = session('order_tracking_codes', []);

        if (!empty($trackingCodes)) {
            $this->orders = \App\Models\Order::whereIn('tracking_code', $trackingCodes)
                ->with('items.product')
                ->latest()
                ->get();
        } else {
            $this->orders = collect();
        }

        $this->filteredOrders = $this->orders;
    }

    public function trackOrder()
    {
        if (empty($this->trackingCode)) {
            return;
        }

        // Find the order
        $order = \App\Models\Order::where('tracking_code', $this->trackingCode)->first();

        if ($order) {
            // Add to session if not already there
            $trackingCodes = session('order_tracking_codes', []);
            if (!in_array($this->trackingCode, $trackingCodes)) {
                $trackingCodes[] = $this->trackingCode;
                session(['order_tracking_codes' => $trackingCodes]);
            }

            // Reload orders
            $this->loadOrders();

            // Filter to show only this order
            $this->filteredOrders = $this->orders->where('tracking_code', $this->trackingCode);
        } else {
            session()->flash('error', 'Order not found.');
            $this->filteredOrders = collect();
        }
    }

    public function clearFilter()
    {
        $this->trackingCode = '';
        $this->filteredOrders = $this->orders;
        session()->forget('error');
    }

    public function render()
    {
        return view('livewire.order-tracking')->layout('layouts.front');
    }
}
