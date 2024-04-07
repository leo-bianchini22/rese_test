<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReservationEdit extends Component
{
    public $restaurant;
    public $reservation;
    public $date_live;
    public $time_live;
    public $number_live;
    public $times;
    public $peoples;

    public function mount($restaurant, $reservation, $times, $peoples)
    {
        $this->restaurant = $restaurant;
        $this->reservation = $reservation;
        $this->times = $times;
        $this->peoples = $peoples;
    }

    public function render()
    {
        return view('livewire.reservation-edit');
    }
}
