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
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [
        'accounts'
    ];

    public function accounts()
    {
        return $this->belongsTo(Accounts::class, 'login_id');
    }

    public function work_sessions()
    {
        return $this->hasMany(WorkSession::class, 'login_id');
    }

    public static function checkEmail($email, $id = null)
    {
        // Check service table where the email (user input) exists on the email column, exclude the email address with the same id
        return self::where('email', $email)
            ->where('id', '<>', $id)
            ->exists();
    }

    public function updateAccountStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}
