<?php

namespace App\View\Components\operator;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class kendaraanByOperator extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array|object $kendaraans
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.operator.kendaraan-by-operator');
    }
}
