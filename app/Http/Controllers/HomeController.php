<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\AccountRole;
use Illuminate\Http\Request;
use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\Department;
use App\Models\Service;

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
			'department' => Department::find($accounts->department_id),
		];
	}

	public function getAllData()
	{
		$department = Department::all();
		$role = AccountRole::all();
		$login = AccountLogin::all();
		$details = AccountDetails::all();
		$services = Service::all();

		$data = [
			'departments' => $department,
			// 'services' => $services,
			'account_roles' => $role,
			'account_logins' => $login,
			'account_details' => $details,
		];

		return $data;
	}

	// TODO: Isang function for dashboard, concat the role
	public function main_admin(QueueTicketController $queueTicketController)
	{
		return view('dashboard.main_admin.dashboard', [
			'user_data' => $this->getUserData(),
			'all_data' => $this->getAllData(),
			'queue_ticket_data' => $queueTicketController->getQueueTickets(),
			'pending_tickets' => $queueTicketController->countPendingTickets(),
			'serving_tickets' => $queueTicketController->countServingTickets(),
			'served_tickets' => $queueTicketController->countServedTickets(),
			'cancelled_tickets' => $queueTicketController->countCancelledTickets(),
		]);
	}

	public function department_admin()
	{
		return view('dashboard.department_admin.dashboard', [
			'user_data' => $this->getUserData(),
		]);
	}

	public function staff()
	{
		return view('dashboard.staff.dashboard', [
			'user_data' => $this->getUserData(),
		]);
	}
}
