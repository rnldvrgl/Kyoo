<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRole extends Model
{
    use HasFactory;

    public function accounts()
    {
        // return $this->belongsTo(Accounts::class, 'role_id');

        return $this->hasMany(Accounts::class, 'role_id');
    }
}
