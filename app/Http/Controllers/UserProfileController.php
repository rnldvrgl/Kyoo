<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Department;
use App\Models\AccountRole;
use App\Models\AccountLogin;
use Illuminate\Http\Request;
use App\Models\AccountDetails;
use App\Rules\MatchCurrentPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Fetches all User Data from the database
    protected function getUserData($id = null)
    {
        $id = $id ?? session('account_id');
        $accounts = Accounts::find($id);

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
        // Define the validation messages in an array variable
        $messages = [
            'name.required' => 'Please provide your full name.',
            'name.min' => 'Your full name must be at least :min characters long.',
            'name.max' => 'Your full name must be at most :max characters long.',
            'about.required' => 'Provide something about yourself.',
            'about.min' => 'Your About must be at least :min characters long.',
            'address.required' => 'Please provide an address.',
            'phone.required' => 'Please provide a phone number.'
        ];

        // Validate
        $validatedData = $request->validate([
            'name' => 'required|string|min:5|max:100',
            'about' => 'required|string|min:10',
            'address' => 'required|string',
            'phone' => 'required|numeric'
        ], $messages);

        // Find the user with the given id
        $accounts = Accounts::find($id);
        $account_details = AccountDetails::find($accounts->details_id);

        // Update the user details
        $account_details->update($validatedData);

        // Redirect
        return redirect()->route('user_profile')->with('updateSuccess', 'Your profile has been successfully updated.');
    }

    public function updatePassword(Request $request, $id)
    {
        // Validate
        $validatedData = $request->validate([
            'password' => ['required', new MatchCurrentPassword],
            'newpassword' => ['required', 'confirmed'],
        ], [
            'newpassword.confirmed' => 'Your new password does not match your confirmation password.',
        ]);

        // Hash the new password
        $newpassword = Hash::make($validatedData['newpassword']);

        // Find the user with the given id
        $account_login = AccountLogin::find($id);

        // Update the password on the database
        $account_login->update([
            'password' => $newpassword
        ]);

        // Redirect
        return redirect()->route('user_profile')->with('passwordSuccess', 'Your password has been successfully updated .');
    }
}
