<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // Message
        $messages = [
            'name.required' => 'Department name is required.',
            'name.regex' => 'Please enter a valid Department name.',
            'name.min' => 'Department name must be within :min to :max characters long.',
            'name.max' => 'Department name must be within :min to :max characters long.',
            'description.required' => 'Select a Department.',
            'description.min' => 'Description must be within :min to :max characters long.',
            'description.max' => 'Description must be within :min to :max characters long.',
            'status.required' => 'Select a status.',
        ];

        // Validate
        $validatedData = Validator::make($request->except('_token'), [
            'name' => ['required', "regex:/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/", 'min:5', 'max:75'],
            'description' => ['required', 'string', 'min:5', 'max:75'],
            'status' => ['required'],
        ], $messages);

        // check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Format the code using the Department Name

        // Insert

        // Redirect
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
