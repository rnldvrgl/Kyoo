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
    public $position;
    public $hasCurrentServingTicket;
    public $clearancestatus;
    public $serviceDepartmentId;
    public $notes;
    public $transferNotes;

    public function __construct($ticketId, $queueNumber, $queueTime, $studentName, $department, $course, $services, $serviceDepartment, $position, $hasCurrentServingTicket, $clearancestatus, $serviceDepartmentId, $notes, $transferNotes)
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
        $this->hasCurrentServingTicket = $hasCurrentServingTicket;
        $this->clearancestatus = $clearancestatus;
        $this->serviceDepartmentId = $serviceDepartmentId;
        $this->notes = $notes;
        $this->transferNotes = $transferNotes;
    }

    public function render()
    {
        return view('components.queue-card');
    }
}
