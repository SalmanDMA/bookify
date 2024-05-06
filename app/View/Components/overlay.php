<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class overlay extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $isOpen
    ) {
        //
    }

    public function isOpen()
    {
        if ($this->isOpen == 'true') {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.overlay');
    }
}
