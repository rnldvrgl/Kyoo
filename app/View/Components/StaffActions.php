<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StaffActions extends Component
{
    public $status;
    public $canTakeBreak;
    public function __construct($status, $canTakeBreak)
    {
        $this->status = $status;
        $this->canTakeBreak = $canTakeBreak;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.staff-actions');
    }
}
