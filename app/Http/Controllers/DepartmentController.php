<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();
        $all_data = $homeController->getAllData();
        return view('dashboard.main_admin.manage.departments.list', [
            'user_data' => $user_data,
            'all_data' => $all_data,
        ]);
    }

    public function fetchDepartments()
    {
        $departments = Department::query();

        return DataTables::of($departments)
            ->addColumn('actions', function ($department) {
                $viewUrl = route('manage.departments.show', $department->id);
                $editUrl = route('manage.departments.edit', $department->id);

                return
                    '<div class="hstack mx-auto">' .
                    // View 
                    '<form action="' . $viewUrl . '" method="POST">' .
                    csrf_field() .
                    '<input name="department_id" type="hidden" value="' . $department->id . '"/>' .
                    '<button type="submit" class="btn btn-primary me-md-1"><i class="fa-solid fa-eye"></i></button>' .
                    '</form>' .

                    // Update
                    '<form action="' . $editUrl . '" method="POST">' .
                    csrf_field() .
                    '<input name="department_id" type="hidden" value="' . $department->id . '"/>' .
                    '<button type="submit" class="btn btn-secondary me-md-1"><i class="fa-solid fa-pen-to-square"></i></button>' .
                    '</form>' .

                    // Delete
                    '<div class="d-grid">' .
                    '<button class="btn btn-danger delete-department" data-department-id="' . $department->id . '">' .
                    '<i class="fa-solid fa-trash"></i>' .
                    '</button>' .
                    '</div>' .
                    '</div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();
        $all_data = $homeController->getAllData();
        return view('dashboard.main_admin.manage.departments.add', [
            'user_data' => $user_data,
            'all_data' => $all_data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Put this validation in the DepartmentRequest

        // Message
        $messages = [
            'name.required' => 'Department name is required.',
            'name.regex' => 'Please enter a valid Department name.',
            'name.min' => 'Department name must be at least :min characters long.',
            'name.max' => 'Department name must not be greater than :max characters long.',
            'name.unique' => 'Department name already exists.',
            'description.required' => 'Select a Department.',
            'description.min' => 'Description must be atleast :min to :max characters long.',
            'code.required' => 'Department code is required.',
            'code.min' => 'The department code field must be at least :min characters long.',
            'code.max' => 'The department code field must not be greater than :max characters long.',
        ];

        // Validate
        $validatedData = Validator::make($request->except('_token'), [
            'name' => ['required', "regex:/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/", 'min:5', 'max:75', 'unique:departments'],
            'description' => ['required', 'string', 'min:5'],
            'status' => ['nullable'],
            'code' => ['required', 'min:1', 'max:5']
        ], $messages);

        // check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Access each validated data
        $name = $validatedData->validated()['name'];
        $description = $validatedData->validated()['description'];
        $code = $validatedData->validated()['code'];
        $status = $request->has('status') ? 'active' : 'inactive';

        // Insert
        Department::create([
            'name' => $name,
            'description' => $description,
            'status' => $status,
            'code' => $code
        ]);

        // Redirect
        return response()->json(['code' => 200, 'msg' => 'Department added successfully.']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HomeController $homeController, Request $request)
    {
        $department = Department::findOrFail($request->department_id);

        return view('dashboard.main_admin.manage.departments.view', [
            'user_data' => $homeController->getUserData(),
            'department' => $department
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        dd("This is the edit method, the ID is $request->department_id.");
        // dd($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd("This is the update method, the ID is $request->department_id.");
        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("This is the destroy method, the ID is $id.");
    }
}
