<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return string
     */
    public function render(): string
    {
        return <<<'blade'
<div class="alert alert-info">
   {{$slot}}
</div>
blade;
    }
}
