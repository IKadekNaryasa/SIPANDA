<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class formEditKendaraan extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array|object $kendaraan,
        public array|object $users,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form-edit-kendaraan');
    }
}
