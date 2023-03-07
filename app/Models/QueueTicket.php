<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'student_name',
        'student_department',
        'student_course',
        'status',
        'service_department_id'
    ];

    public function serviceDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'queue_ticket_service', 'ticket_id', 'service_id');
    }
}
