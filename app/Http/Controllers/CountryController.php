<?php

namespace App\Http\Controllers;

use Exception;
use DOMDocument;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\SummernoteContent;
use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\ImageConverter;


class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->paginate(5);
        $summernoteContent = new SummernoteContent(); // Instantiate SummernoteContent model
        return view('backend.country.index', ['countries' => $countries, 'summernoteContent' => $summernoteContent, 'page_title' => 'Country']);
    }

    public function create()
    {
        return view('backend.country.create', ['page_title' => 'Create Country']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048',
            'content' => 'nullable|string',
        ]);

        try {
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/country'), $newImageName);

            // Process Summernote content using the SummernoteContent model
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));

            $country = new Country();
            $country->name = $request->input('name');
            $country->slug = SlugService::createSlug(Country::class, 'slug', $request->input('name'));
            $country->image = $newImageName;
            $country->content = $processedContent;
            $country->save();

            return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
        } catch (Exception $e) {
            return back()->with('error', "Error creating country: " . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('backend.country.update', compact('country'))->with('page_title', 'Edit Country');
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif,webp,avi|max:2048',
            'content' => 'nullable|string',
        ]);
    
        try {
            $country = Country::findOrFail($id);
    
            if ($request->hasFile('image')) {
                // Delete the old image from the server
                if ($country->image && file_exists(public_path('uploads/country/' . $country->image))) {
                    unlink(public_path('uploads/country/' . $country->image));
                }
    
                // Upload the new image
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/country'), $newImageName);
                $country->image = $newImageName;
            }

            // Process Summernote content using the SummernoteContent model
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));
    
            // Update other country details
            $country->name = $request->input('name');
            $country->slug = SlugService::createSlug(Country::class, 'slug', $request->input('name'), ['unique' => false, 'source' => 'name', 'onUpdate' => true], $id);
            // $country->image = json_encode($imagesPaths); // Only store new image paths, replacing existing ones
            $country->content = $processedContent;
            $country->save();
    
            return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', "Error updating country: " . $e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $images = json_decode($country->image, true);
        if ($images) {
            foreach ($images as $imagePath) {
                File::delete(public_path($imagePath));
            }
        }

        $country->delete();
        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }

    


}