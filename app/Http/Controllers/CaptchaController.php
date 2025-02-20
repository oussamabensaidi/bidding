<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CaptchaController extends Controller
{
    public function show()
    {
        return view('captcha'); // Show CAPTCHA page
    }

    public function verify(Request $request)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('NOCAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'), // Different key for v2
            'remoteip' => $request->ip(),
        ]);
    
        $body = $response->json();
    
        if (!$body['success']) { // v2 doesn't use "score"
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed.']);
        }
    
        return redirect()->route('items');
    }
}

