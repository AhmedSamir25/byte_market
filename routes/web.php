<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get("/", function () {
    return view("welcome");
});

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
