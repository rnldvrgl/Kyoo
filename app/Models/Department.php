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
        'status'
    ];

    public function accounts()
    {
        return $this->hasMany(Accounts::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
