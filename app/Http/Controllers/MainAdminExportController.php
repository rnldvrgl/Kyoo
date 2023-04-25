<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class MainAdminExportController extends Controller
{
    public function fetchFilteredMainAdminData(Request $request)
    {
        $status = $request->staffStatus;
        $department_id = $request->department;

        // If both empty, fetch all data
        if(empty($status) && empty($department_id)){
            // return response()->json(['code' => 400, 'msg' => 'Please provide at least one filter.']);

            $accounts = Accounts::whereHas('account_role', function($query){
                $query->where('name','!=', 'Main Admin')->where('id','!=', 1);
            })->get();
        }

        // If status exists
        if(!empty($status)){
            $accounts = Accounts::whereHas('account_login', function($query) use ($status){
                $query->when($status, function($query, $status){
                    $query->where('status', '=', $status);
                });
            })->where('department_id', '!=', null)->get(); // main admin doesn't have a department
        }

        // If department id exists
        if(!empty($department_id)){
            $accounts = Accounts::whereHas('department', function($query) use ($department_id){
                $query->when($department_id, function($query, $department_id){
                    $query->where('id', '=', $department_id);
                });
            })->get();
        }

        // If both exists
        if(!empty($status) && !empty($department_id)){
            $accounts = Accounts::whereHas('account_login', function($query) use ($status){
                $query->where('status', '=', $status);
            })
                ->where('department_id', '=', $department_id)
                ->get();
        }

		$array = [];

		foreach($accounts as $account){
            $toExcel = array(
                "Name" => $account->account_details->name,
                "Department" => $account->department->name,
                "Status" => $account->account_login->status,
            );

            array_push($array, $toExcel);
		}

        $results = collect($array);

        // dd($results);

        if($results->isEmpty()){
            return response()->json(['code' => 400, 'msg' => 'No data found with the specified filters.']);
        }

        // Export the tickets to a CSV file
        $fileName = "main-admin-report.csv";
        (new FastExcel($results))->export(storage_path('app/public/' . $fileName));

        // Get the URL to the exported file
        $url = Storage::url($fileName);
        
        // Return response
        return response()->json(['code' => 200, 'msg' => 'Export Successful', 'url' => $url, 'fileName' => $fileName]);
    }
}