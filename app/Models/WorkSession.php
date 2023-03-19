<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSession extends Model
{
    use HasFactory;

    public function account_login()
    {
        return $this->belongsTo(AccountLogin::class, 'login_id');
    }
}
