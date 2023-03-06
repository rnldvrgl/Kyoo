<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueTicketService extends Model
{
    protected $fillable = ['ticket_id', 'service_id'];

    public function ticket()
    {
        return $this->belongsTo(QueueTicket::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
