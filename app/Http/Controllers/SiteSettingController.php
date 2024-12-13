<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $sitesettings = SiteSetting::all();
        return view('backend.sitesetting.index', ['sitesettings' => $sitesettings, 'page_title' => 'Site Settings']);
    }

    public function create()
    {
        return view('backend.sitesetting.create', ['page_title' => 'Create SiteSetting']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'office_name' => 'required|string',
            'office_address.*' => 'required|string',
            'office_contact.*' => 'required|string',
            'office_email.*' => 'required|string',
            'whatsapp_number' => 'required|string',
            'main_logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'side_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'company_registered_date' => 'required|date_format:Y-m-d',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'snapchat_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'google_maps_link' => 'nullable|url',
            'youtube_link' => 'nullable|url', // Added validation for YouTube link
            'twitter_link' => 'nullable|url', // Added validation for Twitter link
            'slogan' => 'nullable|string',
        ]);

        try {
            if ($request->hasFile('main_logo')) {
                $newMainLogo = time() . '.' . $request->main_logo->getClientOriginalName();
                $request->main_logo->move('uploads/sitesetting/', $newMainLogo);
            } else {
                $newMainLogo = "NoImage";
            }

            if ($request->hasFile('side_logo')) {
                $newSideLogo = time() . '.' . $request->side_logo->getClientOriginalName();
                $request->side_logo->move('uploads/sitesetting/', $newSideLogo);
            } else {
                $newSideLogo = "NoImage";
            }

            $sitesetting = new SiteSetting;
            $sitesetting->office_name = $request->office_name;
            $sitesetting->whatsapp_number = $request->whatsapp_number;
            $sitesetting->main_logo = $newMainLogo;
            $sitesetting->side_logo = $newSideLogo ?? '';
            $sitesetting->company_registered_date = $request->company_registered_date;
            $sitesetting->facebook_link = $request->facebook_link ?? '';
            $sitesetting->instagram_link = $request->instagram_link ?? '';
            $sitesetting->snapchat_link = $request->snapchat_link ?? '';
            $sitesetting->linkedin_link = $request->linkedin_link ?? '';
            $sitesetting->google_maps_link = $request->google_maps_link ?? '';
            $sitesetting->youtube_link = $request->youtube_link ?? ''; // Save YouTube link
            $sitesetting->twitter_link = $request->twitter_link ?? ''; // Save Twitter link
            $sitesetting->slogan = $request->slogan ?? '';

            $sitesetting->office_address = json_encode($request->office_address);
            $sitesetting->office_contact = json_encode($request->office_contact);
            $sitesetting->office_email = json_encode($request->office_email);

            if ($sitesetting->save()) {
                return redirect()->route('admin.site-settings.index')->with('success', 'Success !! SiteSetting Created');
            } else {
                return redirect()->back()->with('error', 'Error !! SiteSetting not created');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error !! Something went wrong');
        }
    }

    public function edit($id)
    {
        $sitesetting = SiteSetting::find($id);
        return view('backend.sitesetting.update', ['sitesetting' => $sitesetting, 'page_title' => 'Update SiteSettings']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'office_name' => 'required|string',
            'office_address.*' => 'required|string',
            'office_contact.*' => 'required|string',
            'office_email.*' => 'required|string',
            'whatsapp_number' => 'required|string',
            'main_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'side_logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'company_registered_date' => 'required|date_format:Y-m-d',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'snapchat_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'google_maps_link' => 'nullable|url',
            'youtube_link' => 'nullable|url', // Added validation for YouTube link
            'twitter_link' => 'nullable|url', // Added validation for Twitter link
            'slogan' => 'nullable|string',
        ]);

        try {
            $sitesetting = SiteSetting::findOrFail($id);

            if ($request->hasFile('main_logo')) {
                $newMainName = time() . '-' . $request->main_logo->getClientOriginalName();
                $request->main_logo->move(public_path('uploads/sitesetting'), $newMainName);
                if ($sitesetting->main_logo && file_exists(public_path('uploads/sitesetting/' . $sitesetting->main_logo))) {
                    unlink(public_path('uploads/sitesetting/' . $sitesetting->main_logo));
                }
                $sitesetting->main_logo = $newMainName;
            }

            if ($request->hasFile('side_logo')) {
                $newSideName = time() . '-' . $request->side_logo->getClientOriginalName();
                $request->side_logo->move(public_path('uploads/sitesetting'), $newSideName);
                if ($sitesetting->side_logo && file_exists(public_path('uploads/sitesetting/' . $sitesetting->side_logo))) {
                    unlink(public_path('uploads/sitesetting/' . $sitesetting->side_logo));
                }
                $sitesetting->side_logo = $newSideName;
            }

            $sitesetting->office_name = $request->office_name;
            $sitesetting->whatsapp_number = $request->whatsapp_number;
            $sitesetting->company_registered_date = $request->company_registered_date;
            $sitesetting->facebook_link = $request->facebook_link ?? '';
            $sitesetting->instagram_link = $request->instagram_link ?? '';
            $sitesetting->snapchat_link = $request->snapchat_link ?? '';
            $sitesetting->linkedin_link = $request->linkedin_link ?? '';
            $sitesetting->google_maps_link = $request->google_maps_link ?? '';
            $sitesetting->youtube_link = $request->youtube_link ?? ''; // Save YouTube link
            $sitesetting->twitter_link = $request->twitter_link ?? ''; // Save Twitter link
            $sitesetting->slogan = $request->slogan ?? '';

            $sitesetting->office_address = json_encode($request->office_address);
            $sitesetting->office_contact = json_encode($request->office_contact);
            $sitesetting->office_email = json_encode($request->office_email);

            if ($sitesetting->save()) {
                return redirect()->route('admin.site-settings.index')->with('success', 'SiteSetting Updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update SiteSetting');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $sitesetting = SiteSetting::find($id);
        if ($sitesetting) {
            $sitesetting->delete();
            return redirect()->route('admin.site-settings.index')->with('success', 'Success !! Site Settings Deleted');
        } else {
            return redirect()->route('admin.site-settings.index')->with('error', 'Site Settings not found.');
        }
    }
}
