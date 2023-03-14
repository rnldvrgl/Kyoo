<?php

namespace App\Http\Controllers;

use App\Models\PromotionalText;
use App\Models\PromotionalVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PromotionalController extends Controller
{

    public function index(HomeController $homeController)
    {
        $user_data = $homeController->getUserData();
        $all_data = $homeController->getAllData();
        $videos = PromotionalVideo::all();
        $texts = PromotionalText::all();

        return view('dashboard.main_admin.manage.promotionals.edit', compact('videos', 'texts', 'user_data', 'all_data'));
    }

    public function addVideo(Request $request)
    {
        // Messages
        $messages = [
            'video.required' => 'The video file is required.',
            'video.mimetypes' => 'The uploaded file must be an MP4 video format.',
            'video.max' => 'The uploaded video file may not be greater than :max kilobytes in size.',
        ];

        // Validate
        $validatedData = Validator::make($request->except('_token'), [
            'video' => 'required|mimetypes:video/mp4|max:500000'
        ], $messages);

        // Check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $filename = time() . '_' . $video->getClientOriginalName();
            $video->storeAs('public/promotional_videos', $filename);
            PromotionalVideo::create([
                'filename' => $filename,
                'is_active' => false,
            ]);

            // Redirect
            return response()->json(['code' => 200, 'msg' => 'Promotional video added successfully!']);
        }

        return redirect()->back()->with('error', 'Failed to add promotional video.');
    }

    public function setActiveVideo(Request $request)
    {
        $video_id = $request->input('video_id');
        $is_active = $request->input('is_active');

        $video = PromotionalVideo::find($video_id);
        $video->is_active = $is_active;
        $video->save();

        return response()->json(['success' => true]);
    }

    public function deleteVideo($id)
    {
        $video = PromotionalVideo::find($id);
        if ($video) {
            // delete the video file from storage
            Storage::delete('public/promotional_videos/' . $video->filename);

            // delete the video from the database
            $video->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Video deleted successfully.'
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'Video not found.'
            ]);
        }
    }

    public function updateMessage(Request $request)
    {
        // Messages
        $messages = [
            'text.required' => 'The promotional message field is required.',
            'text.string' => 'The promotional message must be a string.',
            'text.max' => 'The promotional message may not be greater than :max characters.',
        ];

        // Validate
        $validatedData = Validator::make($request->all(), [
            'text' => 'required|string|max:1500'
        ], $messages);

        // Check if there is any error
        if ($validatedData->fails()) {
            return response()->json(['code' => 400, 'errors' => $validatedData->errors()]);
        }

        // Get the selected promotional message or create a new one if it doesn't exist
        $selected_text = PromotionalText::firstOrCreate([]);

        // Update the promotional message
        $selected_text->text = $request->input('text');
        $selected_text->save();

        // Return a success message
        return response()->json(['code' => 200, 'msg' => 'Promotional text updated successfully!']);
    }
}
