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
        'service_department_id',
        'waiting_time',
        'serving_time',
        'called_at',
        'served_at',
        'completed_at',
    ];

    protected $with = ['serviceDepartment'];

    public function serviceDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'queue_ticket_service', 'ticket_id', 'service_id');
    }

    public static function getPendingTicketsForDepartment($departmentId)
    {
        return self::where('department_id', $departmentId)
            ->where('status', 'pending')
            ->orderBy('created_at', 'ASC')
            ->get();
    }
}
