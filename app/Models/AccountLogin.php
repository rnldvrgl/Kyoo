<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLogin extends Model
{
    use HasFactory;

    public function accounts()
    {
        return $this->belongsTo(Accounts::class, 'login_id');
    }
}
