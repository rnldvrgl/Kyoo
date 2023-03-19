<?php

namespace App\Http\Controllers\Auth;

use App\Models\Accounts;
use App\Models\AccountRole;
use App\Models\AccountLogin;
use Illuminate\Http\Request;
use App\Models\AccountDetails;
use App\Http\Controllers\Controller;
use App\Models\WorkSession;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
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
        $this->validateLogin($request);

        // Get the remaining time left before the throttle end
        $seconds = app(\Illuminate\Cache\RateLimiter::class)->availableIn(
            $this->throttleKey($request)
        );
        $remainingTime = round($seconds / 60, 0);

        // Add the remaining time to the view data
        $data['remainingTime'] = $remainingTime;

        $input = $request->only('email', 'password');

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($input)) {
            $accountLogin = AccountLogin::where('email', $input['email'])->first();

            if ($accountLogin && password_verify($input['password'], $accountLogin->password)) {
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
                        // Create a new WorkSession record
                        $workSession = new WorkSession();
                        $workSession->login_id = $accountLogin->id;
                        $workSession->start_time = now();
                        $workSession->save();

                        $accountLogin->updateAccountStatus('logged in');
                }

                $account = Accounts::where('login_id', $accountLogin->id)->first();

                $role_id = $account->role_id;

                switch ($role_id) {
                    case 1:
                        return redirect()
                            ->route('dashboard.main_admin')
                            ->with('account_id', $account->id)
                            ->with($data); // Add the view data to the redirect response
                        break;
                    case 2:
                        return redirect()
                            ->route('dashboard.department_admin')
                            ->with('account_id', $account->id)
                            ->with($data); // Add the view data to the redirect response
                        break;
                    case 3:
                        return redirect()
                            ->route('dashboard.staff')
                            ->with('account_id', $account->id)
                            ->with($data); // Add the view data to the redirect response
                        break;
                    default:
                        return redirect()->route('logout');
                }
            }
        }

        // Add the view data to the response when rendering the view
        return redirect()->route('login', $data)->with('error', 'Invalid Email or Password.');
    }



    public function logout(Request $request)
    {
        $user = Auth::user();
        $accountLogin = AccountLogin::where('email', $user->email)->first();

        if ($accountLogin) {
            // Update the WorkSession record with the end time and duration
            $workSession = WorkSession::where('login_id', $accountLogin->id)->orderBy('id', 'desc')->first();
            if ($workSession && !$workSession->end_time) {
                $workSession->end_time = now();
                $workSession->paused_duration = $workSession->paused_duration ?? 0;
                $workSession->duration = Carbon::parse($workSession->start_time)->diffInSeconds(now()) - $workSession->paused_duration;
                $workSession->save();
            }

            $accountLogin->updateAccountStatus('logged out');
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }

        return redirect('/login')->with('error', 'Failed to logout. Please try again later.');
    }
}
