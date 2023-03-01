<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\AccountRole;
use App\Models\Accounts;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    // Fetches all User Data from the database
    protected function getUserData()
    {
        $accounts = Accounts::find(session('account_id'));

        return [
            'details' => AccountDetails::find($accounts->details_id),
            'role' => AccountRole::find($accounts->role_id),
            'login' => AccountLogin::find($accounts->login_id),
            'department' => Department::find($accounts->dept_id),
        ];
    }


    public function index()
    {
        return view('common.user-profile', $this->getUserData());
    }
}
