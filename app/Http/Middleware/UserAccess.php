<?php

namespace App\Http\Middleware;

use App\Models\AccountRole;
use App\Models\Accounts;
use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType)
    {

        // Fetch the account_id
        $account_id = $request->session()->get('account_id');

        // Fetch the row with the same account_id
        $fetched_account = Accounts::where('id', $account_id)->first();

        // Fetch the role_id
        $role_id = $fetched_account->role_id;

        // Fetch the row with the same role_id
        $role_details = AccountRole::where('id', $role_id)->first();

        // Fetch the role name
        $role_name = $role_details->name;

        if ($role_name == $userType) {
            // Goes to Login Controller
            return $next($request);
        }

        return response()->json(['Authorized Users only!']);

        /* 
            If we want a custom page to redirect unauthorized users
            ? return response()->view('errors.check-permission'); 
        */
    }
}
