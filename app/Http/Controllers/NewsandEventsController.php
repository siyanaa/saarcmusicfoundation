<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\NewsAndEvent;
use App\Models\NewsandEvents;
use App\Models\SummernoteContent;
use Cviebrock\EloquentSluggable\Services\SlugService;

class NewsAndEventsController extends Controller
{
    public function index()
    {
        $newsAndEvents = NewsandEvents::latest()->paginate(10);
        return view('backend.news_and_events.index', [
            'newsAndEvents' => $newsAndEvents,
            'page_title' => 'News and Events'
        ]);
    }

    public function create()
    {
        $summernoteContent = new SummernoteContent();
        return view('backend.news_and_events.create', [
            'page_title' => 'Create News or Event',
            'summernoteContent' => $summernoteContent
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Handle the image upload
            $newImageName = null;
            if ($request->hasFile('image')) {
                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/newsandevents'), $newImageName);
            }

            // Process the content with SummernoteContent
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));

            // Create a new NewsAndEvents instance
            $newsAndEvent = new NewsAndEvents();
            $newsAndEvent->title = $request->title;
            $newsAndEvent->slug = SlugService::createSlug(NewsAndEvents::class, 'slug', $request->input('title'));
            $newsAndEvent->content = $processedContent;
            $newsAndEvent->image = $newImageName;

            // Save the model and redirect
            if ($newsAndEvent->save()) {
                return redirect()->route('admin.news-and-events.index')->with('success', 'News or Event created successfully.');
            } else {
                return redirect()->back()->with('error', 'Error! News or Event not created.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $newsEvent = NewsAndEvents::findOrFail($id);
        return view('backend.news_and_events.update', compact('newsEvent'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $newsAndEvent = NewsAndEvents::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($newsAndEvent->image && file_exists(public_path('uploads/newsandevents/' . $newsAndEvent->image))) {
                    unlink(public_path('uploads/newsandevents/' . $newsAndEvent->image));
                }

                $newImageName = time() . '-' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/newsandevents'), $newImageName);
                $newsAndEvent->image = $newImageName;
            }

            // Process the content with SummernoteContent
            $summernoteContent = new SummernoteContent();
            $processedContent = $summernoteContent->processContent($request->input('content'));

            $newsAndEvent->title = $request->input('title');
            $newsAndEvent->content = $processedContent;
            $newsAndEvent->slug = SlugService::createSlug(NewsAndEvents::class, 'slug', $request->input('title'), ['unique' => false, 'source' => 'title', 'onUpdate' => true], $id);

            $newsAndEvent->save();

            return redirect()->route('admin.news-and-events.index')->with('success', 'News or Event updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error updating news or event: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $newsAndEvent = NewsAndEvents::findOrFail($id);

            if ($newsAndEvent->image && file_exists(public_path('uploads/newsandevents/' . $newsAndEvent->image))) {
                unlink(public_path('uploads/newsandevents/' . $newsAndEvent->image));
            }

            $newsAndEvent->delete();
            return redirect()->route('admin.news-and-events.index')->with('success', 'News or Event deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Error deleting news or event: ' . $e->getMessage());
        }
    }
}
