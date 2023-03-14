<?php

namespace App\Http\Controllers;

use App\Models\PromotionalText;
use App\Models\PromotionalVideo;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'video' => 'required|mimetypes:video/mp4|max:500000'
        ]);

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $filename = time() . '_' . $video->getClientOriginalName();
            $video->storeAs('public/promotional_videos', $filename);
            PromotionalVideo::create([
                'filename' => $filename,
                'is_active' => false,
            ]);

            return redirect()->back()->with('success', 'Promotional video added successfully!');
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
