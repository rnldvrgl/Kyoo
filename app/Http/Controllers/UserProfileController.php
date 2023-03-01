<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\AccountRole;
use App\Models\Accounts;
use App\Models\Department;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $accounts = Accounts::find(session('account_id'));
        return view('common.user-profile', [
            'details' => AccountDetails::find($accounts->details_id),
            'role' => AccountRole::find($accounts->role_id),
            'login' => AccountLogin::find($accounts->login_id),
            'department' => Department::find($accounts->department_id),
        ]);
    }
}
