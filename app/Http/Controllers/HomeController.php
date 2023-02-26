<?php

namespace App\Http\Controllers;

use App\Models\AccountDetails;
use App\Models\Accounts;
use Illuminate\Http\Request;

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
		return view('dashboard.main_admin.dashboard');
	}

	public function depAdmin()
	{
		return view('dashboard.department_admin.dashboard');
	}

	public function staff()
	{
		return view('dashboard.staff.dashboard');
	}

	public function librarian()
	{
		return view('dashboard.librarian.dashboard');
	}
}
