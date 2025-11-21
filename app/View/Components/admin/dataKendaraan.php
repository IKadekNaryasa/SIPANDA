<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dataKendaraan extends Component
{
    public $kendaraans;
    /**
     * Create a new component instance.
     */
    public function __construct($kendaraans)
    {
        $this->kendaraans = $kendaraans;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.data-kendaraan');
    }
}
