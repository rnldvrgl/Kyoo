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
        $departments = Department::all()->sortByDesc('created_at');

        return DataTables::eloquent($departments)
            ->smart()
            ->addColumn('actions', function ($department) {
                // Add your action buttons here
                $viewUrl = route('manage.departments.show', $department->id);
                $editUrl = route('manage.departments.edit', $department->id);
                // $deleteUrl = route('manage.accounts.delete', $department->id);

                return '<a href="' . $viewUrl . '" class="btn btn-primary view-department"><i class="fa-solid fa-eye"></i></a>
                        <a href="' . $editUrl . '" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button class="btn btn-danger delete-department" data-department-id="' . $department->id . '">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        ';
            })
            ->rawColumns(['actions'])
            ->toJson();
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
    public function show($id)
    {
        dd("This is the show method, the ID is $id.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd("This is the edit method, the ID is $id.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd("This is the update method, the ID is $id.");
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
