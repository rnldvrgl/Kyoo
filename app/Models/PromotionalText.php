<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionalText extends Model
{
    use HasFactory;

    protected $fillable = ['text'];
}
