<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view("auth.login");
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route("dashboard", absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("/");
    }
}
