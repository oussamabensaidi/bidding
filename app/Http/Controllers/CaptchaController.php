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
        
        $recaptchaSecret = env('NOCAPTCHA_SECRET');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $body = $response->json();

        if (!$body['success'] || $body['score'] < 0.5) {
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed.']);
        }
        return redirect()->route('items');
    }
}

