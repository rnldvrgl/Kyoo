<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Department;
use App\Models\AccountRole;
use App\Models\AccountLogin;
use Illuminate\Http\Request;
use App\Models\AccountDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();

        return view('dashboard.main_admin.manage.accounts.list', with([
            'user_data' => $user_data,
        ]));
    }

    public function fetchAccounts()
    {
        $accounts = Accounts::with('account_details', 'account_login', 'account_role', 'department')
            ->select('accounts.*')
            ->whereHas('account_role', function ($query) {
                $query->where('name', '<>', 'Main Admin');
            })
            ->orderByDesc('accounts.created_at');

        return DataTables::eloquent($accounts)
            ->smart()
            ->addColumn('actions', function ($account) {
                // Add your action buttons here
                $viewUrl = route('manage.accounts.show', $account->id);
                $editUrl = route('manage.accounts.edit', $account->id);
                // $deleteUrl = route('manage.accounts.delete', $account->id);

                return
                    '<div class="hstack mx-auto">' .
                    // View 
                    '<form action="' . $viewUrl . '" method="POST">' .
                    csrf_field() .
                    '<input name="account_id" type="hidden" value="' . $account->id . '"/>' .
                    '<button type="submit" class="btn btn-primary me-md-1"><i class="fa-solid fa-eye"></i></button>' .
                    '</form>' .

                    // Update
                    '<form action="' . $editUrl . '" method="POST">' .
                    csrf_field() .
                    '<input name="account_id" type="hidden" value="' . $account->id . '"/>' .
                    '<button type="submit" class="btn btn-secondary me-md-1"><i class="fa-solid fa-pen-to-square"></i></button>' .
                    '</form>' .

                    // Delete
                    '<div class="d-grid">' .
                    '<button class="btn btn-danger delete-account" data-account-id="' . $account->id . '">' .
                    '<i class="fa-solid fa-trash"></i>' .
                    '</button>' .
                    '</div>' .
                    '</div>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();
        $all_data = $homeController->getAllData();

        return view('dashboard.main_admin.manage.accounts.add', [
            'user_data' => $user_data,
            'all_data' => $all_data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Message
        $messages = [
            'fullname.required' => 'Full name is required.',
            'fullname.regex' => 'Please enter a valid name.',
            'fullname.min' => 'Fullname name must be at least :min characters long.',
            'fullname.max' => 'Fullname name must be at most :max characters long.',
            'email.unique' => 'Email address is already taken.',
            'department.required' => 'Select a Department.',
            'role.required' => 'Select a Role.',
        ];

        // Validate
        $validatedData = Validator::make($request->except('_token'), [
            'fullname' => ['required', "regex:/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/", 'min:5', 'max:75'],
            'email' => ['required', 'email', 'unique:account_logins'],
            'department' => ['required'],
            'role' => ['required'],
        ], $messages);

        // check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Access each validated data
        $fullname = $validatedData->validated()['fullname'];
        $email = $validatedData->validated()['email'];
        $department_id = $validatedData->validated()['department'];
        $role_id = $validatedData->validated()['role'];

        // Check if the email is already in the database
        $checkEmail = AccountLogin::checkEmail($email);

        // check if there is any error
        if ($checkEmail == true) {
            $error = [
                'error' => 'Email already exists'
            ];
            return response()->json(['code' => 400, 'errors' => $error]);
        }

        // Insert on each tables
        $account_details = AccountDetails::create([
            'name' => $fullname,
        ]);

        $account_login = AccountLogin::create([
            'email' => $email,
            'password' => $this->default_password_generator($fullname),
            // Sample: Fullname = Ronald Vergel C. Dela Cruz | Password = ronaldvergelcdelacruz
        ]);

        // Insert them on the bridge table
        Accounts::create([
            'details_id' => $account_details->id,
            'login_id' => $account_login->id,
            'role_id' => $role_id,
            'department_id' => $department_id,
        ]);

        // Redirect
        return response()->json(['code' => 200, 'msg' => 'Account created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HomeController $homeController, Request $request)
    {
        $account = Accounts::with('account_details', 'account_login', 'account_role', 'department')->findOrFail($request->account_id);

        // Redirect to the View page along with the user's records
        return view('dashboard.main_admin.manage.accounts.view', [
            'user_data' => $homeController->getUserData(),
            'account' => $account
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeController $homeController, Request $request)
    {
        // Redirect to the View page along with the user's records
        return view('dashboard.main_admin.manage.accounts.edit', [
            'user_data' => $homeController->getUserData(),
            'all_data' => $homeController->getAllData(),
            'account' => Accounts::with('account_details', 'account_login', 'account_role', 'department')->findOrFail($request->input('account_id'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $accounts = Accounts::with('account_details', 'account_login')->findOrFail($request->id);

        // Define the validation messages in an array variable
        $messages = [
            'fullname.required' => 'Please provide a full name.',
            'fullname.regex' => 'Name must only contain letters.',
            'fullname.min' => 'Full name must be at least :min characters long.',
            'fullname.max' => 'Full name must be at most :max characters long.',
            'email.required' => 'Please provide a valid email address.',
            'email.email' => 'Invalid Email Address.'
        ];

        // Validate
        $validatedData = Validator::make($request->all(), [
            'fullname' => ['required', "regex:/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/", 'min:5', 'max:75'],
            'email' => ['required', 'email'],
        ], $messages);

        // check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Check if email already exists
        $checkEmail = AccountLogin::checkEmail($validatedData->validated()['email'], $accounts->login_id);

        if ($checkEmail == false) {
            // Email exists?
            $error = [
                'errors' => 'Email already exists'
            ];
            return response()->json(['code' => 400, 'errors' => $error]);
        }

        // dd($accounts);

        // Update the user details
        $accounts->account_details->where('id', $accounts->details_id)->update([
            'name' => $validatedData->validated()['fullname'],
        ]);

        $accounts->account_login->where('id', $accounts->login_id)->update([
            'email' => $validatedData->validated()['email'],
        ]);

        $accounts->update([
            'department_id' => $request->department,
            'role_id' => $request->role,
        ]);

        // Redirect
        return response()->json(['code' => 200, 'msg' => 'Account Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the user by id
        $account = Accounts::with(['account_details', 'account_login'])->findOrFail($id);

        // Delete the account
        $account->account_details->delete();
        $account->account_login->delete();
        $account->delete();

        // Redirect to the index page with a success message
        return response()->json(['code' => 200, 'message' => 'Account deleted successfully']);
        // return redirect()->route('manage.accounts.index')->with('deleteSuccess', 'Account deleted successfully');
    }

    protected function default_password_generator($fullname)
    {
        // Convert fullname to lowercase
        $fullname = strtolower($fullname);

        // Replace spaces with underscores
        $fullname = str_replace(' ', '_', $fullname);

        // Remove dots and other special characters
        $fullname = preg_replace('/[^A-Za-z0-9\-]/', '', $fullname);

        // Hash the password
        $password = Hash::make($fullname);

        return $password;
    }
}
