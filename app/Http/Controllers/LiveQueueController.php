<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\PromotionalText;
use App\Models\PromotionalVideo;
use App\Models\QueueTicket;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LiveQueueController extends Controller
{
    // Get data required for live queue
    public function getQueueData()
    {
        $departments = Department::all();
        $tickets = QueueTicket::all();

        // Loop through each department and get the current ticket number
        foreach ($departments as $department) {
            // Get the current ticket for this department
            $current_ticket = $tickets->where('department_id', $department->id)
                ->whereIn('status', ['Pending', 'Calling'])
                ->first();

            // Set the ticket number to null if no current ticket
            $ticket_number = $current_ticket ? $current_ticket->ticket_number : null;

            // Add the ticket number to the department object
            $department->ticket_number = $ticket_number;
        }

        return [
            'departments' => $departments,
        ];
    }

    // Live Queue Index Page
    public function index()
    {
        // Get all departments
        $departments = Department::all();
        $promotional_message = PromotionalText::all();
        $ticket_data = [
            'departments' => []
        ];

        // Loop through each department and get the current ticket number
        foreach ($departments as $department) {
            // Get the current ticket for this department
            $current_ticket = QueueTicket::where('department_id', $department->id)
                ->whereIn('status', ['Serving', 'Calling'])
                ->first();

            // Set the ticket number to null if no current ticket
            $ticket_number = $current_ticket ? $current_ticket->ticket_number : null;

            // Assign the ticket number to the department object
            $department->ticket_number = $ticket_number;

            // Add the department object to the array
            $ticket_data['departments'][] = $department;
        }


        // Return view with departments data
        return view('live_queue', compact('ticket_data', 'promotional_message'));
    }
}
