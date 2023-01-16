<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'class' => ['required', 'string', 'max:255'],
            'school_origin' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'role_id' => 2,
            'password' => Hash::make($request->password),
        ]);
        $user->participant()->create([
            'name' => $request->name,
            'class' => $request->class,
            'school_origin' => $request->school_origin
        ]);

        event(new Registered($user));

        Auth::login($user);
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        // if is member
        if (Auth::user()->isParticipant()) {
            return redirect()->route('participant.dashboard');
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
