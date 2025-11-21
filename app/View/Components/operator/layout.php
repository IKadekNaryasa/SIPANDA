<?php

namespace App\View\Components\operator;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class layout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $open,
        public string $active,
        public string $link,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.operator.layout');
    }
}
