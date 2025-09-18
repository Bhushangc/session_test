<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    // Store a value in the session
    Session::put('test_key', 'Hello, from Session!');
    return "Session value has been set";
});
Route::get('/session-get', function () {
    $value = Session::get('test_key');
    if ($value) {
        return $value;
    }
    return "Cannot get session";
});
