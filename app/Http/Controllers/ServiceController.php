<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);

        // Message
        $messages = [
            'service_name.required' => 'Service name is required.',
            'service_name.regex' => 'Please enter a valid Service name.',
            'service_name.min' => 'Service name must be at least :min characters long.',
            'service_name.max' => 'Service name must not be greater than :max characters long.',
            'service_name.unique' => 'Service name already exists in this department.',
        ];

        $validatedData = Validator::make(
            $request->except('_token'),
            [
                'department_id' => 'required|exists:departments,id',
                'service_name' => [
                    'required',
                    "regex:/^[a-zA-Z0-9 ]*$/",
                    'min:3',
                    'max:20',
                ],
                'status' => ['nullable'],
            ],
            $messages
        );

        // check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Access each validated data
        $name = $validatedData->validated()['service_name'];
        $department_id = $validatedData->validated()['department_id'];
        $status = $request->has('status') ? 'active' : 'inactive';

        // Insert
        Service::create([
            'name' => $name,
            'department_id' => $department_id,
            'status' => $status,
        ]);

        // Redirect
        return response()->json(['code' => 200, 'msg' => 'Service added successfully.']);
    }
}
