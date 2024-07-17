<?php

namespace App\Livewire\Home;

use Illuminate\View\View;
use Livewire\Component;

/**
 * @property string message
 */
class HomeComponent extends Component
{
    public string $message = '';

    /**
     * @return view
     */
    public function render(): View
    {
        return view('livewire.home.home');
    }
}
