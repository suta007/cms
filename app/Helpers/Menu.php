<?php
use App\Models\Menu;
if (!function_exists('SutaMenu')) {
    function SutaMenu()
    {
        return Menu::where('parent_id', '0')->with('childs')->get();
    }
}
