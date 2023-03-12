<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Message
        $messages = [
            'feedback-message.required' => 'Feedback Message is required.',
        ];

        // Validate
        $validatedData = Validator::make($request->except('_token'), [
            'fullname' => 'nullable|string',
            'feedback-message' => 'required',
        ], $messages);

        // check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Access each validated data
        $name = $validatedData->validated()['fullname'];
        $feedback_message = $validatedData->validated()['feedback-message'];

        // Insert
        Feedback::create([
            'name' => $name,
            'feedback' => $feedback_message,
        ]);

        // Redirect
        return response()->json(['code' => 200, 'msg' => 'Feedback Sent.']);
    }
}
