<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCounter extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'date',
        'ticket_number',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
