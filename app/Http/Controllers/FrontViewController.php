<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\About;
use App\Models\Service;
use App\Models\Contact;
use App\Models\CoverImage;
use App\Models\Demand;
use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use App\Models\SiteSetting;
use App\Models\BlogPostsCategory;
use App\Models\Category;
use App\Models\NewsandEvents;
use Illuminate\Http\Request;

class FrontViewController extends Controller
{
    public function index()
    {
        $sitesetting = SiteSetting::first();
        $about = About::first();
        $services = Service::latest()->take(6)->get();
        $contacts = Contact::latest()->get();
        $blogs = BlogPostsCategory::latest()->take(6)->get();
        $coverImages = CoverImage::all();
        $demands = Demand::latest()->take(12)->get();
        $images = PhotoGallery::latest()->take(6)->get(); // Fetch the photos
        $videos = VideoGallery::latest()->take(6)->get(); // Fetch the videos
        $newsEvents = NewsandEvents::latest()->take(6)->get();
        
        // Update the roles to match the values in the database
        $executiveTeam = Team::where('role', 'Executive Team')->get();
        $advisoryTeam = Team::where('role', 'Advisory Team')->get();
        $otherTeam = Team::where('role', 'Others')->get();
    
        $firstCategory = Category::first();
        $posts = $firstCategory ? $firstCategory->posts()->latest()->take(6)->get() : collect();
    
        return view('frontend.index', compact(
            'services', 
            'contacts', 
            'blogs', 
            'sitesetting', 
            'coverImages', 
            'demands', 
            'about', 
            'posts', 
            'firstCategory', 
            'images', 
            'videos',  
            'executiveTeam',
            'advisoryTeam',
            'otherTeam',
            'newsEvents'
        ));
    }
    
    
    // public function singlePost($slug)
    // {
    //     $post = Post::where('slug', $slug)->firstOrFail();
    //     $relatedPosts = Post::where('id', '!=', $post->id)->get();

    //     return view('frontend.posts', compact('post', 'relatedPosts'));
    // }

    public function showTeam($role)
    {
        $role = $this->convertTypeToRole($role);

        if ($role === null) {
            abort(404);
        }

        $teams = Team::where('role', $role)->get();
        $page_title = $role;
        $services = Service::latest()->take(6)->get();
        $sitesetting = SiteSetting::first();
        $categories = Category::latest()->take(10)->get();
        $about = About::first();
        // $posts = Post::with('category')->latest()->take(3)->get();

        return view('frontend.team', compact(
            'teams',
            'sitesetting',
            'categories',
            'about',
            'page_title',
            'services',
            // 'posts',
            'role'
        ));
    }

    private function convertTypeToRole($role)
    {
        switch ($role) {
            case 'executive':
                return 'Executive Team';
            case 'advisory':
                return 'Advisory Team';
            case 'others':
                return 'Others';
            default:
                return null;
        }
    }
}
