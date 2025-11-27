<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $name;
    public $email;
    public $phone;
    public $date;
    public $time;
    public $guests;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'guests' => 'required|integer|min:1',
    ];

    public function bookTable()
    {
        $this->validate();

        \App\Models\Reservation::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date' => $this->date,
            'time' => $this->time,
            'guests' => $this->guests,
        ]);

        $this->reset();
        session()->flash('message', 'Reservation submitted successfully!');
    }

    public function render()
    {
        return view('livewire.home')->layout('layouts.front');
    }
}
