<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

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
        return $this->belongsTo(Department::class, 'dept_id');
    }

    // Get User Type Function
    // public function getUserType()
    // {
    //     $role = $this->account_role->role_id;
    //     if ($role === 1) {
    //         return 'main_admin';
    //     } elseif ($role === 2) {
    //         return 'department_admin';
    //     } elseif ($role === 3) {
    //         return 'staff';
    //     } elseif ($role === 4) {
    //         return 'librarian';
    //     }
    // }
    // End

    protected function type(): Attribute
    {
        return new Attribute(
            // ? 0 = MA, 1 = DA, 2 = DS, 3 = L
            // ? MA = Main Admin, DA = Department Admin, DS = Department Staff, L = Librarian
            get: fn ($value) =>  ["Main Admin", "Department Admin", "Staff", "Library"][$value],
        );
    }
}