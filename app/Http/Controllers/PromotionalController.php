<?php

namespace App\Http\Controllers;

use App\Models\PromotionalText;
use App\Models\PromotionalVideo;
use Illuminate\Http\Request;
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

    public function updatePromotional(Request $request)
    {
        $validated = $request->validate([
            'video_id' => 'nullable|exists:promotional_videos,id',
            'text_id' => 'nullable|exists:texts,id'
        ]);

        // Deactivate the currently active video and text
        PromotionalVideo::active()->update(['is_active' => false]);
        PromotionalText::active()->update(['is_active' => false]);

        // Activate the new video or text
        if ($validated['video_id']) {
            PromotionalVideo::find($validated['video_id'])->update(['is_active' => true]);
        }

        if ($validated['text_id']) {
            PromotionalText::find($validated['text_id'])->update(['is_active' => true]);
        }

        return redirect()->route('manage.promotionals.index');
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
}
