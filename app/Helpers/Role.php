<?php

use Illuminate\Support\Facades\Auth;
if (!function_exists('Role')) {
    function Role($type)
    {
        if (Auth::user()->type == $type) {
            return true;
        } else {
            return false;
        }
    }
}
