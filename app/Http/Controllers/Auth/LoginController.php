<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountLogin;
use App\Models\Accounts;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

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
                $account = Accounts::where('login_id', $accountLogin->id)->first();

                $role_id = $account->role_id;

                switch ($role_id) {
                    case 1:
                        return redirect()->route('home.mainAdmin')->with(session(['account_id' => $account->id]));
                        break;
                    case 2:
                        return redirect()->route('home.depAdmin')->with(session(['account_id' => $account->id]));
                        break;
                    case 3:
                        return redirect()->route('home.staff')->with(session(['account_id' => $account->id]));
                        break;
                    case 4:
                        return redirect()->route('home.librarian')->with(session(['account_id' => $account->id]));
                        break;
                    default:
                        return redirect()->route('logout');
                }
            }
        }

        return redirect()->route('login')->with('error', 'Invalid Email or Password.');
    }

    // Previous Login Version
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $accountLogin = AccountLogin::where('email', $credentials['email'])->first();

    //         if ($accountLogin && password_verify($credentials['password'], $accountLogin->password)) {
    //             $account = Accounts::where('login_id', $accountLogin->id)->first();

    //             // Check user type and redirect accordingly
    //             switch ($account->role_id) {
    //                 case 1:
    //                     return view('dashboard/main_admin/dashboard')->with(session(['account_id' => $account->id]));
    //                     break;
    //                 case 2:
    //                     return view('dashboard/department_admin/dashboard')->with(session(['account_id' => $account->id]));
    //                     break;
    //                 case 3:
    //                     return view('dashboard/staff/dashboard')->with(session(['account_id' => $account->id]));
    //                     break;
    //                 case 4:
    //                     return view('dashboard/librarian/dashboard')->with(session(['account_id' => $account->id]));
    //                     break;
    //                 default:
    //                     return redirect()->route('welcome');
    //                     break;
    //             }
    //         }
    //     }

    //     return redirect('/login')->withErrors(['email' => 'The provided credentials do not match our records.']);
    // }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
