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
        // $this->middleware('throttle:3,1')->only('login');
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

                switch ($accountLogin->status) {
                    case 'Logged In':
                        return redirect()->route('login')->with('error', 'This account is already logged in.');
                        break;
                    case 'On Break':
                        return redirect()->route('login')->with('error', 'This account is currently on break.');
                        break;
                    default:
                        // Create a new WorkSession record
                        $workSession = new WorkSession();
                        $workSession->login_id = $accountLogin->id;
                        $workSession->start_time = now();
                        $workSession->save();

                        $accountLogin->updateAccountStatus('Logged In');
                }

                $account = Accounts::where('login_id', $accountLogin->id)->first();

                $role_id = $account->role_id;
                $department_id = $account->department_id;

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
                        switch ($department_id) {
                            case 1:
                                return redirect()
                                    ->route('dashboard.registrar')
                                    ->with(session([
                                        'account_id' => $account->id
                                    ]));
                                break;
                            case 3:
                                return redirect()
                                    ->route('dashboard.librarian')
                                    ->with(session([
                                        'account_id' => $account->id
                                    ]));
                                break;
                            case 4:
                                return redirect()
                                    ->route('dashboard.librarian')
                                    ->with(session([
                                        'account_id' => $account->id
                                    ]));
                                break;
                            default:
                                return redirect()
                                    ->route('dashboard.staff')
                                    ->with(session([
                                        'account_id' => $account->id
                                    ]));
                                break;
                        }
                    default:
                        return redirect()->route('logout');
                }
            }
        }

        return redirect()->route('login')->with('error', 'Invalid Email or Password.');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $accountLogin = AccountLogin::where('email', $user->email)->first();

        if ($accountLogin) {
            $accountLogin->updateAccountStatus('Logged Out');
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }

        return redirect('/login')->with('error', 'Failed to End Shift. Please try again later.');
    }

    public function endShift(Request $request)
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

            $accountLogin->updateAccountStatus('Logged Out');
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login');
        }

        return redirect('/login')->with('error', 'Failed to End Shift. Please try again later.');
    }


    // ! TODO PAUSE WORK 
    public function pauseWork(Request $request)
    {
        $user = Auth::user();
        $accountLogin = AccountLogin::where('email', $user->email)->first();

        if ($accountLogin) {
            // Update the WorkSession record with the paused at time
            $workSession = WorkSession::where('login_id', $accountLogin->id)->orderBy('id', 'desc')->first();
            if (
                $workSession && !$workSession->end_time
            ) {
                $workSession->paused_at = now();
                $workSession->save();
            }

            $accountLogin->updateAccountStatus($request->status);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ticket not found']);
        }
    }
}
