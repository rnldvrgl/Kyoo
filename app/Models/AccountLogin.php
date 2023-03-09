<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLogin extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function accounts()
    {
        return $this->belongsTo(Accounts::class, 'login_id');
    }

    // public static function checkDuplicateEmail($email)
    // {
    //     return self::where(['email' => $email])->exists();
    // }

    public static function checkEmail($email, $id = null)
    {
        return self::where('email', $email)
            ->where('id', '<>', $id)
            ->exists();
    }
}
