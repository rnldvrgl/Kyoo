<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\AccountRole;
use Illuminate\Http\Request;
use App\Models\AccountDetails;

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

	public function mainAdmin()
	{
		$accounts = Accounts::find(session('account_id'));

		return view('dashboard.main_admin.dashboard', [
			'details' => AccountDetails::find($accounts->details_id),
			'role' => AccountRole::find($accounts->role_id)
		]);
	}

	public function depAdmin()
	{
		$accounts = Accounts::find(session('account_id'));

		return view('dashboard.main_admin.dashboard', [
			'details' => AccountDetails::find($accounts->details_id),
			'role' => AccountRole::find($accounts->role_id)
		]);

		return view('dashboard.department_admin.dashboard');
	}

	public function staff()
	{
		$accounts = Accounts::find(session('account_id'));

		return view('dashboard.main_admin.dashboard', [
			'details' => AccountDetails::find($accounts->details_id),
			'role' => AccountRole::find($accounts->role_id)
		]);

		return view('dashboard.staff.dashboard');
	}

	public function librarian()
	{
		$accounts = Accounts::find(session('account_id'));

		return view('dashboard.main_admin.dashboard', [
			'details' => AccountDetails::find($accounts->details_id),
			'role' => AccountRole::find($accounts->role_id)
		]);

		return view('dashboard.librarian.dashboard');
	}
}
