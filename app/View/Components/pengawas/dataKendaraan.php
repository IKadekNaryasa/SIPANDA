<?php

namespace App\View\Components\pengawas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dataKendaraan extends Component
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
        return view('components.pengawas.data-kendaraan');
    }
}
