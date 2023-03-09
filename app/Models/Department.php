<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'status'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function serviceDepartmentTickets()
    {
        return $this->hasMany(QueueTicket::class, 'service_department_id');
    }
}
