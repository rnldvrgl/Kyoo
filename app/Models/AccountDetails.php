<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'about',
        'profile_image'
    ];

    public function accounts()
    {
        return $this->belongsTo(Accounts::class, 'details_id');
    }
}
