<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

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

if (!function_exists('getsetting')) {
    function getsetting($key)
    {
        $data = Setting::where('name', $key)->first();
        return $data->value;
    }
}
