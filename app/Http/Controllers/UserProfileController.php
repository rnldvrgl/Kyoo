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
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function updateDetails(Request $request, $id)
    {

        // Validate
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'about' => 'required|string|min:5',
            'address' => 'required|string',
            'phone' => 'required|numeric'
        ]);

        // Find the user with the given id

        // Update the user details

        // Save the updated user details

        // Redirect
    }
}
