<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Reservation extends Component
{
    public $restaurant;
    public $date_live;
    public $time_live;
    public $number_live;
    public $times;
    public $peoples;

    public function mount($restaurant, $times, $peoples)
    {
        $this->restaurant = $restaurant;
        $this->times = $times;
        $this->peoples = $peoples;
    }

    public function render()
    {
        return view('livewire.reservation');
    }
}
