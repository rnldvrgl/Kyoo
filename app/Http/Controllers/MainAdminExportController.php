<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;

class MainAdminExportController extends Controller
{
    public function fetchFilteredMainAdminData()
    {
        $result = Accounts::whereHas('account_role', function ($query) {
			$query->where('name', 'staff');
		})->count();

        $today = Carbon::today()->format("m-d-Y");

        // Export the tickets to a CSV file
        $fileName = "main-admin-export" . $today . ".csv";
        (new FastExcel($result))->export(storage_path('app/public/' . $fileName));

        // Get the URL to the exported file
        $url = Storage::url($fileName);
        
        
    }
}
