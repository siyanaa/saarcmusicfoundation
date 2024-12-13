<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = VideoGallery::latest()->paginate(5);
        
        return view('backend.videogallery.index', ['videos' => $videos, 'page_title' => 'Video Gallery']);
    }
    public function create()
    {
        return view('backend.videogallery.create', ['page_title' => 'Add VideoGallerys']);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'url' => 'required|url',
        ]);
    
        try {
            $video = new VideoGallery();
            $video->title = $request->title;
            $video->slug = SlugService::createSlug(VideoGallery::class, 'slug', $request->title);
    
            // Extract video ID from the provided embedded URL
            $video_id = $this->getYoutubeVideoIdFromEmbedUrl($request->url);
    
            if ($video_id) {
                // Use the provided embedded URL directly
                $video->url = $request->url;
            } else {
                // If we couldn't extract a video ID, store the URL as-is
                $video->url = $request->url;
            }
    
            if ($video->save()) {
                return redirect()->route('admin.video-galleries.index')->with('success', 'Success! Video created.');
            } else {
                return redirect()->back()->with('error', 'Error! Video not created.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }
    
    // Helper function to extract YouTube video ID from embedded URL
    private function getYoutubeVideoIdFromEmbedUrl($url)
    {
        $parsed_url = parse_url($url);
        
        if (isset($parsed_url['path'])) {
            $path_parts = explode('/', trim($parsed_url['path'], '/'));
            return end($path_parts);
        }
        
        return null;
    }
    public function edit($id)
    {
        $video = VideoGallery::find($id);

        return view('backend.videogallery.update', ['video' => $video, 'page_title' => 'Update Video Gallery']);

    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'url' => 'nullable',
        ]);
        try {

            $video = VideoGallery::findOrFail($id);

            $video->title = $request->title ?? '';
            $video->slug = SlugService::createSlug(VideoGallery::class, 'slug', $request->title);
            $video->url = $request->url ?? '';


            if ($video->save()) {
                return redirect()->route('admin.video-galleries.index')->with('success', 'Success! Video Updated.');
            } else {
                return redirect()->back()->with('error', 'Error! Video not updated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong.');
        }
    }
    public function destroy($id)
    {
        $video = VideoGallery::find($id);

        if ($video) {
            $video->delete();
            return redirect()->route('admin.video-galleries.index')->with(['success' => 'Success !!VideoGallery Deleted']);
        } else {
            return redirect()->route('admin.video-galleries.index')->with('error', 'VideoGallery not found.');
        }

    }
}