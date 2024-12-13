<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;

use App\Models\ImageConverter;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $gallery = PhotoGallery::latest()->paginate(5);
        return view('backend.photogallery.index', ['gallery' => $gallery, 'page_title' => 'Photo Gallery']);
    }

    public function create()
    {
        return view('backend.photogallery.create', ['page_title' => 'Create Photo Gallery']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'img_desc' => 'nullable|string',
            'img' => 'required|array', // Ensure at least one image is uploaded
            'img.*' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048' // Maximum file size of 2 MB
        ]);

        try {
            $gallery = new PhotoGallery;
            $gallery->title = $request->title;
            $gallery->img_desc = $request->img_desc;
            $gallery->slug = SlugService::createSlug(PhotoGallery::class, 'slug', $request->title);
            
            // Save each uploaded image
            $convertedImages = [];
            foreach ($request->file('img') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/photogallery/'), $imageName);
                $convertedImages[] = 'uploads/photogallery/' . $imageName;
            }

            $gallery->img = $convertedImages;
            $gallery->save();
            
            return redirect()->route('admin.photo-galleries.index')->with(['success' => 'Success!! Gallery Created']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error creating gallery. Please try again.']);
        }
    }

    public function edit($id)
    {
        $gallery = PhotoGallery::find($id);
        return view('backend.photogallery.update', ['gallery' => $gallery, 'page_title' => 'Update Photo Gallery']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'img_desc' => 'nullable|string',
            'img' => 'nullable|array', // Allow null or array (for single or multiple photo updates)
            'img.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048' // Maximum file size of 2 MB
        ]);

        try {
            $gallery = PhotoGallery::findOrFail($id);
            $gallery->title = $request->title;
            $gallery->img_desc = $request->img_desc;
            $gallery->slug = SlugService::createSlug(PhotoGallery::class, 'slug', $request->title);

            // Check if new images are uploaded
            if ($request->hasFile('img')) {
                $convertedImages = [];
                foreach ($request->file('img') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/photogallery/'), $imageName);
                    $convertedImages[] = 'uploads/photogallery/' . $imageName;
                }
                $gallery->img = $convertedImages;
            }

            $gallery->save();
            return redirect()->route('admin.photo-galleries.index')->with(['success' => 'Success!! Gallery Updated']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error updating gallery. Please try again.']);
        }
    }

    public function destroy($id)
    {
        $gallery = PhotoGallery::find($id);
        if ($gallery) {
            // Delete images associated with the gallery
            foreach ($gallery->img as $image) {
                File::delete(public_path($image));
            }
            $gallery->delete();
            return redirect()->route('admin.photo-galleries.index')->with('success', 'Success !! Photo Gallery Deleted');
        } else {
            return redirect()->route('admin.photo-galleries.index')->with('error', 'Photo Gallery not found.');
        }
    }
}
