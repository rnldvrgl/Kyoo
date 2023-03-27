<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountLogin;
use App\Models\WorkSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkSessionController extends Controller
{
    public function updateWorkSession(Request $request)
    {
        // Get the current authenticated user
        $user = Auth::user();
        $accountLogin = AccountLogin::where('email', $user->email)->first();

        // Update the work status based on the request payload
        $status = $request->status;

        if ($accountLogin) {
            // Update the work status based on the request payload
            $status = $request->status;

            // Update the account status
            $accountLogin->updateAccountStatus($status);

            // Update the WorkSession record with the end time and duration
            $workSession = WorkSession::where('login_id', $accountLogin->id)->orderBy('id', 'desc')->first();

            if ($workSession) {
                if ($status === 'On Break') {
                    // Pause the work session
                    if (!$workSession->paused_at) {
                        $workSession->paused_at = now();
                        $workSession->save();
                    }
                } else if ($status === 'Logged Out') {
                    // End the work session and log out the user
                    $workSession->end_time = now();
                    $workSession->duration = Carbon::parse($workSession->start_time)->diffInSeconds(now()) - $workSession->paused_duration;
                    $workSession->save();

                    Auth::logout();

                    return response()->json(['message' => 'Work status updated and user logged out.']);
                } else {
                    // Resume the work session
                    if ($workSession->paused_at) {
                        $workSession->paused_duration += Carbon::parse($workSession->paused_at)->diffInSeconds(now());
                        $workSession->paused_at = null;
                        $workSession->save();
                    }
                }
            }

            // Return a success response
            return response()->json(['message' => 'Work status updated.']);
        } else {
            return response()->json(['error' => 'Account not found.'], 404);
        }
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
}
