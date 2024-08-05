<?php

namespace App\View\Components\Elementor;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Block extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'blade'
<div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div>
blade;
    }
}
