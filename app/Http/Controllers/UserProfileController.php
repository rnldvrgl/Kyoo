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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            'department' => Department::find($accounts->department_id),
        ];
    }

    public function index()
    {
        return view('common.user-profile', [
            'user_data' => $this->getUserData(),
        ]);
    }

    public function updateDetails(Request $request, $id)
    {
        Log::info('Name: ' . $request->name);

        // Find the user with the given id
        $accounts = Accounts::find($id);
        $account_details = AccountDetails::find($accounts->details_id);

        // Define the validation messages in an array variable
        $messages = [
            'name.required' => 'Please provide your full name.',
            'name.regex' => 'Your name must only contain letters.',
            'name.min' => 'Your full name must be at least :min characters long.',
            'name.max' => 'Your full name must be at most :max characters long.',
            'about.required' => 'Provide something about yourself.',
            'about.min' => 'Your About must be at least :min characters long.',
            'address.required' => 'Please provide your address.',
            'phone.regex' => 'Please provide a valid phone number.',
            'phone.required' => 'Please provide your phone number.',
            'profile_image.mimes' => 'Your profile image must be a JPEG or PNG.',
        ];

        // Validate
        $validatedData = Validator::make($request->all(), [
            'name' => ['required', "regex:/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/", 'min:5', 'max:75'],
            'about' => ['required', 'string', 'min:10'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'regex:/^(09|\+639)\d{9}$/'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png']
        ], $messages);

        # check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        $profile_image = null;
        # check if the request has profile image
        if ($request->hasFile('profile_image')) {
            $filename = $request->file('profile_image')->getClientOriginalName();
            $profile_image = $filename;
            $request->file('profile_image')->storeAs('public/profile_images', $filename);
            $imagePath = 'storage/app/public/profile_images/' . $account_details->profile_image;
            # check whether the old image exists in the directory
            if (File::exists($imagePath)) {
                # delete old image
                File::delete($imagePath);
            }
        }

        // Update the user details
        $account_details->update([
            'name' => $request->name,
            'about' => $request->about,
            'address' => $request->address,
            'phone' => $request->phone,
            'profile_image' => $profile_image ?? $account_details->profile_image
        ]);



        // Redirect
        return response()->json(['code' => 200, 'msg' => 'Profile Updated Successfully.']);
    }


    public function updatePassword(Request $request, $id)
    {
        // Find the user with the given id
        $account_login = AccountLogin::find($id);

        // Define the validation messages in an array variable
        $messages = [
            'password.required' => 'Please provide your current password.',
            'newpassword.required' => 'Please provide a new password.',
            'newpassword.confirmed' => 'Your new password does not match your confirmation password.',
        ];

        // Validate
        $validatedData = Validator::make($request->all(), [
            'password' => ['required', new MatchCurrentPassword],
            'newpassword' => ['required', 'confirmed'],
        ], $messages);

        # check if their is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Hash the new password
        $newpassword = Hash::make($request->newpassword);

        // Update the password on the database
        $account_login->update([
            'password' => $newpassword
        ]);

        // Redirect
        return response()->json(['code' => 200, 'msg' => 'Password Updated Successfully.']);
    }
}
