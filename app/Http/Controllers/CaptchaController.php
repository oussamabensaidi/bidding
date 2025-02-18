<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function show()
    {
        return view('captcha'); // Show CAPTCHA page
    }

    public function verify(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
        ]);

        return redirect()->route('items'); 
    }
}
