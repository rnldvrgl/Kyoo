<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\AccountRole;
use Illuminate\Http\Request;
use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\Department;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */

	public function index()
	{
		return view('welcome');
	}

	// Fetches all User Data from the database
	public function getUserData()
	{
		$accounts = Accounts::find(session('account_id'));

		return [
			'details' => AccountDetails::find($accounts->details_id),
			'role' => AccountRole::find($accounts->role_id),
			'login' => AccountLogin::find($accounts->login_id),
			'department' => Department::find($accounts->dept_id),
		];
	}

	// TODO: Isang function for dashboard, concat the role
	public function main_admin()
	{
		return view('dashboard.main_admin.dashboard', $this->getUserData());
	}

	public function department_admin()
	{
		return view('dashboard.department_admin.dashboard', $this->getUserData());
	}

	public function staff()
	{
		return view('dashboard.staff.dashboard', $this->getUserData());
	}

	public function librarian()
	{
		return view('dashboard.librarian.dashboard', $this->getUserData());
	}
}
