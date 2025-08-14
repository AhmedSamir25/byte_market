<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/register", function () {
    return view("auth.register");
})->name("register");

Route::post("/register", function () {});

Route::get("/forgot-password", function () {
    return view("auth.forgot-password");
})->name("password.request");

Route::post("/forgot-password", function () {
    // Password reset logic
    request()->validate(["email" => "required|email"]);

    // Here you would typically send a password reset email
    return back()->with(
        "status",
        "A password reset link has been sent to your email.",
    );
})->name("password.email");

Route::post("/logout", function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect("/");
})->name("logout");

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware("auth")
    ->name("dashboard");
