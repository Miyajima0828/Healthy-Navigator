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
    // ビューの名前
    const VIEW_NAME = 'livewire.home.home';

    /**
     * @return view
     */
    public function render(): View
    {
        return view(self::VIEW_NAME);
    }
}
