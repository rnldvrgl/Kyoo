<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServingStats extends Component
{
    public $avgServingTime;
    public $countCompletedTickets;
    public $countCancelledTickets;
    public $avgWaitTime;

    public function __construct($avgServingTime, $countCompletedTickets, $countCancelledTickets, $avgWaitTime)
    {
        $this->avgServingTime = $avgServingTime;
        $this->countCompletedTickets = $countCompletedTickets;
        $this->countCancelledTickets = $countCancelledTickets;
        $this->avgWaitTime = $avgWaitTime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.serving-stats');
    }
}
