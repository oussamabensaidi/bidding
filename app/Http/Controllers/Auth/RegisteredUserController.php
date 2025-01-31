<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required'],
            'role' => ['required', 'string', 'in:client,admin'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'balance' => ['nullable', 'numeric', 'min:0'], 
            'maximumbid' => ['nullable', 'numeric', 'min:0'], 
        ]);
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filePath = $file->storeAs('pfp', uniqid() . '.' . $file->getClientOriginalExtension(), 'public');
        } else {
            $filePath = null; 
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'profile_picture' => $filePath ?? null,
            'balance' => $request->balance ,
            'maximumbid' => $request->maximumbid ?? null,
        ]);
        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
