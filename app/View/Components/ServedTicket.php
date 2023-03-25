<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServedTicket extends Component
{
    public $ticketId;
    public $queueNumber;
    public $queueTime;
    public $studentName;
    public $department;
    public $course;
    public $services;
    public $status;

    public function __construct($ticketId, $queueNumber, $queueTime, $studentName, $department, $course, $services, $status)
    {
        $this->ticketId = $ticketId;
        $this->queueNumber = $queueNumber;
        $this->queueTime = $queueTime;
        $this->studentName = $studentName;
        $this->department = $department;
        $this->course = $course;
        $this->services = $services;
        $this->status = $status;
    }

    public function render()
    {
        return view('components.served-ticket');
    }
}
