<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $fillable = ['details_id', 'login_id', 'role_id', 'department_id'];

    protected $with = ['account_details', 'account_login', 'account_role', 'department'];

    public function account_details()
    {
        return $this->belongsTo(AccountDetails::class, 'details_id');
    }

    public function account_login()
    {
        return $this->belongsTo(AccountLogin::class, 'login_id');
    }

    public function account_role()
    {
        return $this->belongsTo(AccountRole::class, 'role_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["Main Admin", "Department Admin", "Staff", "Library"][$value],
        );
    }
}
