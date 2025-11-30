<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;

class Index extends Component
{
    public $orders;
    public $selectedOrder;
    public $newStatus;

    public function render()
    {
        $this->orders = \App\Models\Order::with('items.product')->latest()->get();
        return view('livewire.admin.orders.index')->layout('layouts.admin', ['title' => __('all.Orders')]);
    }

    public function viewOrder($id)
    {
        $this->selectedOrder = \App\Models\Order::with('items.product')->findOrFail($id);
    }

    public function updateStatus($orderId, $status)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $order->status = $status;
        $order->save();

        session()->flash('message', 'Order status updated successfully.');
        $this->selectedOrder = null;
    }

    public function closeModal()
    {
        $this->selectedOrder = null;
    }
}
