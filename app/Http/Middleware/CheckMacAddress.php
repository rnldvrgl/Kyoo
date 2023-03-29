<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMacAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $allowedMacAddress = '70-85-C2-0B-51-6E'; // Replace with your desired MAC address
        $allowedMacAddress = '70-85-C2-0B-51-4C';

        $clientMacAddress = $this->getClientMacAddress($request);
        if ($clientMacAddress !== $allowedMacAddress) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }

    private function getClientMacAddress()
    {
        ob_start();
        system('getmac');
        $macAddress = ob_get_clean();
        preg_match('/(?:[0-9a-fA-F]{2}[:-]){5}[0-9a-fA-F]{2}/', $macAddress, $matches);
        $clientMacAddress = $matches[0] ?? null;
        return $clientMacAddress;
    }
}
