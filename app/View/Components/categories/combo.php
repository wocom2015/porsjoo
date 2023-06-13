<?php

namespace App\View\Components\categories;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class combo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $list , public string $name)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories.combo');
    }
}
