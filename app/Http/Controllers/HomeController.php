<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\AccountRole;
use App\Models\AccountDetails;
use App\Models\AccountLogin;
use App\Models\Department;
use App\Models\Feedback;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

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
		$role = AccountRole::where('name', '!=', 'Main Admin')->get();
		$login = AccountLogin::all();
		$details = AccountDetails::all();
		$services = Service::all();

		$data = [
			'departments' => $department,
			'services' => $services,
			'account_roles' => $role,
			'account_logins' => $login,
			'account_details' => $details,
		];

		return $data;
	}

	public function getDepartmentAllData()
	{
		$accountLogin = AccountLogin::where('email', Auth::user()->email)->first();
		$account = Accounts::where('login_id', $accountLogin->id)->first();
		$department_id = $account->department_id;

		$department = Department::find($department_id);

		$role = AccountRole::where('name', '!=', 'Department Admin')->get();

		$login = AccountLogin::join('accounts', 'accounts.login_id', '=', 'account_logins.id')
			->where('accounts.department_id', $department->id)
			->get();

		$details = AccountDetails::where('id', $account->details_id)->get();

		$services = Service::where('department_id', $department->id)->get();

		$data = [
			'departments' => [$department],
			'services' => $services,
			'account_roles' => $role,
			'account_logins' => $login,
			'account_details' => $details,
		];

		return $data;
	}


	// TODO: Isang function for dashboard, concat the role
	public function main_admin(QueueTicketController $queueTicketController, StatisticsController $statsController)
	{
		$feedbacks = Feedback::all();

		return view('dashboard.main_admin.dashboard', [
			'feedbacks' => $feedbacks,
			'completedTicketsByStaffs' => $statsController->countCompletedTicketsByStaff(),
			'occupiedDepartment' => $statsController->countOccupiedDepartment(),
			'totalStaff' =>  $statsController->countTotalStaff(),
			'activeStaff' => $statsController->countActiveStaff(),
			'user_data' => $this->getUserData(),
			'all_data' => $this->getAllData(),
			'queue_ticket_data' => $queueTicketController->getQueueTickets(),
			'pending_tickets' => $queueTicketController->countPendingTickets(),
			'serving_tickets' => $queueTicketController->countServingTickets(),
			'served_tickets' => $queueTicketController->countServedTickets(),
			'cancelled_tickets' => $queueTicketController->countCancelledTickets(),
			'years' => $queueTicketController->getYear(),
			'departments' => $queueTicketController->getDepartments(),
		]);
	}

	public function department_admin(DepartmentAdminController $departmentAdminController, StatisticsController $statsController)
	{
		return view('dashboard.department_admin.dashboard', [
			'totalStaff' =>  $statsController->countDepartmentTotalStaff(),
			'activeStaff' => $statsController->countDepartmentActiveStaff(),
			'user_data' => $this->getUserData(),
			'all_data' => $this->getDepartmentAllData(),
			'queue_ticket_data' => $departmentAdminController->getDepartmentQueueTickets(),
			'pending_tickets' => $departmentAdminController->countDepartmentPendingTickets(),
			'serving_tickets' => $departmentAdminController->countDepartmentServingTickets(),
			'served_tickets' => $departmentAdminController->countDepartmentServedTickets(),
			'completed_tickets' => $departmentAdminController->countDepartmentCompletedTickets(),
			'cancelled_tickets' => $departmentAdminController->countDepartmentCancelledTickets(),
			'years' => $departmentAdminController->getDepartmentYear(),
			'departments' => $departmentAdminController->getDepartmentDataForYear(2023),
		]);
	}
}
