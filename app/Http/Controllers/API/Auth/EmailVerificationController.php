<?php
// app/Http/Controllers/Auth/EmailVerificationController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function request()
    {
        auth()->user()->sendEmailVerificationNotification();
        // SendEmailVerificationNotification::dispatch(auth()->user());
        return redirect()->to('verify-email')->with('success', 'Verification link sent!');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->to('login'); // <-- change this to whatever you want
    }
}
