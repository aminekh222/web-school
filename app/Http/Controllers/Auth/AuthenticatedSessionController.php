<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Afficher la vue de connexion
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gérer une tentative de connexion
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Rediriger vers le dashboard approprié selon le rôle
        if (auth()->user()->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }
        
        return redirect()->intended(route('student.dashboard'));
    }

    /**
     * Déconnecter l'utilisateur
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
} 