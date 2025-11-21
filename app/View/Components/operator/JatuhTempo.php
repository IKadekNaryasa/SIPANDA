<?php

namespace App\View\Components\operator;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JatuhTempo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array|object $kendaraanJatuhTempo
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.operator.jatuh-tempo');
    }
}
