<?php

namespace App\View\Components\categories;

use App\Models\Category;
use Illuminate\View\Component;

class CategoriesGrid extends Component
{
    public $categories = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(  $categories)
    {
        $this->categories =  $categories;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.categories.categories-grid');
    }
}
