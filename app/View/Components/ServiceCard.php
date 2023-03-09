<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceCard extends Component
{
    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.service-card');
    }
}
