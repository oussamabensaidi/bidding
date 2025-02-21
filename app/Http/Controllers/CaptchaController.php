<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Item;
class CaptchaController extends Controller
{
    public function show(Item $item)
    {

        return view('captcha',['item'=>$item]); // Show CAPTCHA page
    }

    public function verify(Request $request , Item $item)
    {
        if($item){
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('NOCAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'), // Different key for v2
            'remoteip' => $request->ip(),
        ]);
    
        $body = $response->json();
    
        if (!$body['success']) { // v2 doesn't use "score"
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed.']);
        }
    
        return redirect()->route('items.bid', $item);
    }
    else{
        return redirect()->route('items');
    }


    
}
}
