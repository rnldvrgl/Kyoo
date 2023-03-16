<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(QueueTicket::class, 'queue_ticket_service', 'service_id', 'ticket_id');
    }

    // For Storing a Service
    public static function checkService($service, $id)
    {
        // Check the service if it exist with the same department_id
        return self::where('name', $service)->where('department_id', '=', $id)->exists();
    }
}
