<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();
        $all_data = $homeController->getAllData();
        return view('dashboard.main_admin.manage.services.list', [
            'user_data' => $user_data,
            'all_data' => $all_data,
        ]);
    }

    // This is for Services on the View Department
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

    // For the Services List
    public function fetchToServicesList()
    {
        $services = Service::query()->orderBy('department_id');

        return DataTables::eloquent($services)
            ->smart()
            ->addColumn('department_name', function ($service) {
                return $service->department->name;
            })
            ->addColumn('actions', function ($service) {
                // Add your action buttons here
                $viewUrl = route('manage.departments.show', $service->department_id);

                return
                    '<div class="hstack mx-auto">' .
                    // View 
                    '<form action="' . $viewUrl . '" method="POST">' .
                    csrf_field() .
                    '<input name="department_id" type="hidden" value="' . $service->department_id . '"/>' .
                    '<button type="submit" class="btn btn-primary me-md-1"><i class="fa-solid fa-eye"></i></button>' .
                    '</form>' .
                    '</div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // From View Department
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
                    "regex:/^[a-zA-Z ]*$/",
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

    // From Services List
    public function storeServicesFromList(Request $request)
    {
        $data = $request->all();

        $rules = [
            'department_id' => ['required'],
            'service_name' => [
                'required',
                "regex:/^[a-zA-Z ]*$/",
                'min:3',
                'max:20',
            ],
            'status' => ['nullable'],
        ];

        // Message
        $messages = [
            'department_id.required' => 'Select a Department',
            'service_name.required' => 'Service name is required.',
            'service_name.regex' => 'Please enter a valid Service name.',
            'service_name.min' => 'Service name must be at least :min characters long.',
            'service_name.max' => 'Service name must not be greater than :max characters long.',
            'service_name.unique' => 'Service name already exists in this department.',
        ];

        $validatedData = Validator::make($data, $rules, $messages);

        // check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Access each validated data
        $department_id = $validatedData->validated()['department_id'];
        $name = $validatedData->validated()['service_name'];
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
        $servicesArray = [
            'services' => $request->services,
            'status' => $request->status
        ];

        $rules = [
            'services' => 'required|array',
            'services.*' => ['required', 'regex:/^[a-zA-Z ]*$/'],
            'status.*' => 'string'
        ];

        $messages = [
            'services.*' => 'Please enter a valid Service name.',
        ];

        $validatedData = Validator::make($servicesArray, $rules, $messages);

        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Delete where department_id matches
        Service::where('department_id', $request->department_id)->delete();

        // Insert
        $services = $request->services;
        $statuses = $request->status;

        // loop through the services and statuses arrays and save each pair of values
        for ($i = 0; $i < count($services); $i++) {
            $service = new Service();
            $service->department_id = $request->department_id;
            $service->name = $services[$i];
            $service->status = $statuses[$i];
            $service->save();
        }

        return response()->json(['code' => 200, 'success' => 'Services modified successfully.']);
    }
}
