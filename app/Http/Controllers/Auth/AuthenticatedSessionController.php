<?php

namespace App\Http\Controllers\Auth;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'Userid ou le mot de passe est incorrect.',
            ]);
        }        
        $request->authenticate();
        App::setLocale(Auth::user()->localization);
        Session::put('locale', Auth::user()->localization);
        if (Auth::user()->role == 'admin') {
            return redirect(route('admin.dashboard'));
        }
        if (Auth::user()->role == 'ingenieur') {
            return redirect(route('ingenieur.dashboard'));
        }
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
