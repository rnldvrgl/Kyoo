<?php

namespace App\View\Components;

use Illuminate\View\Component;

class QueueCard extends Component
{
    public $queueNumber;
    public $queueTime;
    public $studentName;
    public $department;
    public $course;
    public $services;

    public function __construct($queueNumber, $queueTime, $studentName, $department, $course, $services)
    {
        $this->queueNumber = $queueNumber;
        $this->queueTime = $queueTime;
        $this->studentName = $studentName;
        $this->department = $department;
        $this->course = $course;
        $this->services = $services;
    }

    public function render()
    {
        return view('components.queue-card');
    }
}
