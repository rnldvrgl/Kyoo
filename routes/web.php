<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/live_queue', function () {
	return view('live_queue');
})->name('live_queue');

Route::get('/frequent_questions', function () {
	return view('frequent-questions');
})->name('faqs_landing');

// * Main Admin Routes
Route::middleware(['auth', 'user-access:Main Admin'])->group(function () {

	// Dashboard
	Route::get('/main-admin/dashboard', [HomeController::class, 'main_admin'])->name('dashboard.main_admin');

	// Manage Accounts
	Route::prefix('main-admin/manage/accounts')->group(function () {
		// Go to Add Account page
		Route::get('/add-account', [AccountController::class, 'create'])->name('manage.accounts.add');

		// Store Account
		Route::post('/add-account', [AccountController::class, 'store'])->name('manage.accounts.store');

		// View Account
		Route::get('/view-account/{id}', [AccountController::class, 'show'])->name('manage.accounts.show');

		// Edit Account / List of Accounts
		Route::get('/edit-account', [AccountController::class, 'index'])->name('manage.accounts.index');
		Route::get('/edit-account/fetch', [AccountController::class, 'fetchAccounts'])->name('manage.accounts.fetch_accounts');

		// Specific Employee to Edit
		Route::get('/edit-account/{id}', [AccountController::class, 'edit'])->name('manage.accounts.edit');

		// Update Employee Account
		Route::get('/update-account/{id}', [AccountController::class, 'update'])->name('manage.accounts.update');

		// Delete Account
		Route::delete('/delete-account/{id}', [AccountController::class, 'destroy'])->name('manage.accounts.destroy');

	});

	// Manage Departments
	Route::prefix('main-admin/manage/departments')->group(function () {
		// Add Department
		Route::get('/add-department', function () {
			$user_data = (new HomeController)->getUserData();
			$all_data = (new HomeController)->getAllData();
			return view('dashboard.main_admin.manage.departments.add', [
				'user_data' => $user_data,
				'all_data' => $all_data,
			]);
		})->name('manage.departments.add');

		// Edit Department
		Route::get('/edit-department', function () {
			$user_data = (new HomeController)->getUserData();
			$all_data = (new HomeController)->getAllData();
			return view('dashboard.main_admin.manage.departments.edit', [
				'user_data' => $user_data,
				'all_data' => $all_data,
			]);
		})->name('manage.departments.edit');
	});

	// Manage Frequent Questions
	Route::prefix('main-admin/manage/frequent_questions')->group(function () {
		// Add Frequent Question
		Route::get('/add-frequent-question', function () {
			$user_data = (new HomeController)->getUserData();
			$all_data = (new HomeController)->getAllData();
			return view('dashboard.main_admin.manage.frequent_questions.add', [
				'user_data' => $user_data,
				'all_data' => $all_data,
			]);
		})->name('manage.frequent_questions.add');

		// Edit Frequent Question
		Route::get('/edit-frequent-question', function () {
			$user_data = (new HomeController)->getUserData();
			$all_data = (new HomeController)->getAllData();
			return view('dashboard.main_admin.manage.frequent_questions.edit', [
				'user_data' => $user_data,
				'all_data' => $all_data,
			]);
		})->name('manage.frequent_questions.edit');
	});

	// Manage Services
	Route::prefix('main-admin/manage/services')->group(function () {
		// Add Service
		Route::get('/add-service', function () {
			$user_data = (new HomeController)->getUserData();
			$all_data = (new HomeController)->getAllData();
			return view('dashboard.main_admin.manage.services.add', [
				'user_data' => $user_data,
				'all_data' => $all_data,
			]);
		})->name('manage.services.add');

		// Edit Service
		Route::get('/edit-service', function () {
			$user_data = (new HomeController)->getUserData();
			$all_data = (new HomeController)->getAllData();
			return view('dashboard.main_admin.manage.services.edit', [
				'user_data' => $user_data,
				'all_data' => $all_data,
			]);
		})->name('manage.services.edit');
	});

	// Manage Promotionals
	Route::prefix('main-admin/manage/promotionals')->group(function () {
		// Add Service
		Route::get('/edit-promotionals', function () {
			$user_data = (new HomeController)->getUserData();
			$all_data = (new HomeController)->getAllData();
			return view('dashboard.main_admin.manage.promotionals.edit', [
				'user_data' => $user_data,
				'all_data' => $all_data,
			]);
		})->name('manage.promotionals.edit');
	});
})->name('main_admin');

// * Department Admin Routes
Route::middleware(['auth', 'user-access:Department Admin'])->group(function () {
	Route::get('/department-admin/dashboard', [HomeController::class, 'department_admin'])->name('dashboard.department_admin');
})->name('department_admin');

// * Department Staff Routes
Route::middleware(['auth', 'user-access:Staff'])->group(function () {
	Route::get('/staff/dashboard', [HomeController::class, 'staff'])->name('dashboard.staff');
})->name('staff');

// * Librarian Routes
Route::middleware(['auth', 'user-access:Librarian'])->group(function () {
	Route::get('/librarian/dashboard', [HomeController::class, 'librarian'])->name('dashboard.librarian');
})->name('librarian');

// * Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// * User Profile
Route::middleware('auth')->group(function () {
	Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile');
	Route::patch('/user_profile/{id}', [UserProfileController::class, 'updateDetails'])->name('user_profile.update');
	Route::patch('/user_profile/change_password/{id}', [UserProfileController::class, 'updatePassword'])->name('user_profile.change_password');
})->name('profile');
