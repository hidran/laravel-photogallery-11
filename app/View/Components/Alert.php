<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    public string $info;
    public string $message;
    public string $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = '', $info = '', $message = '')
    {
        $this->info = $info;
        $this->message = $message;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.alert');
    }
}
