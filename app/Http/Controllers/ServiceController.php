<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function fetchServices($id)
    {
        $services = Service::query()->where('department_id', $id)->orderByDesc('created_at');

        return DataTables::eloquent($services)
            ->smart()
            ->addColumn('actions', function ($service) {
                // Add your action buttons here
                return
                    '<div class="hstack mx-auto">' .
                    '<button class="btn btn-danger remove-service" data-service-id="' . $service->id . '">Remove</button>' .
                    '</div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
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

    public function update(Request $request)
    {
        $messages = [
            'services.required' => 'Services must be provided.',
            'services.regex' => 'Please enter a valid Service name.',
        ];

        $validatedData = Validator::make($request->except('_token'), [
            'services*' => ['required', "regex: /^[a-zA-Z0-9 ]*$/"],
        ], $messages);

        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        return response()->json(['data' => 'It works.']);
    }
}
