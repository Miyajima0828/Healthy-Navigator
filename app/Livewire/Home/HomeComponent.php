<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HomeComponent extends Component
{
    public string $message = '';


    public function render()
    {
        return view('livewire.home.home');
    }
}
