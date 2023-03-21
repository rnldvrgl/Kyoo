<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SignedClearance extends Component
{
    public $ticketId;
    public $queueNumber;
    public $queueTime;
    public $studentName;
    public $department;
    public $course;
    public $services;
    public $serviceDepartment;
    public $position;
    public $clearancestatus;

    public function __construct($ticketId, $queueNumber, $queueTime, $studentName, $department, $course, $services, $serviceDepartment, $position, $clearancestatus)
    {
        $this->ticketId = $ticketId;
        $this->queueNumber = $queueNumber;
        $this->queueTime = $queueTime;
        $this->studentName = $studentName;
        $this->department = $department;
        $this->course = $course;
        $this->services = $services;
        $this->serviceDepartment = $serviceDepartment;
        $this->position = $position;
        $this->clearancestatus = $clearancestatus;
    }

    public function render()
    {
        return view('components.signed-clearance');
    }
}
