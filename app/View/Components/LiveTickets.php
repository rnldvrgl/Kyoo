<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LiveTickets extends Component
{

    public $departmentName;
    public $ticketNumber;
    public $ticketStatus;

    public function __construct($departmentName, $ticketNumber, $ticketStatus)
    {
        $this->departmentName = $departmentName;
        $this->ticketNumber = $ticketNumber;
        $this->ticketStatus = $ticketStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.live-tickets');
    }
}
