<?php

use App\Events\LiveQueueEvent;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentAccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentServiceController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\LiveQueueController;
use App\Http\Controllers\PromotionalController;
use App\Http\Controllers\QueueTicketController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WorkSessionController;
use App\Models\QueueTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Naming Conventions
|--------------------------------------------------------------------------
|
| Folder - snake_case
| Filename and Routes - kebab-case
| Functions/Methods - camelCase
| 
|
*/

// * Helper method of Laravel/UI that generates a set of routes to handle authentication functionality
Auth::routes();

Route::get('/', function () {
	return view('welcome');
})->name('landing_page')->middleware('guest');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('guest');

Route::get('/live_queue', [LiveQueueController::class, 'index'])->name('live_queue')->middleware('guest');

Route::get('/frequent_questions', [FaqController::class, 'index'])->name('frequent_questions')->middleware('guest');

Route::post('/send-feedback', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('guest');

Route::get('/testing/{id}', function ($id) {
	// $queueTicket = QueueTicket::find($id);

	// // Can pass the query to get the data and pass it to the TestEvent as data
	// event(new LiveQueueEvent($queueTicket));
	// return null;
});

// * Main Admin Routes
Route::middleware(['auth', 'user-access:Main Admin'])->group(function () {

	// Dashboard
	Route::get('/main-admin/dashboard', [HomeController::class, 'main_admin'])->name('dashboard.main_admin');

	// Fetch Data based on Year
	Route::get('/fetch-queue-data/{year}', [QueueTicketController::class, 'getDataForYear'])->name('dashboard.fetch_queues');

	// Fetch Data based on Year
	Route::get('/fetch-department-data/{year}', [QueueTicketController::class, 'getDataForDepartment'])->name('dashboard.fetch_services');

	// Manage Accounts
	Route::prefix('main-admin/manage/accounts')->group(function () {
		// Store Account
		Route::post('/store-account', [AccountController::class, 'store'])->name('manage.accounts.store');

		// View Account
		Route::post('/view-account', [AccountController::class, 'show'])->name('manage.accounts.show');

		// List of Accounts
		Route::get('/edit-account', [AccountController::class, 'index'])->name('manage.accounts.index');
		Route::get('/edit-account/fetch', [AccountController::class, 'fetchAccounts'])->name('manage.accounts.fetch_accounts');

		// Specific Employee to Edit
		Route::post('/edit-account', [AccountController::class, 'edit'])->name('manage.accounts.edit');

		// Update Employee Account
		Route::patch('/update-account', [AccountController::class, 'update'])->name('manage.accounts.update');

		// Delete Account
		Route::delete('/delete-account/{id}', [AccountController::class, 'destroy'])->name('manage.accounts.delete');
	});

	// Manage Departments
	Route::prefix('main-admin/manage/departments')->group(function () {
		// Store Department
		Route::post('/store-department', [DepartmentController::class, 'store'])->name('manage.departments.store');

		// View Department
		Route::post('/view-department', [DepartmentController::class, 'show'])->name('manage.departments.show');

		// List of Departments
		Route::get('/edit-department', [DepartmentController::class, 'index'])->name('manage.departments.index');
		Route::get('/edit-department/fetch', [DepartmentController::class, 'fetchDepartments'])->name('manage.departments.fetch_departments');

		// Specific Department to Edit
		Route::post('/edit-department', [DepartmentController::class, 'edit'])->name('manage.departments.edit');

		// Update Department Account
		Route::patch('/update-department', [DepartmentController::class, 'update'])->name('manage.departments.update');

		// Delete Department
		Route::delete('/delete-department/{id}', [DepartmentController::class, 'destroy'])->name('manage.departments.delete');
	});

	// Manage Frequent Questions
	Route::prefix('main-admin/manage/frequent_questions')->group(function () {
		// Store FAQ
		Route::post('/add-frequent-question', [FaqController::class, 'store'])->name('manage.frequent_questions.store');

		// View FAQ
		Route::post('/view-faq', [FaqController::class, 'show'])->name('manage.frequent_questions.show');

		// List of FAQs
		Route::get('/edit-frequent-question', [FaqController::class, 'faqList'])->name('manage.frequent_questions.index');
		Route::get('/edit-frequent-question/fetch', [FaqController::class, 'fetchFAQs'])->name('manage.frequent_questions.fetch_faqs');

		// Specific Department to Edit
		Route::post('/edit-frequent-question', [FaqController::class, 'edit'])->name('manage.frequent_questions.edit');

		// Update Department Account
		Route::patch('/update-frequent-question', [FaqController::class, 'update'])->name('manage.frequent_questions.update');

		// Delete Department
		Route::delete('/delete-frequent-question/{id}', [FaqController::class, 'destroy'])->name('manage.frequent_questions.delete');
	});

	// Manage Services
	Route::prefix('main-admin/manage/services')->group(function () {
		// Store Service from View Department 
		Route::post('/add-service', [ServiceController::class, 'store'])->name('manage.services.add');

		// Store Service from Services List
		Route::post('/add-service-from-list', [ServiceController::class, 'storeServicesFromList'])->name('manage.services-from-list.add');

		// List of Services
		Route::get('/edit-service', [ServiceController::class, 'index'])->name('manage.services.index');

		// Fetch Services
		Route::get('/fetch-services/{id}', [ServiceController::class, 'fetchServices'])->name('manage.services.fetch');

		// Fetch Services to Display on the List
		Route::get('/fetch-services-list/fetch', [ServiceController::class, 'fetchToServicesList'])->name('manage.services.fetchToList');

		// Update Services
		Route::post('/update-services', [ServiceController::class, 'update'])->name('manage.services.update');
	});

	// Manage Promotionals
	Route::prefix('main-admin/manage/promotionals')->group(function () {
		// Edit Promotionals
		Route::get('/edit-promotionals', [PromotionalController::class, 'index'])->name('manage.promotionals.edit');

		// Add Video
		Route::post('/add-video', [PromotionalController::class, 'addVideo'])->name('manage.promotionals.addvideo');

		// Update Video Status
		Route::put('/update-video-status', [PromotionalController::class, 'setActiveVideo'])->name('manage.promotionals.setactivevideo');

		// Delete Video
		Route::delete('/delete-video/{id}', [PromotionalController::class, 'deleteVideo'])->name('manage.promotionals.deletevideo');

		// Update Promotional Message
		Route::post('/update-message', [PromotionalController::class, 'updateMessage'])->name('manage.promotionals.updatemessage');
	});
})->name('main_admin');

// * Department Admin Routes
Route::middleware(['auth', 'user-access:Department Admin'])->group(function () {
	Route::get('/department-admin/dashboard', [HomeController::class, 'department_admin'])->name('dashboard.department_admin');

	Route::get('/edit-department-account', [DepartmentAccountController::class, 'index'])->name('manage.department_accounts.index');

	Route::get('/edit-department-account/fetch', [DepartmentAccountController::class, 'fetchAccounts'])->name('manage.department_accounts.fetch_accounts');

	// Manage Accounts
	Route::prefix('department-admin/manage/accounts')->group(function () {
		// Store Account
		Route::post('/store-account', [DepartmentAccountController::class, 'store'])->name('manage.accounts.store');

		// View Account
		Route::post('/view-account', [DepartmentAccountController::class, 'show'])->name('manage.department_accounts.show');

		// List of Accounts
		Route::get('/edit-account', [DepartmentAccountController::class, 'index'])->name('manage.department_accounts.index');
		Route::get('/edit-account/fetch', [DepartmentAccountController::class, 'fetchAccounts'])->name('manage.department_accounts.fetch_accounts');

		// Specific Employee to Edit
		Route::post('/edit-account', [DepartmentAccountController::class, 'edit'])->name('manage.department_accounts.edit');

		// Update Employee Account
		Route::patch('/update-account', [DepartmentAccountController::class, 'update'])->name('manage.department_accounts.update');

		// Delete Account
		Route::delete('/delete-account/{id}', [DepartmentAccountController::class, 'destroy'])->name('manage.department_accounts.delete');
	});

	// Manage Services
	Route::prefix('department-admin/manage/services')->group(function () {

		// View Department
		Route::get('/view-department-services', [DepartmentServiceController::class, 'index'])->name('manage.departments-services.index');

		// Store Service from View Department 
		Route::post('/add-department-service', [ServiceController::class, 'store'])->name('manage.department-services.add');

		// Store Service from Services List
		Route::post('/add-service-from-list', [ServiceController::class, 'storeServicesFromList'])->name('manage.department-services-from-list.add');

		// Fetch Services
		Route::get('/fetch-department-services/{id}', [ServiceController::class, 'fetchServices'])->name('manage.department_services.fetch');

		// Fetch Services to Display on the List
		Route::get('/fetch-department-services-list/fetch', [ServiceController::class, 'fetchToServicesList'])->name('manage.department_services.fetchToList');

		// Update Services
		Route::post('/update-department-services', [ServiceController::class, 'update'])->name('manage.department_services.update');
	});
})->name('department_admin');

// * Department Staff Routes
Route::middleware(['auth', 'user-access:Staff'])->group(function () {
	// Staff Index Dashboard
	Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('dashboard.staff');

	// Registrar Index Dashboard
	Route::get('/registrar/dashboard', [RegistrarController::class, 'index'])->name('dashboard.registrar');

	// Librarian Index Dashboard
	Route::get('/librarian/dashboard', [LibrarianController::class, 'index'])->name('dashboard.librarian');

	// Update Ticket Status
	Route::put('/tickets/update-status/{status}', [QueueTicketController::class, 'updateStatus'])->name('tickets.updateStatus');

	// Request Clearance
	Route::put('/tickets/request-clearance/', [QueueTicketController::class, 'updateClearanceStatus'])->name('tickets.updateClearanceStatus');

	// Sign Clearance
	Route::put('/tickets/clearance/update-status/{status}', [QueueTicketController::class, 'signClearance'])->name('tickets.signClearance');

	// Fetch Services
	Route::get('/fetch-services/{id}', [QueueTicketController::class, 'fetchServices'])->name('tickets.fetchServices');
})->name('staff');

// * Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// * End Shift
Route::get('/end_shift', [LoginController::class, 'endShift'])->name('end_shift')->middleware('auth');

// Update Work Session
Route::post('/update-work-session', [WorkSessionController::class, 'updateWorkSession'])->name('work-session.update');

// * User Profile
Route::middleware('auth')->group(function () {
	Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile');
	Route::patch('/user_profile/{id}', [UserProfileController::class, 'updateDetails'])->name('user_profile.update');
	Route::patch('/user_profile/change_password/{id}', [UserProfileController::class, 'updatePassword'])->name('user_profile.change_password');
})->name('profile');


// * Kiosk Routes
Route::middleware('guest')->group(function () {
	// Index Kiosk
	Route::get('/kiosk', [KioskController::class, 'index'])->name('kiosk');

	// Select Department
	Route::get('/select-department', [KioskController::class, 'selectDepartment'])->name('select-department');

	// Select Other Department
	Route::get('/other-department', [KioskController::class, 'selectOtherDept'])->name('other-department');

	// Select Transaction
	Route::post('/select-transaction', [KioskController::class, 'selectTransaction'])->name('select-transaction');

	// Input Information
	Route::get('/input-information', [KioskController::class, 'inputInformation'])->name('input-information');

	// Add Services
	Route::get('/add-transaction', [KioskController::class, 'addTransaction'])->name('add-transaction');

	// Add to Queue
	Route::post('/add-to-queue', [KioskController::class, 'addToQueue'])->name('add-to-queue');

	// Transaction Summary
	Route::get('/transaction-summary', [KioskController::class, 'summary'])->name('transaction-summary');

	// Print Queue Ticket
	Route::post('/print-queue-ticket', [KioskController::class, 'printQueueTicket'])->name('print-queue-ticket');

	// Cancel Queue
	Route::get('/cancel', [KioskController::class, 'cancel'])->name('cancel');
});
