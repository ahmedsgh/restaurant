<?php

namespace App\Livewire\Admin\Reservations;

use Livewire\Component;

class Index extends Component
{
    public $reservations;

    public function render()
    {
        $this->reservations = \App\Models\Reservation::latest()->get();
        return view('livewire.admin.reservations.index')->layout('layouts.app');
    }

    public function updateStatus($id, $status)
    {
        $reservation = \App\Models\Reservation::findOrFail($id);
        $reservation->status = $status;
        $reservation->save();

        session()->flash('message', 'Reservation status updated successfully.');
    }

    public function delete($id)
    {
        \App\Models\Reservation::find($id)->delete();
        session()->flash('message', 'Reservation deleted successfully.');
    }
}
