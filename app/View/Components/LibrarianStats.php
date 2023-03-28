<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LibrarianStats extends Component
{
    public $collegeCountSC;

    public function __construct($collegeCountSC)
    {
        $this->collegeCountSC = $collegeCountSC;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.librarian-stats');
    }
}
