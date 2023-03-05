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
        $accounts = Accounts::with('account_details', 'account_login', 'account_role', 'department')->select('accounts.*');

        return DataTables::eloquent($accounts)
            ->smart()
            ->addColumn('actions', function ($account) {
                // Add your action buttons here
                $viewUrl = route('manage.accounts.show', $account->id);
                $editUrl = route('manage.accounts.edit', $account->id);
                $deleteUrl = route('manage.accounts.destroy', $account->id);

                return '<a href="' . $viewUrl . '" class="btn btn-primary view-account"><i class="fa-solid fa-eye"></i></a>
                        <a href="' . $editUrl . '" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="' . $deleteUrl . '" method="POST" class="d-inline-block">
                            ' . method_field('DELETE') . csrf_field() . '
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm(\'Are you sure you want to delete this account?\')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_data = (new HomeController)->getUserData();
        $all_data = (new HomeController)->getAllData();

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
        // dd($request);

        // Message
        $messages = [
            'fullname.required' => 'Full name is required.',
            'fullname.regex' => 'Please enter a valid name.',
            'fullname.min' => 'Fullname name must be at least :min characters long.',
            'fullname.max' => 'Fullname name must be at most :max characters long.',
            'department.required' => 'Select a Department.',
            'role.required' => 'Select a Role.',
        ];

        // Validate
        $validatedData = Validator::make($request->except('_token'), [
            'fullname' => ['required', "regex:/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/", 'min:5', 'max:75'],
            'email' => ['required', 'email'],
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
        $dept_id = $validatedData->validated()['department'];
        $role_id = $validatedData->validated()['role'];

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
            'dept_id' => $dept_id,
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
    public function show(HomeController $homeController, $id)
    {
        // Redirect to the View page along with the user's records
        return view('dashboard.main_admin.manage.accounts.view', [
            'user_data' => $homeController->getUserData(),
            'account' => Accounts::with('account_details', 'account_login', 'account_role', 'department')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeController $homeController, $id)
    {
        // Redirect to the View page along with the user's records
        return view('dashboard.main_admin.manage.accounts.edit', [
            'user_data' => $homeController->getUserData(),
            'all_data' => $homeController->getAllData(),
            'account' => Accounts::with('account_details', 'account_login', 'account_role', 'department')->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete
        // dd("Delete method working, here is the ID $id");

        // Find the user by id
        $account = Accounts::findOrFail($id);
        
        // Delete the account
        $account->delete();
        
        // Redirect to the index page with a success message
        return redirect()->route('manage.accounts.index')->with('deleteSuccess', 'Account deleted successfully');
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
