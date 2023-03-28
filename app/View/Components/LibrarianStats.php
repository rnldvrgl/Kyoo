<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LibrarianStats extends Component
{
    public $countSignedClearances;
    public $countClearedClearances;
    public $countUnclearedClearances;
    public $departmentId;

    public function __construct($countSignedClearances, $departmentId, $countClearedClearances, $countUnclearedClearances)
    {
        $this->countSignedClearances = $countSignedClearances;
        $this->countClearedClearances = $countClearedClearances;
        $this->countUnclearedClearances = $countUnclearedClearances;
        $this->departmentId = $departmentId;
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
