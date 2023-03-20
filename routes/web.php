<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\LiveQueueController;
use App\Http\Controllers\PromotionalController;
use App\Http\Controllers\QueueTicketController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserProfileController;
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
})->name('landing_page');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/live_queue', [LiveQueueController::class, 'index'])->name('live_queue');

Route::get('/frequent_questions', [FaqController::class, 'index'])->name('frequent_questions');

Route::post('/send-feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// * Main Admin Routes
Route::middleware(['auth', 'user-access:Main Admin'])->group(function () {

	// Dashboard
	Route::get('/main-admin/dashboard', [HomeController::class, 'main_admin'])->name('dashboard.main_admin');

	// Fetch Data based on Year
	Route::get('/fetch-queue-data/{year}', [QueueTicketController::class, 'getDataForYear'])->name('dashboard.fetch_queues');

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
})->name('department_admin');

// * Department Staff Routes
Route::middleware(['auth', 'user-access:Staff'])->group(function () {
	// Staff Index Dashboard
	Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('dashboard.staff');

	// Update Ticket Status
	Route::put('/tickets/update-status/{status}', [QueueTicketController::class, 'updateStatus'])->name('tickets.updateStatus');

	// Update Clearance Status
	Route::put('/tickets/request-clearance/', [QueueTicketController::class, 'updateClearanceStatus'])->name('tickets.updateClearanceStatus');
})->name('staff');

// * Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// * Pause Work
Route::get('/pause_work', [LoginContoller::class, 'pauseWork'])->name('pause_work');

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
