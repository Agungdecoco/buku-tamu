<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class LandingpageController extends Controller
{
    public function landingpage()
    {
        return view('landingpage.landingpage', [
            'tittle' => 'Landing Page'
        ]);
    }

    public function storeContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();

        $contact = Contact::create($input);

        //  Send mail to admin
        Mail::send('admin.contactMail', array(
            'name' => $input['name'],
            'email' => $input['email'],
            'subject' => $input['subject'],
            'text_message' => $input['message'],
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('agungmaster123@gmail.com', 'Admin')->subject($request->get('subject'));
        });
        // return redirect('/')->with('success', 'Terima kasih telah menghubungi kami. Kami akan segera menghubungi anda.');
        return redirect()->to('/')->with('success', 'Your message has been sent. Thank you!');
    }
}
