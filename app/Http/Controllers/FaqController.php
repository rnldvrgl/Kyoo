<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    // For FAQs on the Landing Page
    public function index()
    {
        $faqs = Faq::all();
        return view('frequent-questions', ['faqs' => $faqs]);
    }

    // List of FAQs
    public function faqList(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();
        $all_data = $homeController->getAllData();
        return view('dashboard.main_admin.manage.frequent_questions.list', [
            'user_data' => $user_data,
            'all_data' => $all_data,
        ]);
    }

    public function fetchFAQs()
    {
        $faqs = Faq::query()->orderByDesc('created_at');

        return DataTables::of($faqs)
            ->smart()
            ->addColumn('actions', function ($faq) {
                $viewUrl = route('manage.frequent_questions.show', $faq->id);
                $editUrl = route('manage.frequent_questions.edit', $faq->id);

                return
                    '<div class="hstack mx-auto">' .
                    // View 
                    '<form action="' . $viewUrl . '" method="POST">' .
                    csrf_field() .
                    '<input name="faq_id" type="hidden" value="' . $faq->id . '"/>' .
                    '<button type="submit" class="btn btn-primary me-md-1"><i class="fa-solid fa-eye"></i></button>' .
                    '</form>' .

                    // Update
                    '<form action="' . $editUrl . '" method="POST">' .
                    csrf_field() .
                    '<input name="faq_id" type="hidden" value="' . $faq->id . '"/>' .
                    '<button type="submit" class="btn btn-secondary me-md-1"><i class="fa-solid fa-pen-to-square"></i></button>' .
                    '</form>' .

                    // Delete
                    '<div class="d-grid">' .
                    '<button class="btn btn-danger delete-faq" data-faq-id="' . $faq->id . '">' .
                    '<i class="fa-solid fa-trash"></i>' .
                    '</button>' .
                    '</div>' .
                    '</div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        // Fetch all data except the CSRF token
        $data = $request->all();

        // Regex for the Question and Answer fields
        $regex = '/^[a-zA-Z0-9\s?!,.\'-]+$/';

        // Rules
        $rules = [
            'question' => ['required', 'regex:' . $regex],
            'answer' => ['required', 'regex:' . $regex]
        ];

        // Error messages if rules are violated
        $messages = [
            'question.required' => 'Please provide a question.',
            'question.regex' => 'The question contains invalid characters.',
            'answer.required' => 'Please provide an answer to the question above.',
            'answer.regex' => 'The answer contains invalid characters.'
        ];

        // Validate the inputs
        $validatedData = Validator::make($data, $rules, $messages);

        // Check if there are any errors
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Access the validated inputs
        $question = $validatedData->validated()['question'];
        $answer = $validatedData->validated()['answer'];

        // Insert the inputs
        Faq::create([
            'question' => $question,
            'answer' => $answer
        ]);

        return response()->json(['code' => 200, 'msg' => 'Frequently Asked Question added successfully.']);
    }

    public function show(HomeController $homeController, Request $request)
    {
        // return view('faq.show', compact('faq'));

        $faq = Faq::findOrFail($request->faq_id);

        return view('dashboard.main_admin.manage.frequent_questions.view', [
            'all_data' => $homeController->getAllData(),
            'user_data' => $homeController->getUserData(),
            'faq' => $faq,
        ]);
    }

    public function edit(HomeController $homeController, Request $request)
    {
        // Redirect to the View page along with the user's records
        return view('dashboard.main_admin.manage.frequent_questions.edit', [
            'user_data' => $homeController->getUserData(),
            'all_data' => $homeController->getAllData(),
            'faq' => Faq::findOrFail($request->faq_id)
        ]);
    }

    public function update(Request $request)
    {
        $faq = Faq::findOrFail($request->id);

        $data = $request->all();

        // Regex for the Question and Answer fields
        $regex = '/^[a-zA-Z0-9\s?!,.\'-]+$/';

        // Rules
        $rules = [
            'question' => ['required', 'regex:' . $regex],
            'answer' => ['required', 'regex:' . $regex]
        ];

        // Error messages if rules are violated
        $messages = [
            'question.required' => 'Please provide a question.',
            'question.regex' => 'The question contains invalid characters.',
            'answer.required' => 'Please provide an answer to the question above.',
            'answer.regex' => 'The answer contains invalid characters.'
        ];

        // Validate the inputs
        $validatedData = Validator::make($data, $rules, $messages);

        // Check if there are any errors
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Access the validated inputs
        $question = $validatedData->validated()['question'];
        $answer = $validatedData->validated()['answer'];

        // Update the inputs
        Faq::where('id', $request->id)->update([
            'question' => $question,
            'answer' => $answer
        ]);

        return response()->json(['code' => 200, 'msg' => 'Frequently Asked Question updated successfully.']);
    }

    public function destroy($id)
    {
        // Find the Question by id
        $faq = Faq::findOrFail($id);

        // Delete the Question
        $faq->delete();

        // Redirect to the index page with a success message
        return response()->json(['code' => 200, 'message' => 'Question deleted successfully']);
    }
}
