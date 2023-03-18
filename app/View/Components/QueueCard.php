<?php

namespace App\View\Components;

use Illuminate\View\Component;

class QueueCard extends Component
{
    public $ticketId;
    public $queueNumber;
    public $queueTime;
    public $studentName;
    public $department;
    public $course;
    public $services;
    public $serviceDepartment;

    public function __construct($ticketId, $queueNumber, $queueTime, $studentName, $department, $course, $services, $serviceDepartment)
    {
        $this->ticketId = $ticketId;
        $this->queueNumber = $queueNumber;
        $this->queueTime = $queueTime;
        $this->studentName = $studentName;
        $this->department = $department;
        $this->course = $course;
        $this->services = $services;
        $this->serviceDepartment = $serviceDepartment;
    }

    public function render()
    {
        return view('components.queue-card');
    }
}
