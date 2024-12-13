<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
// use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

use Closure;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('backend.contact.index', [
            'contacts' => $contacts,
            'page_title' => 'Contact Us'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            // 'email' => 'required|string',
            'phone_no' => 'required|string',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required',
            function ($attribute, $value, $fail) {

                $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
                    'secret' => config('services.recaptcha.secret_key'),
                    'response' => $value,
                    'remoteip' => \request()->ip()
                ]);

                if (!$g_response->json('success')) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            },
        ]);

        $contact = new Contact;
        $contact->name = $request->name;
        // $contact->email = $request->email;
        $contact->phone_no = $request->phone_no;
        $contact->message = $request->message;
        $contact->save();

        // return response()->json(['success' => true]);
        return redirect()->back()->with('success', 'Your message has been submitted successfully!');
    }


}