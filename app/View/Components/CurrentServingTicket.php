<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CurrentServingTicket extends Component
{
    public $ticketId;
    public $queueNumber;
    public $queueTime;
    public $studentName;
    public $department;
    public $course;
    public $services;
    public $clearancestatus;
    public $serviceDepartment;
    public $serviceDepartmentId;
    public $notes;

    public function __construct($ticketId, $queueNumber, $queueTime, $studentName, $department, $course, $services, $clearancestatus, $serviceDepartment, $serviceDepartmentId, $notes)
    {
        $this->ticketId = $ticketId;
        $this->queueNumber = $queueNumber;
        $this->queueTime = $queueTime;
        $this->studentName = $studentName;
        $this->department = $department;
        $this->course = $course;
        $this->services = $services;
        $this->clearancestatus = $clearancestatus;
        $this->serviceDepartment = $serviceDepartment;
        $this->serviceDepartmentId = $serviceDepartmentId;
        $this->notes = $notes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.current-serving-ticket');
    }
}
