<?php

// app/View/Components/DepartmentCard.php

namespace App\View\Components;

use Illuminate\View\Component;

class DepartmentCard extends Component
{
    public $department;

    public function __construct($department)
    {
        $this->department = $department;
    }

    public function render()
    {
        return view('components.department-card');
    }
}
