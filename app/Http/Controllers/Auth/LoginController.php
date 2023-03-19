<?php

namespace App\Http\Controllers\Auth;

use App\Models\Accounts;
use App\Models\AccountRole;
use App\Models\AccountLogin;
use Illuminate\Http\Request;
use App\Models\AccountDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    // protected $maxAttempts = 3; // Maximum number of login attempts

    // protected $decayMinutes = 1; // Time period for which user should be locked out after maximum attempts

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        // For Rate limiting throttle:limit of attempts, minutes the user is locked out
        $this->middleware('throttle:3,1')->only('login');
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($input)) {
            $accountLogin = AccountLogin::where('email', $input['email'])->first();

            if ($accountLogin && password_verify($input['password'], $accountLogin->password)) {
                // Check the status of the account
                switch ($accountLogin->status) {
                    case 'logged in':
                        return redirect()->route('login')->with(
                            'error',
                            'This account is already logged in.'
                        );
                        break;
                    case 'on break':
                        return redirect()->route('login')->with(
                            'error',
                            'This account is currently on break.'
                        );
                        break;
                    default:
                        // Update the status of the account
                        $accountLogin->updateAccountStatus('logged in');
                }


                $account = Accounts::where('login_id', $accountLogin->id)->first();

                $role_id = $account->role_id;

                switch ($role_id) {
                    case 1:
                        return redirect()
                            ->route('dashboard.main_admin')
                            ->with(session([
                                'account_id' => $account->id
                            ]));
                        break;
                    case 2:
                        return redirect()
                            ->route('dashboard.department_admin')
                            ->with(session([
                                'account_id' => $account->id
                            ]));
                        break;
                    case 3:
                        return redirect()
                            ->route('dashboard.staff')
                            ->with(session([
                                'account_id' => $account->id
                            ]));
                        break;
                    default:
                        return redirect()->route('logout');
                }
            }
        }

        return redirect()->route('login')->with('error', 'Invalid Email or Password.');
    }


    public function logout(Request $request)
    {
        // Get the logged in user
        $user = Auth::user();

        // Update the status of the account to "logged out"
        $accountLogin = AccountLogin::where('email', $user->email)->first();
        if ($accountLogin) {
            $accountLogin->updateAccountStatus('logged out');
        }

        // Log out the user
        Auth::guard('web')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect the user to the login page
        return redirect('/login');
    }
}
