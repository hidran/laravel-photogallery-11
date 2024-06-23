<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class alertInfo extends Component
{
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = session()->get('message');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.alert-info');
    }
}
