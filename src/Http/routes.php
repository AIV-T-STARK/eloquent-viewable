<?php

Route::middleware(['web'])->group(function () {
    $cookieName = config('eloquent-viewable.cookie_name', 'eloquent_viewable');

    if (Cookie::get($cookieName) == false) {
        Cookie::queue($cookieName, str_random(80), 2628000);
    }
});
